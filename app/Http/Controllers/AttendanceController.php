<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RekognitionService;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    protected $rekognition;

    public function __construct(RekognitionService $rekognition)
    {
        $this->rekognition = $rekognition;
    }

    public function enrolCheck()
    {
        return view('index');
    }

    public function collections()
    {
        $collections = $this->rekognition->listCollections()['CollectionIds'];

        $collectionData = [];
        foreach ($collections as $collectionId) {
            $collectionDetails = $this->rekognition->describeCollection($collectionId);
            $faces = $this->rekognition->listFaces($collectionId)['Faces'];
            $collectionData[] = [
                'CollectionId' => $collectionId,
                'FaceCount' => count($faces),
                'Faces' => $faces
            ];
        }
        $collectionData;

        return view('collections', ['collections' => $collectionData]);
    }

    public function enroll(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $image = file_get_contents($request->file('image')->getRealPath());
        $collectionId = 'attendance_collection';

        // $this->rekognition->createCollection($collectionId);
        $result = $this->rekognition->indexFaces($image, $collectionId);

        return response()->json($result);
    }

    public function checkAttendance(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $image = file_get_contents($request->file('image')->getRealPath());
        $collectionId = 'attendance_collection';

        $result = $this->rekognition->searchFacesByImage($image, $collectionId);

        if (!empty($result['FaceMatches'])) {
            return response()->json(['status' => 'Present', 'data' => $result['FaceMatches']]);
        } else {
            return response()->json(['status' => 'Absent']);
        }
    }

    public function deleteFace(Request $request)
    {
        $collectionId = $request->collection;
        $faceIds = $request->face_id;

        $result = $this->rekognition->deleteFaces($collectionId, [$faceIds]);

        // Handle the result accordingly
        if ($result['@metadata']['statusCode'] == 200) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Failed to delete faces from collection.'], 500);
        }
    }
}
