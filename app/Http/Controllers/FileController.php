<?php

namespace App\Http\Controllers;

use App\Models\File;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }


    public function uploadSingleFile(Request $request) {
        try {
            $file = $request->file('file');
            $newFile = new File();
            $newFile->name = $file->hashName();
            $newFile->originName = $file->getClientOriginalName();
            $newFile->fileExt = $file->extension();
            $newFile->fileSize = $file->getSize();
            $newFile->filePath = $file->storeAs('/', $file->hashName(), ['disk' => 'images']);
            $newFile->save();
            return response()->json(['message' => 'upload file success', 'file' => $newFile], 200);
        } catch (Exception $e) {
            echo $e;
        }
       
    }
}
