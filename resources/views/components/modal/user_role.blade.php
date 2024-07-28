<!-- Static Backdrop Modal -->
<div class="modal fade" id="userRoleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="userRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userRoleModalLabel">Update Staff Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/admin/staff/role" class="mt-5 mb-3">
                    @csrf

                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                    <div class="row mb-4">
                        <x-form.switch name="is_admin" label="Admin" parentClass="mb-3 col-12"
                            ischecked="{{ $user->is_admin ? 'true' : 'false' }}" />
                        <x-form.switch name="is_adviser" label="Class Adviser" parentClass="mb-3 col-12"
                            ischecked="{{ $user->is_adviser ? 'true' : 'false' }}" />
                        <x-form.switch name="is_lecturer" label="Lecturer" parentClass="mb-3 col-12"
                            ischecked="{{ $user->is_lecturer ? 'true' : 'false' }}" />

                        <x-form.input name="password" label="Password" type="password" required='true'
                            parentClass="mb-3 mt-4 col-12" placeholder="*****"
                            bottomInfo="This helps us reduce attack" />
                    </div>

                    <div class="mt-5">
                        <x-form.button defaultText="Update Role" class="btn-lg btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
