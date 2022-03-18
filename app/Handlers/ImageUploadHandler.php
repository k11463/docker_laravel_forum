<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{

    public function save($file, $folder, $file_prefix)
    {
        // 製作圖片路徑，讓查找圖片更有效率
        $folder_name = "public/uploads/images/$folder/" . date("Ym/d", time());

        $path = $file->store($folder_name);

        $correctPath = 'storage/' . str_replace('public/', '', $path);

        // 回傳圖片路徑
        return $correctPath;
    }
}
