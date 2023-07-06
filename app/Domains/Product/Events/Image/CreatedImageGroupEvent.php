<?php

namespace App\Domains\Product\Events\Image;

use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class CreatedImageGroupEvent
{
    public function create(Request $request, $retrievedProductID): void
    {
        $catelog = $request->input('productCatelog');
        
        $decodedArray = [];
        $imageString = $request->input('images');

        $directory = "/$catelog/";
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }
        
        // 遍历上传的照片
        foreach ($imageString as $index => $image) {
            $imageID = $this->imageIDGenerator();
            $isPrimaryImage = $index === 0 ? true : false;

            /**
             *  判斷路徑存不存在
             */
            $directory = "/$catelog/";

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // 将照片保存到磁盘，并获取照片的存储路径
            $imagePath = Storage::disk('public')->put($directory, $image, 'public');
        
            $imageData = [
                'imageID' => $imageID,
                'imagePath' => $imagePath,
                'isPrimaryImage' => $isPrimaryImage,
                'productID' => $retrievedProductID,
            ];
        
            $imagesData[] = $imageData;
        }

        // 批量插入照片数据
        Image::create($imagesData);

    }

    /**
     *  照片 ID 產生器
     *  @return int 32位唯一識別碼
     */

    public function imageIDGenerator(): string
    {
        $imageID = Str::random(16);

        // 检查生成的 imageID 是否与数据库中已有的重复
        $existingImage = Image::where('imageID', $imageID)->first();
        if ($existingImage) {
            // 如果存在重复，重新生成 imageID
            return $this->imageIDGenerator();
        }

        return $imageID;
    }
}