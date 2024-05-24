<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Face Detection and Cropping</title>
    <style>
        body {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            font-family: Arial, sans-serif;
        }

        .video-container {
            position: relative;
            width: 320px;
            height: 240px;
        }

        #video {
            border: 1px solid black;
            width: 320px;
            height: 240px;
        }

        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 320px;
            height: 240px;
        }

        #canvas {
            display: none;
        }

        #result {
            border: 1px solid black;
            width: 320px;
            height: 240px;
        }

        .column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="column">
        <h1>Camera Feed</h1>
        <div class="video-container">
            <video id="video" autoplay></video>
            <canvas id="overlay"></canvas>
        </div>
        <button id="start">Start Camera</button>
        <button id="stop" style="display:none;">Stop Camera</button>
        <button id="capture" style="display:none;">Capture</button>
    </div>
    <div class="column">
        <h1>Cropped Face</h1>
        <canvas id="canvas" width="320" height="240"></canvas>
        <img id="result" alt="Cropped Face">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js"></script>
    <script src="/test/script.js"></script>
</body>

</html>
