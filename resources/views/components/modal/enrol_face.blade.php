<!-- Static Backdrop Modal -->
<div class="modal fade" id="enrolFaceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="enrolFaceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrolFaceModalLabel">Enrol Student Face</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <style>
                    .video-container {
                        position: relative;
                        width: 320px;
                        height: 240px;
                    }

                    #video {
                        width: 100%;
                        height: 100%;
                        background: url('/assets/images/users/avatar.jpg') no-repeat center center;
                        background-size: cover;
                    }

                    .enrolmentHeight {
                        height: 100%;
                    }

                    #result {
                        height: 100%;
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
                </style>

                <div class="row mt-3">
                    <div class="col-sm-5 col-md-4 col-lg-3 text-center">
                        <div class="border text-center video-container bg-light mb-2">
                            <video id="video" autoplay></video>
                            <canvas id="overlay"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-5 col-md-4 col-lg-3 text-center">
                        <div class="text-center enrolmentHeight mb-2">
                            <canvas id="canvas"></canvas>
                            <img src="/assets/images/users/avatar.jpg" id="result" alt="Cropped Face"
                                class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" id="start"
                            class="btn btn-light waves-effect waves-light"><i
                                class='mdi mdi-play me-2'></i> Start Camera</button>
                        <button type="button" id="stop" style="display:none;"
                            class="btn btn-danger waves-effect waves-light"><i
                                class='mdi mdi-stop me-2'></i> Stop Camera</button>
                        <button type="button" id="capture" style="display:none;"
                            class="btn btn-primary waves-effect waves-light"><i
                                class='mdi mdi-camera-enhance me-2'></i> Capture</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
