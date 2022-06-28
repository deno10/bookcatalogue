<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {
    private $targetDirectory;

    public function __construct($targetDirectory) {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file): ?string
    {
        $newFilename = uniqid() . '.' . $file->guessExtension();
        try {
            $file->move($this->getTargetDirectory(), $newFilename);
        } catch (FileException $e) {
            return null;
        }
        return $newFilename;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}