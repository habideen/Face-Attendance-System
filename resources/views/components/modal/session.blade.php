<!-- Static Backdrop Modal -->
<div class="modal fade" id="defaultSessionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="defaultSessionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultSessionModalLabel">Set Default Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="/set_default_session" class="mt-3 mb-3">
                    @csrf
                    @php
                        $startYear = 2015;
                        $currentYear = date('Y');
                        $years = [];

                        // Generate academic years in reverse order
                        for ($year = $currentYear; $year > $startYear; $year--) {
                            $prevYear = $year - 1;
                            $years[] = "$prevYear/$year";
                        }
                    @endphp

                    <select name="session" id="session" class="form-control" required>
                        <option value="">Select session</option>
                        @foreach ($years as $academicYear)
                            <option value="{{ $academicYear }}">{{ $academicYear }}</option>
                        @endforeach
                    </select>

                    <div class="mt-4 pt-2">
                        <x-form.button defaultText="Set as default" class="btn-lg btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
