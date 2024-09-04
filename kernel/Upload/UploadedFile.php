<?php

namespace App\Kernel\Upload;


class UploadedFile implements UploadedFileInterface {


    public function __construct(
        public readonly string $name,
        public readonly string $type,
        public readonly string $tmpName,
        public readonly int $error,
        public readonly int $size
    )
    {
        
    }
    public function move(string $path, string $filename = null): string|false
    {
        $storagePath = APP_PATH."/storage/$path";

        if(! is_dir($storagePath)){
            mkdir($storagePath, 0777, true);
        }



    }
};