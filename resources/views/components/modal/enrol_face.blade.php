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
                    <p class="h5 col-12 mb-4">
                        {{ $user->school_id . ' => ' . $user->sname . ' ' . $user->fname . ' ' . $user->mname }}</p>
                    <div class="col-sm-5 col-md-4 col-lg-3">
                        <div class="border video-container bg-light mb-2">
                            <video id="video" autoplay></video>
                            <canvas id="overlay"></canvas>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-sm-5 col-md-4 col-lg-3">
                        <div class="enrolmentHeight mb-2">
                            <canvas id="canvas"></canvas>
                            <img src="/assets/images/users/avatar.jpg" id="result" alt="Cropped Face"
                                class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" id="start" class="btn btn-light waves-effect waves-light"><i
                                class='mdi mdi-play me-2'></i> Start Camera</button>
                        <button type="button" id="stop" style="display:none;"
                            class="btn btn-danger waves-effect waves-light"><i class='mdi mdi-stop me-2'></i> Stop
                            Camera</button>
                        <button type="button" id="capture" style="display:none;"
                            class="btn btn-primary waves-effect waves-light"><i class='mdi mdi-camera-enhance me-2'></i>
                            Capture</button>

                        <form action="/{{ Session::get('user_path') }}/students/enroll/{{ $user->id }}"
                            method="post" class="{{ $user->face_enrolled ? 'd-block mt-5' : 'd-inline ms-4' }}"
                            id="enrol_form">
                            @csrf
                            <input type="hidden" name="image" id="image_value" value="" required>
                            @if ($user->face_enrolled)
                                <div class="form-group col-lg-2 col-md-3 col-sm-4">
                                    <label for="password">Confirm your password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                            @endif
                            <button type="submit"
                                class="btn btn-info waves-effect waves-light {{ $user->face_enrolled ? 'mt-3' : '' }}"><i
                                    class='mdi mdi-plus me-2'></i>{{ $user->face_enrolled ? 'Enrol face again' : 'Enrol Face' }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
