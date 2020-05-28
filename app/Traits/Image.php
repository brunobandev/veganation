<?php


namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;

trait Image
{
    public function uploadOne($file, $path)
    {
        if (! $this->createDirectory($path)) {
            throw new \Exception('Fail to create directory');
        }

        $filename = time() . rand(0, 100) . '.' . $file->getClientOriginalExtension();

        ImageIntervention::make($file)->resize(null, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->fit(730, 450, function ($constraint) {
            $constraint->upsize();
        })->save($path.'/'.$filename);

        ImageIntervention::make($file)->resize(null, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->fit(300, 300, function ($constraint) {
            $constraint->upsize();
        })->save($path.'/thumb_'.$filename);

        return $filename;
    }

    private function createDirectory($dir): bool
    {
        if (! File::isDirectory($dir)) {
            return File::makeDirectory($dir, 0775, true, true);
        }

        return true;
    }

    public function cleanDirectory($dir = null)
    {
        if (! File::isDirectory($dir)) {
            return true;
        }

        return File::cleanDirectory($dir);
    }

    public function deleteDir($dir): int
    {
        if (! File::isDirectory($dir)) {
            return true;
        }

        return File::deleteDirectory($dir);
    }
}
