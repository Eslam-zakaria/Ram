<?php

namespace App\Http\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class UploaderService
{
    public function upload(UploadedFile $file, string $directory = 'default')
    {
        $datePath = date("Y") . '/' . date('m') . '/' . date('d') . '/';
        $path = public_path() . '/uploads/' . $directory . '/' . $datePath;

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $fileName = date('YmdHis'). mt_rand() . '_' . $directory . '.' . $file->getClientOriginalExtension();

        if ($file->move($path, $fileName)) {
            return $img = '/uploads/' . $directory . '/' . $datePath . $fileName;
        }
    }
}
