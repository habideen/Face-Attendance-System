<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition Attendance</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Face Recognition Attendance System</h2>

        @if (session('enrollStatus'))
            <div class="alert alert-success">
                {{ session('enrollStatus') }}
            </div>
        @elseif (session('enrollError'))
            <div class="alert alert-danger">
                {{ session('enrollError') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">Enroll Face</div>
            <div class="card-body">
                <form action="{{ url('/enroll') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="enrollImage">Upload Image</label>
                        <input type="file" class="form-control-file" id="enrollImage" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enroll</button>
                </form>
            </div>
        </div>

        @if (session('attendanceStatus'))
            <div class="alert alert-success">
                {{ session('attendanceStatus') }}
            </div>
        @elseif (session('attendanceError'))
            <div class="alert alert-danger">
                {{ session('attendanceError') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">Check Attendance</div>
            <div class="card-body">
                <form action="{{ url('/check-attendance') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="attendanceImage">Upload Image</label>
                        <input type="file" class="form-control-file" id="attendanceImage" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Check Attendance</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
