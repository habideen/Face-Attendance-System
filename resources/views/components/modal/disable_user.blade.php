<div class="modal fade" id="disableUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="disableUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableUserModalLabel">{{ !$user->is_disabled ? 'Disable' : 'Enable' }} User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/admin/{{ Request::segment(2) }}/{{ $user->id }}/disable" method="post"
                    class="mt-5 mb-3">
                    @csrf

                    <input type="hidden" name="new_status" id="new_status"
                        value="{{ !$user->is_disabled ? 'disable' : 'enable' }}">

                    <p class="h4 text-center">{{ !$user->is_disabled ? 'Disable' : 'Enable' }} this user?</p>
                    <p id="user_fullname" class="text-center">
                        {{ $user->title . ' ' . $user->sname . ' ' . $user->fname . ' ' . $user->mname }}</p>

                    <div class="row mb-4">
                        <x-form.input name="password" label="Password" type="password" required='true'
                            parentClass="mb-3 mt-4 col-12" placeholder="*****"
                            bottomInfo="This helps us reduce attack" />
                    </div>

                    <div class="text-center mt-5">
                        <x-form.button defaultText="Disable" class="btn-lg btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
