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

    
    public function index($productCatelog){
        // 查詢現有的車款
        $models = productModel::orderBy('modelName', 'asc')->get();

        $productsData = Product::where('productCatelog', $productCatelog)
            ->orderBy('productModel', 'asc')
            ->get(['productImage', 'productName', 'productCode', 'productModel']);

        $catelog = ProductCatelog::where('catelogName', $productCatelog)->first();

        if (!$catelog) {
            // 不存在匹配的产品目录记录，重定向到指定路由
            return redirect(route('catelog'));
        }

        return view('frontend.products', ['products' => $productsData, 'models' => $models, 'productCatelog' => $productCatelog]);
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
            'productModel' => json_encode($request->input('productModel',[])), // 序列化 productModel 字段
            'productImage' => $encodedImage, // 上传的产品图像文件
        ];

        // 将 $data 存储到数据库中
        Product::createProduct($data);

        $dataOrigin = ($request->input('productModel',[]));
        $data =  implode(', ', $dataOrigin);
        // 重定向到产品列表页面或其他适当的页面
        return back()->with('serializedModels', $data);

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