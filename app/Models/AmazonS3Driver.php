<?php

namespace App\Models;

class AmazonS3Driver extends Models
{
    private const BUCKET_URL = "";
    protected $fillable = [
        'url',
        'related_table_id',
        'related_table',
        'main',
        'deleted'
    ];
    protected $table = 'upload';

    public function related()
    {
        return $this->morphTo();
    }
    public function saveFile($file, $folder = ''): string
    {
        try {
            return $file->store("public/images$folder");
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteFile(string $url): array
    {
        return $this->deleteField('url', $url);
    }

    public static function storeAndSaveFile($data, $model, $folder = ''): bool
    {
        $file = $data['image'] ?? $data['file'];
        $relatedTableId = $model->id;
        $relatedTable = $model->getTable();
        try {
            $path = $file->store("public/images$folder");
            (new AmazonS3Driver())->updateOrCreate([
                'url'               => self::BUCKET_URL . $path,
                'related_table_id'  => $relatedTableId,
                'related_table'     => $relatedTable
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
