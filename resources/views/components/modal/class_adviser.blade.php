<!-- Static Backdrop Modal -->
<div class="modal fade" id="classAdviserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="classAdviserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classAdviserModalLabel">Use as Class Adviser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/admin/staff/class_adviser" class="mt-5 mb-3">
                    @csrf

                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                    <div class="row mb-4">
                        <div class="form-group mb-3 col-sm-12">
                            <label for="department_id">Department <span class="text-danger">*</span>
                            </label>
                            <select name="department_id" id="department_id" class="form-control form-select" required>
                                <option value=""></option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <x-form.input name="admission_session" label="Session To Manage" type="text" required='true'
                            parentClass="mb-3 col-sm-12" placeholder="e.g 2022/2023" pattern="^\d{4}\/\d{4}$"
                            value="{{ old('admission_session') }}" />

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
