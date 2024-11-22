<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait PhotoTrait
{


    public function uploadFiles($request, $uploadPath, $model, $relationKey, $parentId)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . '_' . uniqid() . '.' . $extension;
                $image->move($uploadPath, $fileName);

                $model = new $model();
                $model::create([
                    $relationKey => $parentId,
                    'images' => $fileName,
                ]);
            }
        }
    }
    // function savePhoto($photo, $folder)
    // {
    //     if ($photo) {
    //         $file_extension = $photo->getClientOriginalExtension();
    //         $fileName = time() . '.' . $file_extension;
    //         $path = $folder;
    //         $photo->move($path, $fileName);

    //         return $fileName;
    //     }

    //     return null;
    // }


    function savePhoto($photo, $options = [])
    {
        if ($photo) {

            $folder = isset($options['folder']) ? $options['folder'] : 'photos';
            $file_extension = $photo->getClientOriginalExtension();
            $fileName = time() . '.' . $file_extension;
            $absolutePath = base_path($folder);
            $fullPath = $absolutePath . '/' . $fileName;
            $photo->move($absolutePath, $fileName);
            return $fileName;
        }

        return null;
    }

    // protected function handleFileUpload(Request $request, $uploadPath, $imageModel, $foreignKey, $foreignKeyValue)
    // {
    //     // Check if any new image is selected
    //     if ($request->hasFile('images') && $request->file('images')[0]->isValid()) {
    //         $existingImage = $imageModel::where($foreignKey, $foreignKeyValue)->first();

    //         if ($existingImage) {
    //             Storage::delete($existingImage->file_path);
    //             $existingImage->delete();
    //         }

    //         $uploadedFiles = $this->uploadFiles($request, $uploadPath, $imageModel, $foreignKey, $foreignKeyValue);

    //         return $uploadedFiles;
    //     }

    //     // If no new image is selected, return the existing image (if it exists)
    //     return $imageModel::where($foreignKey, $foreignKeyValue)->first();
    // }

    protected function handleFileUpload(Request $request, $uploadPath, $imageModel, $foreignKey, $foreignKeyValue)
    {
        // Check if any new image is selected
        if ($request->hasFile('images') && $request->file('images')[0]->isValid()) {
            $existingImage = $imageModel::where($foreignKey, $foreignKeyValue)->first();

            if ($existingImage) {
                $file_path = $existingImage->file_path;

                if ($file_path) {
                    
                    Storage::delete($file_path);
                }

                $existingImage->delete();
            }

            $uploadedFiles = $this->uploadFiles($request, $uploadPath, $imageModel, $foreignKey, $foreignKeyValue);

            return $uploadedFiles;
        }

        // If no new image is selected, return the existing image (if it exists)
        return $imageModel::where($foreignKey, $foreignKeyValue)->first();
    }
}