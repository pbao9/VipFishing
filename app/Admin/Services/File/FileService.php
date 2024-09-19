<?php

namespace App\Admin\Services\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    private $disk = 'uploads';

    private $folder = '/';

    private $folderPrefix = 'public/uploads/';

    private $file;

    private $instance;

    private $status = true;

    public function setDisk($disk)
    {
        $this->disk = $disk;
        return $this;
    }

    public function setFolder($folder)
    {
        $this->folder = Str::finish($folder, '');
        // $this->folder = Str::finish($folder, '/');
        return $this;
    }

    public function setFolderForUser($path = '/')
    {
        $path = $path == '/' ? '/' : '/' . Str::finish($path, '/');
        return $this->setFolder('users/' . auth()->user()->id . $path);
    }

    public function setFolderPrefix($folderPrefix)
    {
        $this->folderPrefix = Str::finish($folderPrefix, '/');
        return $this;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function upload()
    {
        $path = $this->file->storeAs($this->folder, $this->file->hashName(), $this->disk);
        $this->instance = $this->folderPrefix . $path;
        return $this;
    }

    public function uploadFilepondEncode()
    {
        $file = json_decode($this->file, true);

        return $this->uploadFileBase64($file);
    }

    public function uploadCheckFilepondEncode($fileExists)
    {
        $file = json_decode($this->file, true);
        if (array_key_exists($file['id'], $fileExists)) {
            $this->instance = Str::after($fileExists[$file['id']], url('/'));
            return $this;
        }
        return $this->uploadFileBase64($file);

    }

    private function uploadFileBase64($file)
    {
        $fileContent = base64_decode($file['data']);

        $pathFile = $this->folder . uniqid_real() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        Storage::disk($this->disk)->put($pathFile, $fileContent);

        $this->instance = $this->folderPrefix . $pathFile;
        return $this;
    }

    public function move($pathFile, $newPath)
    {
        $newPath = $newPath . basename($pathFile);
        Storage::disk($this->disk)->move($pathFile, $newPath . basename($pathFile));
        $this->instance = $newPath;
        return $this;
    }

    public function delete($pathFile)
    {
        if ($pathFile != null && $pathFile != '') {
            Storage::disk($this->disk)->delete(Str::after($pathFile, $this->folderPrefix));
        }
        return $this;
    }

    public function deleteSimpleFiles(array $files)
    {

        $files = array_map(function ($value) {
            $value = Str::after(Str::after($value, url('/')), 'public/uploads/');
            return $value;

        }, $files);

        $files = array_filter($files, function ($value) {
            return !Str::startsWith($value, 'files/');
        });

        Storage::disk($this->disk)->delete(array_values($files));
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }


    /**
     * Upload a new avatar and replace the old one if it exists.
     *
     * @param string $folder Folder to store the avatar.
     * @param UploadedFile $newFile New avatar file.
     * @param string|null $currentAvatarPath Path to the current avatar to be replaced.
     * @return string New avatar path.
     */
    public function uploadAvatar(string $folder, UploadedFile $newFile, ?string $currentAvatarPath = null): string
    {
        // Set the storage folder
        $this->setFolder($folder);

        // Delete the existing avatar if it exists
        if ($currentAvatarPath) {
            $this->delete($currentAvatarPath);
        }

        // Upload the new file
        $path = $newFile->storeAs($this->folder, $newFile->hashName(), $this->disk);

        $this->instance = $this->folderPrefix . $path;


        return $this->instance;
    }

    /**
     * Uploads images for the specified fields and deletes old images from related models if applicable.
     *
     * @param string $folder The directory where images will be uploaded.
     * @param array $data The data array containing file information for uploading.
     * @param array $imageFields The fields within $data that need to be processed for image upload.
     * @param Model|null $model The model instance that may contain old file paths for deletion.
     * @param array $relationFields The relationships and their specific fields that need old images deleted.
     * @return array The updated $data array with new image paths.
     */
    public function uploadImages(string $folder, array $data, array $imageFields, Model $model = null, array $relationFields = []): array
    {
        foreach ($imageFields as $field) {
            if (isset($data[$field])) {
                $currentPath = $model && isset($model[$field]) ? $model[$field] : null;
                $data[$field] = $this->uploadAvatar($folder, $data[$field], $currentPath);
            }
        }
        foreach ($relationFields as $relation => $fields) {
            if ($model && isset($model->$relation)) {
                foreach ($fields as $field) {
                    if (isset($model->$relation->$field)) {
                        $this->delete($model->$relation->$field);
                    }
                }
            }
        }

        return $data;
    }


}
