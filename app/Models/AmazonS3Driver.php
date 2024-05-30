<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

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

    public function storeAndSaveFile($data, $model, $folder = ''): bool
    {
        $file = $data['image'] ?? $data['file'];
        $relatedTableId = $model->id;
        $relatedTable = $model->getTable();
        try {
            DB::beginTransaction();
            $path = $file->store("public/images$folder");
            self::setAllMainToFalse($relatedTableId, $relatedTable);
            (new AmazonS3Driver())->updateOrCreate($this, [
                'url' => self::BUCKET_URL . $path,
                'related_table_id' => $relatedTableId,
                'related_table' => $relatedTable
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function setAllMainToFalse($relatedTableId, $relatedTable)
    {
        AmazonS3Driver::where('related_table_id', $relatedTableId)
            ->where('related_table', $relatedTable)
            ->update(['main' => 0]);
    }

    public static function renderImageFromBucket($url)
    {
        return \Illuminate\Support\Facades\Storage::disk('s3')
            ->temporaryUrl(
                $url,
                now()->addHour()
            );
    }
}
