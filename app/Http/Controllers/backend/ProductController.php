<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\productCatelog;
use App\Models\productModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller{

    
    public function index($type, $productCatelog){
        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productType', $type)
            ->orderBy('productModel', 'asc')
            ->get(['productImage', 'productName', 'productCode', 'productModel']);

        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('catelog'));
        }

        return view('frontend.products', ['products' => $productsData, 'models' => $models, 'productCatelog' => $productCatelog]);
    }

    public function model($type, $productCatelog, $productModel){

        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        // 支持模糊查询
        $productModel = '%'.$productModel.'%';

        // 查詢同時符合 $productCatelog 和 $productModel 記錄的貨品
        $productsData = Product::where('productCatelog', $productCatelog)
            ->where('productModel', 'like', '%' . $productModel . '%')
            ->where('productType', $type)
            ->orderBy('productName', 'asc')
            ->get(['productImage', 'productName', 'productCode']);

        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('catelog'));
        }

        return view('frontend.products', ['products' => $productsData, 'models' => $models, 'productCatelog' => $productCatelog]);
    }

    public function search(Request $request){

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

        // 搜尋車款
        $modelSearch = Product::where('productModel', 'like', $searchQuery)
            ->orderBy('productModel', 'asc')
            ->get(['productImage', 'productName', 'productCode']);

        // 搜尋名稱
        $nameSearch = Product::where('productName', 'like', $searchQuery)
            ->orderBy('productName', 'asc')
            ->get(['productImage', 'productName', 'productCode']);

        // 搜尋編號
        $codeSearch = Product::where('productCode', 'like', $searchQuery)
            ->orderBy('productCode', 'asc')
            ->get(['productImage', 'productName', 'productCode']);

        return view('frontend.search', ['modelSearch' => $modelSearch, 'nameSearch' => $nameSearch, 'codeSearch' => $codeSearch, 'models' => $models, 'searchbarText' => $searchbarText]);
    }


    public function create(){
        // 返回创建产品的表单页面
        return view('products.create');
    }

    public function store(Request $request){

        // 获取上传的照片文件
        $photo = $request->file('productImage');

        // 目标高度
        $targetHeight = 300;

        // 打开图像并等比例缩小
        $image = Image::make($photo)->heighten($targetHeight, function ($constraint) {
            $constraint->upsize();
        });

        // 将图像转换为 Base64 编码
        $encodedImage = $image->encode('data-url');

        // 从请求中获取用户输入的值并创建新产品
        $data = [
            'productName' => $request->input('productName'),
            'productCode' => $request->input('productCode'),
            'productCatelog' => $request->input('productCatelog'),
            // 'productModel' => json_encode($request->input('productModel',[])), // 序列化 productModel 字段
            'productModel' => $request->input('productModel'),
            'productType' => $request->input('productType'),
            'productBrand' => $request->input('productBrand'),
            'productImage' => $encodedImage, // 上传的产品图像文件
        ];

        // 将 $data 存储到数据库中
        Product::createProduct($data);

        // $dataOrigin = ($request->input('productModel',[]));
        // $data =  implode(', ', $dataOrigin);
        // 重定向到产品列表页面或其他适当的页面
        return back();

    }

    public function edit($productID){
        // 返回编辑产品的表单页面
        $product = Product::find($productID);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $productID){
        // 从请求中获取用户输入的值并更新指定的产品
        $data = [
            'productName' => $request->input('productName'),
            'productCode' => $request->input('productCode'),
            'productCatelog' => $request->input('productCatelog'),
            'productModel' => $request->input('productModel'),
            'productImage' => $request->file('productImage') // 更新后的产品图像文件
        ];
        Product::updateProduct($productID, $data);

        // 重定向到产品列表页面或其他适当的页面
        return redirect()->route('products.index');
    }

    public function destroy($productID){
        // 删除指定的产品
        Product::deleteProduct($productID);

        // 重定向到产品列表页面或其他适当的页面
        return redirect()->route('products.index');
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