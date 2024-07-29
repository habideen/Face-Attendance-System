<?php

namespace App\Http\Controllers\AWSRekognition;

use App\Http\Controllers\Controller;
use App\Rules\Base64Image;
use Illuminate\Http\Request;
use App\Services\RekognitionService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    protected $rekognition;
    protected string $collection = 'attendance_collection';

    public function __construct(RekognitionService $rekognition)
    {
        $this->rekognition = $rekognition;
    }

    public function enrolCheck()
    {
        return view('test.index');
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

        return view('test.collections', ['collections' => $collectionData]);
    }

    public function enroll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['required', new Base64Image]
        ]);

        if ($validator->fails()) responseError('The image format is invalid');

        // $image = file_get_contents($request->file('image')->getRealPath());
        $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $request->input('image'));
        $image = base64_decode($base64Data);

        $this->rekognition->createCollection($this->collection); // create new collection
        $faceId = $this->rekognition->indexFaces($image, $this->collection);

        if ($faceId !== null) {
            return response()->json(['faceId' => $faceId]);
        } else {
            return response()->json(['error' => 'No face was indexed.'], 400);
        }
    }

    public function checkAttendance(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $image = file_get_contents($request->file('image')->getRealPath());
        $result = $this->rekognition->searchFacesByImage($image, $this->collection);

        if (!empty($result['FaceMatches'])) {
            return response()->json(['status' => 'Present', 'data' => $result['FaceMatches']]);
        } else {
            return response()->json(['status' => 'Absent']);
        }
    }

    public function deleteFace(Request $request)
    {
        $faceIds = $request->face_id;

        $result = $this->rekognition->deleteFaces($this->collection, [$faceIds]);

        // Handle the result accordingly
        if ($result['@metadata']['statusCode'] == 200) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Failed to delete faces from collection.'], 500);
        }
    }

    public function deleteCollection($collectionId)
    {
        $result = $this->rekognition->deleteCollection($collectionId);

        // Handle the result accordingly
        if ($result['@metadata']['statusCode'] == 200) {
            return response()->json(['success' => 'Collection deleted successfully.']);
        } else {
            return response()->json(['error' => 'Failed to delete collection.']);
        }
    }
}
