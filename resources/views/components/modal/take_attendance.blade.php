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
                    <div class="col-sm-6 col-md-2 mb-2">{{ $course->code }}</div>
                    <div class="col-sm-6 col-md-5 mb-2">{{ $course->title }}</div>
                    <div class="col-sm-6 col-md-2 mb-2">{{ Session::get('academic_session') }}</div>
                    <div class="col-sm-6 col-md-3 mb-2">Total classes: 21</div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="border video-container bg-light mb-2">
                            <video id="video" autoplay></video>
                            <canvas id="overlay"></canvas>
                            <canvas id="canvas" class="d-nodne"></canvas>
                        </div>
                        <div class="mt-2">
                            <button type="button" id="start" class="btn btn-light waves-effect waves-light"><i
                                    class='mdi mdi-play me-2'></i> Start Camera</button>
                            <button type="button" id="stop" style="display:none;margin-bottom:20px;"
                                class="btn btn-danger waves-effect waves-light"><i class='mdi mdi-stop'></i>
                                Stop
                                Camera</button>
                            <button type="button" id="capture" style="display:none;margin-bottom:20px;"
                                class="btn btn-primary waves-effect waves-light"><i
                                    class='mdi mdi-camera-enhance me-2'></i>
                                Capture</button>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-12 col-md-5 col-lg-7 mt-5 mt-md-0">
                        <div id="server_response" class="h5"></div>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td id="checked_name"></td>
                                </tr>
                                <tr>
                                    <td>Matric No.:</td>
                                    <td id="checked_school_id"></td>
                                </tr>
                                <tr>
                                    <td>Department:</td>
                                    <td id="checked_department"></td>
                                </tr>
                                <tr>
                                    <td>Similarity %:</td>
                                    <td id="checked_similarity"></td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td id="checked_is_disabled"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <form method="post" onsubmit="takeAttendance()">
                                            <input type="hidden" name="student_id" id="checked_student_id">
                                            <x-form.button
                                                defaultText="<i class='mdi mdi-calendar-check me-2'></i> Mark Attendance"
                                                class="btn-lg btn-primary" />
                                        </form>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
