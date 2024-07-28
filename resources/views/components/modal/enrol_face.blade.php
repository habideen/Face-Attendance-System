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
                <div class="row mt-3">
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="border text-center bg-light mb-2">
                            <img src="/assets/images/users/avatar.jpg" alt="enrol face" class="img-fluid">
                        </div>
                        <x-form.button defaultText="<i class='mdi mdi-camera-enhance me-2'></i> Scan Face"
                            class="btn-lg btn-light" />
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="border text-center bg-light mb-2">
                            <img src="/assets/images/users/avatar.jpg" alt="enrol face" class="img-fluid">
                        </div>
                        <x-form.button defaultText="<i class='mdi mdi-cloud-upload-outline me-2'></i> Enrol Face"
                            class="btn-lg btn-primary" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
