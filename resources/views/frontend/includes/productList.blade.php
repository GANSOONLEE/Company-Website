<link rel="stylesheet" href={{ asset('css\frontend\includes\productList.css') }}>

<div class="product-list">

    <div class="product-list-header">
        Product
    </div>

    <div class="product-list-body">

        <div class="product-list-section">

            @if (count($products) > 0)
                @foreach ($products as $product)
                    @php
                        $productName = json_decode($product->productNameList)[0];
                    @endphp
                    <a href={{ route('frontend.product.detail',['productCode' => $product->getProductID()]) }}>
                        <div class="product-list-box">
                            <div class="product-list-product-image">
                                <img class="product-img" src="{{ asset("storage/{$product->productCatelog}/{$product->getProductID()}/cover.png") }}" alt="product-image">
                            </div>
                            <div class="product-list-product-name">
                                {{ $productName }}
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