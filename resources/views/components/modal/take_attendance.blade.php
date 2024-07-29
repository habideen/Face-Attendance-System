<!-- Static Backdrop Modal -->
<div class="modal fade" id="takeAttendanceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="takeAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="takeAttendanceModalLabel">Mark Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
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
            <div class="modal-body">
                <div class="row fw-bold mb-4 bg-light p-2 pt-3 rounded">
                    <div class="col-md-4 mb-2">CSC501</div>
                    <div class="col-md-4 mb-2">Introduction to Networking</div>
                    <div class="col-md-4 mb-2">Total classes: 21</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="border video-container bg-light mb-2">
                            <video id="video" autoplay></video>
                            <canvas id="overlay"></canvas>
                            <canvas id="canvas" class="d-nodne"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-12 col-md-5 col-lg-7 mt-5 mt-md-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>AJANLEKOKO Ojetunji Fiditi</td>
                                </tr>
                                <tr>
                                    <td>Matric No.:</td>
                                    <td>CSS/1954/###</td>
                                </tr>
                                <tr>
                                    <td>Department:</td>
                                    <td>Computer Science</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>Student Disabled</td>
                                </tr>
                                <tr>
                                    <td><x-form.button
                                            defaultText="<i class='mdi mdi-calendar-check me-2'></i> Mark Attendance"
                                            class="btn-lg btn-primary" /></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" id="start" class="btn btn-light waves-effect waves-light"><i
                                class='mdi mdi-play me-2'></i> Start Camera</button>
                        <button type="button" id="stop" style="display:none;"
                            class="btn btn-danger waves-effect waves-light"><i class='mdi mdi-stop me-2'></i> Stop
                            Camera</button>
                        <button type="button" id="capture" style="display:none;"
                            class="btn btn-primary waves-effect waves-light"><i class='mdi mdi-camera-enhance me-2'></i>
                            Capture</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
