<?php

namespace App\Services;

use Aws\Rekognition\RekognitionClient;

class RekognitionService
{
  protected $rekognition;

  public function __construct()
  {
    $this->rekognition = new RekognitionClient([
      'region' => config('aws.region'),
      'version' => 'latest',
      'credentials' => [
        'key' => config('aws.credentials.key'),
        'secret' => config('aws.credentials.secret'),
      ],
    ]);
  }

  public function indexFaces($image, $collectionId)
  {
    return $this->rekognition->indexFaces([
      'CollectionId' => $collectionId,
      'Image' => [
        'Bytes' => $image,
      ],
      'ExternalImageId' => uniqid(),
      'DetectionAttributes' => ['ALL'],
    ]);
  }

  public function searchFacesByImage($image, $collectionId)
  {
    return $this->rekognition->searchFacesByImage([
      'CollectionId' => $collectionId,
      'Image' => [
        'Bytes' => $image,
      ],
      'FaceMatchThreshold' => 95,
      'MaxFaces' => 1,
    ]);
  }

  public function createCollection($collectionId)
  {
    return $this->rekognition->createCollection([
      'CollectionId' => $collectionId,
    ]);
  }
}
