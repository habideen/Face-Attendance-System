<!-- Static Backdrop Modal -->
<div class="modal fade" id="deleteCourseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/{{ Session::get('user_path') }}/courses/{{ $course->id }}" method="post"
                    class="mt-5 mb-3">
                    @csrf
                    @method('DELETE')

                    <p class="h4 text-center">Delete this course?</p>
                    <p id="user_fullname" class="text-center mb-2 mt-4">
                        {{ $course->code }}</p>
                    <p id="user_fullname" class="text-center">
                        {{ $course->title }}</p>

                    <div class="row mb-4">
                        <x-form.input name="password" label="Password" type="password" required='true'
                            parentClass="mb-3 mt-4 col-12" placeholder="*****"
                            bottomInfo="This helps us reduce attack" />
                    </div>

                    <div class="text-center mt-5">
                        <x-form.button defaultText="Delete" class="btn-lg btn-danger" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
