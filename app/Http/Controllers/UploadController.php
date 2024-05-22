<?php

namespace App\Http\Controllers;

use App\Models\AmazonS3Driver;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private AmazonS3Driver $bucket;
    public function __construct()
    {
        $this->bucket = new AmazonS3Driver();
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $imageUpload = $this->bucket->saveFile($file);

        return response()->json([
            'success' => $imageUpload,
        ]);
    }

    public function delete(Request $request)
    {
        $fileUrl = $request->get('url');

        return response()->json([
            'success' => $this->bucket->deleteFile($fileUrl),
        ]);
    }
    //
}
