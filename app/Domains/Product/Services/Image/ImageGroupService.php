<?php

namespace App\Domains\Product\Services\Image;

/**
 *  導入方法
 *  @return object
 */

use App\Domains\Product\Events\Image\CreatedImageGroupEvent;
use App\Domains\Product\Events\Image\UpdatedImageGroupEvent;
use App\Domains\Product\Events\Image\DeletedImageGroupEvent;

use Illuminate\Http\Request;

class ImageGroupService{

    public function create(Request $request, $retrievedProductID): void{
        $createImageGroup = new CreatedImageGroupEvent;
        $createImageGroup->create($request, $retrievedProductID);
    }

    public function update(): object{
        return new UpdatedImageGroupEvent;
    }

    public function delete(): object{
        return new DeletedImageGroupEvent;
    }

}