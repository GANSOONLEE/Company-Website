<link rel="stylesheet" href={{ asset('css\frontend\includes\productList.css') }}>

<div class="product-list">

    <div class="product-list-header">
        Product
    </div>

    <div class="product-list-body">

        <div class="product-list-section">

            @if (count($products) > 0)
                @foreach ($products as $product)
                    <a href={{ route('frontend.product.detail',['productCode' => $product->productCode]) }}>
                        <div class="product-list-box">
                            <div class="product-list-product-image">
                                <img class="product-img" src="{{ Storage::url("{$product->productCatelog}/{$product->productModel}/{$product->productCode}/cover.png") }}" alt="">
                            </div>
                            <div class="product-list-product-name">
                                {{ $product->productCode}}
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

        </div>

    </div>

    <div class="product-list-footer">

    </div>

</div>