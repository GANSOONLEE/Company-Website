<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="{{asset('css\app.css')}}" rel="stylesheet">
    <link href="{{asset('css\backend\products.css')}}" rel="stylesheet">
    <title>{{trans('product.title')}}</title>
</head>
<body>
    @include('ui.sidebar')

    @if($models->isEmpty() || $catelogs->isEmpty())
        @include('ui.alert')
    @endif
    <div class="content">
        <h1>{{ trans('product.title') }}</h1>
        <hr class="split">

        <form action="/products" method="POST" enctype="multipart/form-data" class="form">
            @csrf
        
            <div class="container">
                <label for="productName" class="label">{{trans('product.name')}}</label>
                <input type="text" name="productName" id="productName" autocomplete="off" required>
            </div>
        
            <div class="container">
                <label for="productCode" class="label">{{trans('product.code')}}</label>
                <input type="text" name="productCode" id="productCode" autocomplete="off" required>
            </div>
        
            <div class="container">
                <label for="productCatelog" class="label">{{trans('product.catelog')}}</label>
                {{-- <select name="productCatelog" id="productCatelog" required>
                    @foreach ($catelogs as $option)
                        <option value="{{ $option['catelogID'] }}">{{ $option['catelogName'] }}</option>
                    @endforeach
                </select> --}}
                @foreach ($catelogs as $option)
                    <label>
                        <input type="radio" value="{{ $option['catelogName'] }}" class="catelog" name="productCatelog">
                        {{ $option['catelogName'] }}
                    </label>
                @endforeach
            </div>
        
            <div class="container">
                <div>
                    <label for="productModel" class="label">{{trans('product.model')}}</label>
                </div>
                {{-- @foreach ($models as $option)
                <option value="{{ $option['modelID'] }}">{{ $option['modelName'] }}</option>
                @endforeach --}}
                <div class="selectedArea">
                    @foreach ($models as $option)
                        <label class="modelArea">
                            <input type="checkbox" name="productModel[]" value="{{ $option['modelName'] }}" class="model">
                            <p class="modelBox">{{ $option['modelName'] }}</p>
                        </label>
                    @endforeach
                </div>

            </div>
        
            <div class="container">
                <label for="productImage" class="label">{{trans('product.image')}}</label>
                <input type="file" name="productImage" id="productImage" required accept=".jpg, .png, .jpeg">
            </div>
        
            <button type="submit">{{trans('product.submit')}}</button>
        </form> 
{{-- 
        <form action="{{ route('model.store') }}" method="POST">
            @csrf
        
            <textarea name="productModel" rows="5"></textarea>
        
            <button type="submit">提交</button>
        </form> --}}
        @php
            echo $serializedModels = session('serializedModels');   
        @endphp
    </div>
</body>
</html>