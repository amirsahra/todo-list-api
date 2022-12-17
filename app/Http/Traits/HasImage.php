<?php

namespace App\Http\Traits;


use App\Exceptions\ImageNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait HasImage
{
    private function generateImageName(string $type): string
    {
        return Carbon::now()->microsecond . Str::random(8) . '.' . $type;
    }

    private function generateImageDir(string $configImagePathKey): string
    {
        return Config::get('todosettings.path.' . $configImagePathKey);
    }

    private function imageExists(string $imagePath): bool
    {
        return File::exists($imagePath);
    }

    private function deleteImage(string $imagePath): bool
    {
        if (!$this->imageExists($imagePath)) {
            throw new ImageNotFoundException();
        }
        return File::delete($imagePath);
    }

    private function moveImage(UploadedFile $image, string $imageDir, string $imageName)
    {
        $image->move(public_path($imageDir), $imageName);
    }

    protected function uploadImage(UploadedFile $imageKeyRequest, string $configKey)
    {
        $imageName = $this->generateImageName($imageKeyRequest->extension());
        $imageDir = $this->generateImageDir($configKey);
        $this->moveImage($imageKeyRequest, $imageDir, $imageName);
        return $imageDir. $imageName;
    }

    protected function updateImage(UploadedFile $imageKeyRequest, string $configKey, string $imagePath)
    {
        if ($this->imageExists($imagePath))
            $this->deleteImage($imagePath);
        return $this->uploadImage($imageKeyRequest, $configKey);
    }
}
