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
    $result = $this->rekognition->indexFaces([
      'CollectionId' => $collectionId,
      'Image' => [
        'Bytes' => $image,
      ],
      'ExternalImageId' => uniqid(),
      'DetectionAttributes' => ['ALL'],
    ]);

    if (!empty($result['FaceRecords'])) {
      return $result['FaceRecords'][0]['Face']['FaceId'];
    } else {
      return null;
    }
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

  public function listCollections()
  {
    return $this->rekognition->listCollections();
  }

  public function describeCollection($collectionId)
  {
    return $this->rekognition->describeCollection([
      'CollectionId' => $collectionId,
    ]);
  }

  public function listFaces($collectionId)
  {
    return $this->rekognition->listFaces([
      'CollectionId' => $collectionId,
    ]);
  }

  public function deleteFaces($collectionId, $faceIds)
  {
    return $this->rekognition->deleteFaces([
      'CollectionId' => $collectionId,
      'FaceIds' => $faceIds,
    ]);
  }
}
