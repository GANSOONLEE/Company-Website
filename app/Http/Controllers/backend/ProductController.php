<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\productCatelog;
use App\Models\productModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Database\QueryException;

use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller{
    
    public function index($productType, $productCatelog){
        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productType', $productType)
            ->orderBy('productModel', 'asc')
            ->get(['productImage', 'productName', 'productCode', 'productModel', 'productSubname']);


        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('frontend.catelog'));
        }

        $parsedDataList = []; // 创建用于存储解析后数据的数组

        foreach ($productsData as $data) {
            $parsedDataList[] = json_decode($data->productSubname, true);
        }

        $formattedData = [];

        foreach ($parsedDataList as $index => $item) {
            if (is_array($item)) {
                foreach ($item as $subItem) {
                    if (is_array($subItem)) {
                        $brand = $subItem['brand'];
                        $model = $subItem['model'];
                        $formattedData[$index] = $brand . ' ' . $model;
                    } else {
                        $formattedData[$index] = $subItem;
                    }
                }
            } else {
                $formattedData[$index] = $item;
            }
        }

        return view('frontend.products', [
            'productType' => $productType,
            'products' => $productsData,
            'models' => $models,
            'productCatelog' => $productCatelog,
        ]);
    }

    public function model($productType, $productCatelog, $productModel){

        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        // 支持模糊查询
        $productModel = '%'.$productModel.'%';

        // 查詢同時符合 $productCatelog 和 $productModel 記錄的貨品
        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productModel', 'like', '%' . $productModel . '%')
            ->where('productType', $productType)
            ->orderBy('productName', 'asc')
            ->get(['productImage', 'productName', 'productCode']);

        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('catelog'));
        }

        return view('frontend.products', ['productType' => $productType, 'products' => $productsData, 'models' => $models, 'productCatelog' => $productCatelog]);
    }

    public function search(Request $request, $productType='all'){

        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        $searchbarText = $request->input('searchbarText');

        /*
         *
         * 將使用者輸入的字進行拆分
         * 
         */
        $searchTerms = explode(' ', $searchbarText);
        $searchQuery = '';

        foreach ($searchTerms as $term) {
            $searchQuery .= '%'.$term.'%';
        }

        if($productType==='all'){

            // 搜尋車款
            $modelSearch = Product::where('productModel', 'like', $searchQuery)
                ->orderBy('productModel', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋名稱
            $nameSearch = Product::where('productName', 'like', $searchQuery)
                ->orderBy('productName', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋名稱
            $nameSearch = Product::where('productSubname', 'like', $searchQuery)
                ->orderBy('productSubname', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋編號
            $codeSearch = Product::where('productCode', 'like', $searchQuery)
                ->orderBy('productCode', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋編號
            $codeSearch = Product::where('productBrand', 'like', $searchQuery)
                ->orderBy('productCode', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋型号
            $brandSearch = Product::where('productBrand', 'like', $searchQuery)
                ->orderBy('productCode', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

        }else{
            // 搜尋車款
            $modelSearch = Product::where('productModel', 'like', $searchQuery)
                ->where('productType', $productType)
                ->orderBy('productModel', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋名稱
            $nameSearch = Product::where('productName', 'like', $searchQuery)
                ->where('productType', $productType)
                ->orderBy('productName', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋名稱
            $nameSearch = Product::where('productSubname', 'like', $searchQuery)
                ->where('productType', $productType)
                ->orderBy('productName', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋編號
            $codeSearch = Product::where('productCode', 'like', $searchQuery)
                ->where('productType', $productType)
                ->orderBy('productCode', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);

            // 搜尋型号
            $brandSearch = Product::where('productBrand', 'like', $searchQuery)
                ->where('productType', $productType)
                ->orderBy('productCode', 'asc')
                ->get(['productImage', 'productName', 'productCode', 'productSubname']);
        }

        return view('frontend.search', ['productType' => $productType,'modelSearch' => $modelSearch, 'nameSearch' => $nameSearch, 'codeSearch' => $codeSearch, 'models' => $models, 'searchbarText' => $searchbarText, 'brandSearch' => $brandSearch]);
    }


    public function create(){
        // 返回创建产品的表单页面
        return view('products.create');
    }

    public function store(Request $request){

        // 組合數據
        $primaryBrand = $request->input('primaryBrand');
        $primaryModel = $request->input('primaryModel');
        $productName = $primaryBrand . ' ' . $primaryModel;

        $secondaryBrand = $request->input('secondaryBrand');
        $secondaryModel = $request->input('secondaryModel');
        
        $combinedArray = [];
        if (isset($secondaryBrand, $secondaryModel)) {
            // 遍历数组并将每个元素组合在一起
            foreach ($secondaryBrand as $key => $brand) {
                $model = $secondaryModel[$key];
                $combinedArray[] = [
                    'brand' => strtoupper($brand),
                    'model' => strtoupper($model)
                ];
            }
            $jsonData = json_encode($combinedArray);
        } else {
            $jsonData = '';
        }
        
        // 获取上传的照片文件
        $photo = $request->file('productImage');

        // 目标高度
        $targetHeight = 900;

        // 打开图像并等比例缩小
        $image = Image::make($photo)->heighten($targetHeight, function ($constraint) {
            $constraint->upsize();
        });

        // 将图像转换为 Base64 编码
        $encodedImage = $image->encode('data-url');

        // 从请求中获取用户输入的值并创建新产品
        $data = [
            'productName' => strtoupper($productName),
            'productCode' => $request->input('productCode'),
            'productCatelog' => $request->input('productCatelog'),
            'productSubname' => $jsonData,
            'productModel' => $primaryModel,
            'productBrand' => $primaryBrand,
            'productType' => $request->input('productType'),
            'productImage' => $encodedImage, // 上传的产品图像文件
        ];

        // 将 $data 存储到数据库中
        Product::createProduct($data);

        return back();

    }

    public function edit($productID){
        // 返回编辑产品的表单页面
        $product = Product::find($productID);
        return view('frontend.products.edit', compact('product'));
    }

    public function update(Request $request, $productID){


        try {
            // 从请求中获取用户输入的值并更新指定的产品
            
            $auth = Product::where('productID', $productID)
                    ->get('productCode');

            if($auth != substr($request->input('productCode'), 0, 255)){
                
            }

            $data = [
                'productName' => substr($request->input('productName'), 0, 255),
                'productCode' => substr($request->input('productCode'), 0, 255),
                'productCatelog' => $request->input('productCatelog'),
                'productModel' => $request->input('productModel'),
                'productBrand' => $request->input('productBrand'),
                'productType' => $request->input('productType'),
            ];
            Product::updateProduct($productID, $data);
        
            $alertType = 'success';
            $message = trans("product.success");

        } catch (QueryException $err) {

            $alertType = 'warning';

            $errorCode = $err->getCode();
            if ($errorCode === '23000') {
                $errorMsg = trans("product.duplicate");
            }else{
                $errorMsg = $err->getMessage();
            }
            
            $message = trans("product.warning") . $errorMsg;
        }
        
        return redirect()->back()->with('alertType', $alertType)->with('message', $message);       
    }

    public function destroy($productID){
        // 删除指定的产品
        Product::deleteProduct($productID);

        // 重定向到产品列表页面或其他适当的页面
        return redirect()->route('frontend.products.index');
    }

    public function refresh(Request $request){
        $productCatelog = $request->productCatelog;
        $productModel = $request->productModel;
        $productCode = $request->productCode;
        $image = $request->file('image');

        // 生成文件路径
        $filePath = "../image/{$productCatelog}/{$productModel}/{$image->getClientOriginalName()}";

        // 存储文件
        Storage::disk('public')->put($filePath, File::get($image));

        // 将路径存储到数据库
        $product = new Product;
        $product->productCatelog = $productCatelog;
        $product->productModel = $productModel;
        $product->productCode = $productCode;
        $product->productImage = $filePath;
        $product->save();

        // 其他操作...
    }
}