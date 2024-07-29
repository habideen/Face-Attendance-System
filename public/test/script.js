let stream;
let detectionInterval;

async function setupCamera() {
    const video = document.getElementById("video");
    stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
    video.style.display = "block";
    document.getElementById("start").style.display = "none";
    document.getElementById("stop").style.display = "inline-block";
    document.getElementById("capture").style.display = "inline-block";

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
    const resultImg = document.getElementById("result");

    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const detection = await detectFace(canvas);
    if (detection) {
        const croppedFace = cropFace(canvas, detection);
        resultImg.src = croppedFace;
        stopCamera();
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
    const resultImg = document.getElementById("result");

    startButton.addEventListener("click", setupCamera);
    stopButton.addEventListener("click", stopCamera);

    captureButton.addEventListener("click", async () => {
        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const detection = await detectFace(canvas);
        if (detection) {
            const croppedFace = cropFace(canvas, detection);
            resultImg.src = croppedFace;
        } else {
            alert("No face detected!");
        }
    });
});
