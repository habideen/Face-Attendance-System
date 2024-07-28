<!-- Static Backdrop Modal -->
<div class="modal fade" id="removeLecturerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="removeLecturerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLecturerModalLabel">Remove Lecturer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" class="mt-5 mb-3">
                    @csrf

                    <input type="hidden" name="user_id" id="user_id">
                    <p class="h4 text-center">Remove this lecturer from this course?</p>
                    <p id="user_fullname" class="text-center">Prof AKINRINDE Olakilekun Ajanlekoko</p>

                    <div class="row mb-4">
                        <x-form.input name="password" label="Password" type="password" required='true'
                            parentClass="mb-3 mt-4 col-12" placeholder="*****"
                            bottomInfo="This helps us reduce attack" />
                    </div>

                    <div class="text-center mt-5">
                        <x-form.button defaultText="Detach" class="btn-lg btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
