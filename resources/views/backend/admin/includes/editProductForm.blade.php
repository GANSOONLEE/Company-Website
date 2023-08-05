
            
               
               
            

<!-- Modal -->
<div class="modal fade" id="editProductForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- #region -->
                <!-- Header -->
                <div class="modal-header">
                    <p class="modal-title">{{trans('product.title.edit')}}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            <!-- #endregion -->
            
            <form action={{ route('backend.admin.updatedProduct') }} method="POST" enctype="multipart/form-data" class="form">
                @csrf
                <!-- Body -->
                <div class="modal-body display-column">
                
                    <!-- #region -->
                    <div class="display-row form-body">
                        <div class="display-column">
                            <div class="mb-3">
                                <label for="productIDInput" class="form-label" >{{trans('table.productID')}}</label>
                                <input type="text" class="form-control" name="productID" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="productCatelogInput" class="form-label">{{trans('product.catelog')}}</label>
                                <select id="productCatelogList" class="form-control" name="productCatelog" required>
                                    @foreach ($catelogs as $catelog) 
                                        <option value="{{ $catelog['catelogName'] }}">{{ $catelog['catelogName'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productTypeInput" class="form-label">{{trans('table.productType')}}</label>
                                <select id="productTypeList" class="form-control" name="productType" required>
                                    <option value="Origin">Original</option>
                                    <option value="Non-Origin">Non-Original</option>
                                    <option value="Recond">Recond</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productStatusInput" class="form-label">{{trans('table.productStatus')}}</label>
                                <select id="productStatusList" class="form-control" name="productStatus">
                                    <option value="Public">Public</option>
                                    <option value="Delist">Delist</option>
                                </select >
                            </div>
                        </div>
                        <div class="display-column">
                            <div class="mb-3" id="productNameListRepeat">
                                <label for="productNameListInput" class="form-label">{{trans('table.productNameList')}}</label>
                                <div class="display-column">
                                    <input type="text" class="form-control" name="productName" required >
                                </div>
                            </div>
                        </div>
                        <div class="display-column">
                            <div class="mb-3" id="productBrandListRepeat">
                                <label for="productBrandListInput" class="form-label" >{{trans('table.productBrandList')}}</label>
                                {{-- <input type="text" class="form-control" name="productBrand" required readonly> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #endregion -->

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="deleteButton">{{trans('product.delete')}}</button>
                        <button type="submit" class="btn btn-primary" id="submitButton">{{trans('product.save')}}</button>
                    </div>
                </div>
            
                
            </form>
        </div>
    </div>
</div>
