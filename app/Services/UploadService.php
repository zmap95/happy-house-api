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
}
