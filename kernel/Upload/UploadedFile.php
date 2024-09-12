<?php

namespace App\Kernel\Upload;

class UploadedFile implements UploadedFileInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size
    ) {}

    public function move(string $path, ?string $filename = null): string|false
    {
        // $storagePath = "/home/roman/Desktop/personal/$path";
        $storagePath = APP_PATH."/storage/$path";

        if (! is_dir($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        if ($filename != null) {
            $filename = $filename.'.'.$this->getExtension();
        }
        $filename = $filename ?? $this->randomFilename();

        $filePath = "$storagePath/$filename";

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return "$path/$filename";
        }

        // dd($filePath, $this->tmpName, "unsuc");

        return false;
    }

    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function randomFilename(): string
    {
        return md5(uniqid(rand(), true)).'.'.$this->getExtension();
    }
}
