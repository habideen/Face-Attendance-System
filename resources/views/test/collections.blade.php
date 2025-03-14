<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Collection List</h1>

        <div>
            <a href="/test/enroll" class="btn btn-primary mb-3">Enroll & Check Attendance</a> |
            <a href="/test/collections" class="btn btn-primary mb-3">View Collections</a> |
            <a href="/test/capture_face" class="btn btn-primary mb-3">Capture Face</a>
        </div>

        <ul class="list-group">
            @foreach ($collections as $collection)
                <li class="list-group-item">
                    <div>
                        <strong>Collection ID:</strong> {{ $collection['CollectionId'] }}
                        <a href="/test/collections/delete/{{ $collection['CollectionId'] }}">Delete</a>
                    </div>
                    <div>
                        <strong>Number of Faces:</strong> {{ $collection['FaceCount'] }}
                    </div>
                    <div>
                        <strong>Faces:</strong>
                        <ol class="">
                            @foreach ($collection['Faces'] as $face)
                                <li>{{ $face['FaceId'] }} <a
                                        href="/test/collections/faces/delete?collection={{ $collection['CollectionId'] }}&face_id={{ $face['FaceId'] }}">Delete</a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
