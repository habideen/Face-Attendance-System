<!-- Static Backdrop Modal -->
<div class="modal fade" id="takeAttendanceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="takeAttendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="takeAttendanceModalLabel">Mark Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row fw-bold mb-4 bg-light p-2 pt-3 rounded">
                    <div class="col-md-4 mb-2">CSC501</div>
                    <div class="col-md-4 mb-2">Introduction to Networking</div>
                    <div class="col-md-4 mb-2">Total classes: 21</div>
                </div>
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
                        <x-form.button defaultText="<i class='mdi mdi-calendar-check me-2'></i> Mark Attendance"
                            class="btn-lg btn-primary" />
                    </div>
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
