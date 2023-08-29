<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{
    
    public function index($productCatelog, Request $request){
        // 查詢現有的車款
        $brands = Brand::orderBy('brandName', 'asc')->get('brandName');

        $productType = $request->input('productType');
        $productName = $request->input('productName');
        
        $productData = Product::where('product_category', $productCatelog)
            ->where('product_status', 'public')
            ->get(['product_category', 'product_name_list', 'product_brand_list', 'product_id']);

        $categories = Category::where('categoryName', $productCatelog)->first();

        if (!$categories) {

            // 若不存在匹配的物品種類记录，重定向至指定路由
            return redirect(route('frontend.catelog'));
        }

        return view('frontend.product', [
            'productData' => $productData,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }

    public function search(Request $request, $productType = 'all')
    {
        // 查詢現有的車款
        $models = Brand::orderBy('modelName', 'asc')->get();

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