<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

class CoverProcessor {

    private $targetDirectory;

    public function __construct($targetDirectory) {
        $this->targetDirectory = $targetDirectory;
    }

    public function prepare($oldCover): ?File
    {
        try {
            return new File($this->getTargetDirectory() . '/' . $oldCover);
        } catch (FileException $e) {
            return null;
        }
    }

    public function save($cover, $oldCover, FileUploader $fileUploader): ?string
    {
        return $cover ? $fileUploader->upload($cover) : $oldCover;
    }

    public function getImage($id): ?BinaryFileResponse
    {
        try {
            $file = new File($this->getTargetDirectory() . '/' . $id);
        } catch (FileException $e) {
            try {
                $file = new File($this->getTargetDirectory() . '/nophoto.jpg');
            } catch (FileException $e) {
                return null;
            }
        }
        return new BinaryFileResponse($file);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}