<?php

namespace App\Utils;

class FileUploader
{
    private $uploadDir;

    public function __construct($dir = 'uploads/')
    {
        $this->uploadDir = __DIR__ . '/../../public/' . $dir;
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function upload($file, $subDir = '')
    {
        $targetDir = $this->uploadDir . $subDir;
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($file['name']);
        $targetFile = $targetDir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $fileName;
        }

        return false;
    }
}
