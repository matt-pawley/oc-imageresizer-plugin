<?php

namespace ToughDeveloper\ImageResizer\Classes;

use File as FileHelper;
use October\Rain\Network\Http;
use October\Rain\Database\Attach\File;
use Illuminate\Support\Facades\Storage;

trait RemoteImageTrait
{
    /**
     * Determine if a file path is a remote image
     *
     * @param string $filePath
     * @return boolean
     */
    protected function isRemoteFile($filePath)
    {
        return filter_var($filePath, FILTER_VALIDATE_URL);
    }

    /**
     * Store a remote image locally
     *
     * @param string $filePath
     * @return string
     */
    protected function getRemoteFile($filePath)
    {
        $tempImage = $this->generateStoragePath($filePath);
        $tempFullPath = storage_path('app/' . $tempImage);

        // Check if remote image was already downloaded
        if (Storage::exists($tempImage)) {
            return $tempFullPath;
        }

        // If URL doesn't have extension, check if exists a file with one of the allowed extensions
        $imageExists = $this->checkLocalRemoteImage($tempImage);

        // If found, use already downloaded image
        if ($imageExists) {
            return storage_path('app/' . $imageExists);
        }

        // Download image from remote location
        Http::get($filePath, function ($http) use ($tempFullPath) {
            $http->toFile($tempFullPath);
        });

        // If URL doesn't have extension, discover extension and rename local image
        if (!FileHelper::extension($tempFullPath)) {
            $extension = $this->discoverImageExtension($tempFullPath);
            $newFullPath = sprintf('%s%s', $tempFullPath, $extension);
            rename($tempFullPath, $newFullPath);
            $tempFullPath = $newFullPath;
        }

        return $tempFullPath;
    }

    /**
     * Generate storage path to store cached remote images
     *
     * @param string $filePath
     * @return string
     */
    protected function generateStoragePath($filePath)
    {
        $extension = FileHelper::extension($filePath);
        $tempPath = $this->file->getStorageDirectory() . $this->getPartitionDirectory();
        $tempFilename = md5($filePath);

        Storage::makeDirectory($tempPath);

        $fileMask = $extension ? '%s%s.%s' : '%s%s';

        return sprintf($fileMask, $tempPath, $tempFilename, $extension);
    }

    /**
     * If remote image doesn't expose file extension, discover by looking downloaded file
     *
     * @param string $filePath
     * @return string
     */
    protected function discoverImageExtension($filePath)
    {
        $imageType = exif_imagetype($filePath);
        $extension = image_type_to_extension($imageType);
        return $extension;
    }

    /**
     * If URL doesn't have extension, check if exists a file with one of the allowed extensions
     *
     * @param $string $filePath
     * @return Collection
     */
    protected function checkLocalRemoteImage($filePath)
    {
        $allowedExtensions = File::$imageExtensions;

        return collect($allowedExtensions)->map(function ($imageType) use ($filePath) {
            $findImage = sprintf('%s.%s', $filePath, $imageType);
            return Storage::exists($findImage) ? $findImage : false;
        })->filter()->first();
    }
}
