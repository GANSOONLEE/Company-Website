<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\productCatelog;
use App\Models\productModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{
    
    public function index($productType, $productCatelog){
        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get('modelName');

        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productType', $productType)
            ->get(['productCatelog', 'productType', 'productNameList', 'productBrandList', 'productID']);


        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('frontend.catelog'));
        }

        // $parsedDataList = []; // 创建用于存储解析后数据的数组

        // foreach ($productsData as $data) {
        //     $parsedDataList[] = json_decode($data->productSubname, true);
        // }

        // $formattedData = [];

        // foreach ($parsedDataList as $index => $item) {
        //     if (is_array($item)) {
        //         foreach ($item as $subItem) {
        //             if (is_array($subItem)) {
        //                 $brand = $subItem['brand'];
        //                 $model = $subItem['model'];
        //                 $formattedData[$index] = $brand . ' ' . $model;
        //             } else {
        //                 $formattedData[$index] = $subItem;
        //             }
        //         }
        //     } else {
        //         $formattedData[$index] = $item;
        //     }
        // }

        return view('frontend.product', [
            'productType' => $productType,
            'products' => $productsData,
            'models' => $models,
            'productCatelog' => $productCatelog,
        ]);
    }

    public function model($productType, $productCatelog, $productModel, ){

        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        // 支持模糊查询
        $productModel = '%'.$productModel.'%';

        // 查詢同時符合 $productCatelog 和 $productModel 記錄的貨品
        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productModel', 'like', '%' . $productModel . '%')
            ->where('productType', $productType)
            ->orderBy('productName', 'asc')
            ->get(['productImage', 'productName', 'productID']);

        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('catelog'));
        }

        return view('frontend.product', ['productType' => $productType, 'products' => $productsData, 'models' => $models, 'productCatelog' => $productCatelog]);
    }

    // public function search(Request $request, $productType='all'){

    //     // 查詢現有的車款
    //     $models = productModel::orderBy('modelName', 'asc')->get();

    //     $searchbarText = $request->input('searchbarText');

    //     /*
    //      *
    //      * 將使用者輸入的字進行拆分
    //      * 
    //      */
    //     $searchTerms = explode(' ', $searchbarText);
    //     $searchQuery = '';

    //     foreach ($searchTerms as $term) {
    //         $searchQuery .= '%'.$term.'%';
    //     }

    //     // 搜尋車款
    //     $modelSearch = Product::where('productModel', 'like', $searchQuery)
    //         ->where('productType', $productType)
    //         ->orderBy('productModel', 'asc')
    //         ->get(['productImage', 'productName', 'productID', 'productSubname']);

    //     // 搜尋名稱
    //     $nameSearch = Product::where('productName', 'like', $searchQuery)
    //         ->where('productType', $productType)
    //         ->orderBy('productName', 'asc')
    //         ->get(['productImage', 'productName', 'productID', 'productSubname']);

    //     // 搜尋名稱
    //     $nameSearch = Product::where('productSubname', 'like', $searchQuery)
    //         ->where('productType', $productType)
    //         ->orderBy('productName', 'asc')
    //         ->get(['productImage', 'productName', 'productID', 'productSubname']);

    //     // 搜尋編號
    //     $codeSearch = Product::where('productID', 'like', $searchQuery)
    //         ->where('productType', $productType)
    //         ->orderBy('productID', 'asc')
    //         ->get(['productImage', 'productName', 'productID', 'productSubname']);

    //     // 搜尋型号
    //     $brandSearch = Product::where('productBrand', 'like', $searchQuery)
    //         ->where('productType', $productType)
    //         ->orderBy('productID', 'asc')
    //         ->get(['productImage', 'productName', 'productID', 'productSubname']);

    //     return view('frontend.search', ['productType' => $productType,'modelSearch' => $modelSearch, 'nameSearch' => $nameSearch, 'codeSearch' => $codeSearch, 'models' => $models, 'searchbarText' => $searchbarText, 'brandSearch' => $brandSearch]);
    // }

    public function search(Request $request, $productType = 'all')
    {
        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        $searchbarText = $request->input('searchbarText');

        /*
        * 將使用者輸入的字進行拆分
        */
        $searchTerms = explode(' ', $searchbarText);
        $searchQuery = '';

        foreach ($searchTerms as $term) {
            $searchQuery .= '%' . $term . '%';
        }

        $searchFields = ['productModel', 'productName', 'productSubname', 'productID', 'productBrand'];

        $searchResults = Product::where('productType', $productType)
            ->where(function ($query) use ($searchFields, $searchQuery) {
                foreach ($searchFields as $field) {
                    $query->orWhere($field, 'like', $searchQuery);
                }
            })
            ->orderBy('productModel', 'asc')
            ->get(['productName', 'productID', 'productSubname', 'productCatelog', 'productModel']);

        return view('frontend.search', [
            'productType' => $productType,
            'modelSearch' => $searchResults,
            'nameSearch' => $searchResults,
            'codeSearch' => $searchResults,
            'models' => $models,
            'searchbarText' => $searchbarText,
            'brandSearch' => $searchResults,
            'products' => $searchResults,
        ]);

    }


    public function create(){
        // 返回创建产品的表单页面
        return view('product.create');
    }

    public function destroy($productID){
        // 删除指定的产品
        
        $product = Product::findOrFail($productID);

        $productCatelog = $product->productCatelog;
        $primaryModel = $product->primaryModel;
        $productID = $product->productID;

        Storage::disk('product')->deleteDirectory("$productCatelog/$primaryModel/$productID");

        Product::deleteProduct($productID);

        // 重定向到产品列表页面或其他适当的页面
        return redirect()->route('frontend.product.index');
    }

    public function refresh(Request $request){
        $productCatelog = $request->productCatelog;
        $productModel = $request->productModel;
        $productID = $request->productID;
        $image = $request->file('image');

        // 生成文件路径
        $filePath = "../image/{$productCatelog}/{$productModel}/{$image->getClientOriginalName()}";

        // 存储文件
        Storage::disk('public')->put($filePath, File::get($image));

        // 将路径存储到数据库
        $product = new Product;
        $product->productCatelog = $productCatelog;
        $product->productModel = $productModel;
        $product->productID = $productID;
        $product->productImage = $filePath;
        $product->save();

        // 其他操作...
    }
}