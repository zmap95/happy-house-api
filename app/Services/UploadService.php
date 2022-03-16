<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class UploadService {
    public function upload($folder = 'temporary', $file) {
        if ($folder === 'temporary') {
            $folder = '/temporary/' . now()->format('Y/m/d');
        }

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $fileName = \Illuminate\Support\Str::random(12) . time() . $file->getBasename() .'.' . $file->getClientOriginalExtension();

        Storage::disk('public')->putFileAs($folder, $file, $fileName);

        return $folder . '/' . $fileName;
    }

    public function move($from, $to) {
        if (!Storage::disk('public')->exists($from)) {
            throw new \Exception("Không tìm thấy tệp tin");
        }

        Storage::disk('public')->move($from, $to);
    }

    public function realUpload(string $folder, string $file, array $option = []) {
        $folder = $this->getUploadFolder($folder, $option);
        Storage::disk('public')->makeDirectory($folder);
        $path   =  $folder . '/' . basename($file);
        $this->move($file, $path);

        return $path;
    }

    public function copy(string $folder, $from, array $option = []){
        $folder = $this->getUploadFolder($folder, $option);
        Storage::disk('public')->makeDirectory($folder);
        $path   =  $folder . '/' . basename($from);

        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->copy($from, $path);
        }

        return $path;
    }

    public function getUploadFolder(string $folder, array $option = []) {
        return $folder . implode('-', $option);
    }

    public function deleleFile(array $del) {
        foreach ($del as $item) {
            if (Storage::disk('public')->exists($item)) {
                Storage::disk('public')->delete($item);
            }
        }
    }

    public function deleteDirectory($folder) {
        Storage::disk('public')->deleteDirectory($folder);
    }
}
