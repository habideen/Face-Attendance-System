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

    public function index()
    {
        return view('index');
    }

    public function enroll(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $image = file_get_contents($request->file('image')->getRealPath());
        $collectionId = 'attendance_collection';

        $this->rekognition->createCollection($collectionId);
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
}
