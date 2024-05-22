<?php

namespace App\Models;

class AmazonS3Driver extends Models
{
    private const BUCKET_URL = "https://myecommerce-gabriel.s3.amazonaws.com/";
    protected $fillable = [
        'url',
        'deleted'
    ];
    protected $table = 'upload';

    public function saveFile($file, $folder = ''): bool
    {
        try {
            $path = $file->store("public/images$folder");
            $this->updateOrCreate(["url" => self::BUCKET_URL . $path]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteFile(string $url): array
    {
        return $this->deleteField('url', $url);
    }

}
