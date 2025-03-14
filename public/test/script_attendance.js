let stream;
let detectionInterval;
var faceResult;

async function setupCamera() {
    const video = document.getElementById("video");
    stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
    video.style.display = "block";
    document.getElementById("start").style.display = "none";
    document.getElementById("stop").style.display = "inline-block";
    document.getElementById("capture").style.display = "inline-block";

    $("#server_response").html("");

    video.addEventListener("loadedmetadata", () => {
        const overlay = document.getElementById("overlay");
        overlay.width = video.videoWidth;
        overlay.height = video.videoHeight;

        detectFaceLive();
        setTimeout(autoCaptureFace, 3000); // Delay capture by 3 seconds
    });
}

function stopCamera() {
    const video = document.getElementById("video");
    const tracks = stream.getTracks();
    tracks.forEach((track) => track.stop());
    video.style.display = "none";
    document.getElementById("start").style.display = "inline-block";
    document.getElementById("stop").style.display = "none";
    document.getElementById("capture").style.display = "none";
    clearCanvas();
    clearInterval(detectionInterval);
}

async function loadModels() {
    await faceapi.nets.tinyFaceDetector.loadFromUri("/test/models"); // Ensure the models are in this directory
}

async function detectFace(video) {
    const options = new faceapi.TinyFaceDetectorOptions();
    const result = await faceapi.detectSingleFace(video, options);
    return result;
}

async function detectFaceLive() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("overlay");
    const displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(canvas, displaySize);

    detectionInterval = setInterval(async () => {
        const detections = await faceapi.detectAllFaces(
            video,
            new faceapi.TinyFaceDetectorOptions()
        );
        const resizedDetections = faceapi.resizeResults(
            detections,
            displaySize
        );
        clearCanvas();
        drawDetections(canvas, resizedDetections);
    }, 100);
}

async function autoCaptureFace() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");

    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const detection = await detectFace(canvas);
    if (detection) {
        const croppedFace = cropFace(canvas, detection);
        faceResult = croppedFace;
        stopCamera();
        confirmFace(croppedFace);
    } else {
        alert("No face detected!");
    }
}

function clearCanvas() {
    const canvas = document.getElementById("overlay");
    const ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function drawDetections(canvas, detections) {
    const ctx = canvas.getContext("2d");
    ctx.strokeStyle = "yellow";
    ctx.lineWidth = 2;
    detections.forEach((detection) => {
        const { x, y, width, height } = detection.box;
        ctx.strokeRect(x, y, width, height);
    });
}

function cropFace(image, detection) {
    const { x, y, width, height } = detection.box;
    const canvas = document.createElement("canvas");
    canvas.width = width;
    canvas.height = height;
    const ctx = canvas.getContext("2d");
    ctx.drawImage(image, x, y, width, height, 0, 0, width, height);
    return canvas.toDataURL();
}

document.addEventListener("DOMContentLoaded", async () => {
    await loadModels();

    const startButton = document.getElementById("start");
    const stopButton = document.getElementById("stop");
    const captureButton = document.getElementById("capture");
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");

    startButton.addEventListener("click", setupCamera);
    stopButton.addEventListener("click", stopCamera);

    captureButton.addEventListener("click", async () => {
        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const detection = await detectFace(canvas);
        if (detection) {
            const croppedFace = cropFace(canvas, detection);
            stopCamera();
            confirmFace(croppedFace);
        } else {
            alert("No face detected!");
        }
    });
});

function confirmFace(croppedFace) {
    $.ajax({
        url: checkFaceURL,
        method: "POST",
        data: {
            _token: csrf_token,
            image: croppedFace,
        },
        success: function (response) {
            CheckedData(response);
        },
        error: function (error) {
            console.error(error);
            alert("Error sending face data to the server.");
        },
    });
}

function CheckedData(response) {
    $("#server_response").html(response.message);

    if (response.status == "failed") return;

    $("#checked_name").html(response.student_name);
    $("#checked_school_id").html(response.school_id);
    $("#checked_department").html(response.department);
    $("#checked_is_disabled").html(
        response.is_disabled ? "Student disabled" : "Student enabled"
    );
    $("#checked_similarity").html(response.similarity);
    $("#checked_student_id").val(response.student_id);

    if (response.student_name == "") {
        $("#checked_is_disabled").html("");
    }
}

function takeAttendance() {
    event.preventDefault();

    var student_id = $("#checked_student_id").val();
    if (student_id == "") {
        alert("Please scan a proper face!");
        return;
    }

    $.ajax({
        url: takeAttendanceURL,
        method: "POST",
        data: {
            _token: csrf_token,
            student_id: student_id,
        },
        success: function (response) {
            CheckedData(response);
        },
        error: function (error) {
            console.error(error);
            alert("Error sending face data to the server.");
        },
    });
}
