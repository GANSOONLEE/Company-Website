<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css"rel="stylesheet">
    <link href="{{asset('css\ui\table.css')}}" rel="stylesheet">
  </head>
  <body>

    <button id="refreshButton" class="refreshButton">{{trans('product.refresh')}}</button>

    <!-- Modal -->
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{trans('product.edit')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{ route('products.update', ['productID' => '__PRODUCT_ID__']) }}"  method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
              <div class="mb-3">
                <label for="productName" class="form-label">{{trans('product.name')}}</label>
                <input name="productName" type="text" class="form-control" id="productName" placeholder={{trans('product.name')}}>
              </div>
              <div class="mb-3">
                <label for="productCode" class="form-label">{{trans('product.code')}}</label>
                <input name="productCode" type="text" class="form-control" id="productCode" placeholder={{trans('product.code')}}>
              </div>
              <div class="mb-3">
                <label for="productType" class="form-label">{{trans('product.type')}}</label>
                <input name="productType" type="text" class="form-control" id="productType" placeholder={{trans('product.type')}}>
              </div>
              <div class="mb-3">
                <label for="productCatelog" class="form-label">{{trans('product.catelog')}}</label>
                <input name="productCatelog" type="text" class="form-control" id="productCatelog" placeholder={{trans('product.catelog')}}>
              </div>
              <div class="mb-3">
                <label for="productModel" class="form-label">{{trans('product.model')}}</label>
                <input name="productModel" type="text" class="form-control" id="productModel" placeholder={{trans('product.model')}}>
              </div>
              <div class="mb-3">
                <label for="productBrand" class="form-label">{{trans('product.brand')}}</label>
                <input name="productBrand" type="text" class="form-control" id="productBrand" placeholder={{trans('product.brand')}}>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('product.cancel')}}</button>
              <button type="submit" class="btn btn-primary">{{trans('product.save')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div id="wrapper"></div>

    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="{{asset('js\ui\table.js')}}"></script>
   
  </body>
</html>


