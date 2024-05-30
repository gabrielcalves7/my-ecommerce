<?php

namespace App\Models;

class UploadableModelServiceProvider extends Models
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function AmazonS3Driver()
    {
        return $this->morphMany(
            AmazonS3Driver::class,
            'related',
            'related_table',
            'related_table_id'
        );
    }

    public function image()
    {
        $upload = $this->AmazonS3Driver()
            ->where('main', true)
            ->where('deleted', false)
            ->select('url');
        return $upload;
    }

    public function updateOrCreate($model,$data)
    {
        try {
            $update = parent::updateOrCreate($model,$data);
            if (isset($data['image']) || isset($data['file'])) {
                $fileUpload = (new AmazonS3Driver())->storeAndSaveFile($data, $update);
                return $update && $fileUpload;
            }
            return $update;
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }


}