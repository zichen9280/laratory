<form id="view_product">
    <!--begin::Form-->
    <div class="card-header mb-3">
        <h3 class="card-title">View Product</h3>
    </div>
    <div class="card-body">
        <!--begin::row-->
        <div class="row">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID</label>
                <!--end::Label-->
                <input type="text" name="id" class="form-control"
                       value="{{$product->id}}" readonly>
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Universal Product Code</label>
                <!--end::Label-->
                <input type="text" name="Universal Product Code" class="form-control"
                       value="{{$product->upc}}" readonly>
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Stock Keeping Unit</label>
                <!--end::Label-->
                <input type="text" name="Stock Keeping Unit" class="form-control"
                       value="{{$product->sku}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Remark</label>
                <!--end::Label-->
                <input type="text" name="remark" class="form-control"
                       value="{{$product->remark}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created By</label>
                <!--end::Label-->
                <input type="text" name="created_by" class="form-control"
                       value="{{$product?->create_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created At</label>
                <!--end::Label-->
                <input type="text" name="created_at" class="form-control"
                       value="{{$product->created_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated By</label>
                <!--end::Label-->
                <input type="text" name="updated_by" class="form-control"
                       value="{{$product?->update_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated At</label>
                <!--end::Label-->
                <input type="text" name="updated_at" class="form-control"
                       value="{{$product->updated_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted by</label>
                <!--end::Label-->
                <input type="text" name="deleted_by" class="form-control"
                       value="{{$product?->delete_user?->name}}"
                       readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted At</label>
                <!--end::Label-->
                <input type="text" name="deleted_at" class="form-control"
                       value="{{$product->deleted_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-9 bg-light mt-5">
        <input type="hidden" name="action" value="create_product">
        <a type="button" class="btn btn-primary" onclick="redirect_page()" >Back</a>
    </div>
</form>

<script>
    function redirect_page() {
        var deleted_at = '{{$product->deleted_by}}';
        if (deleted_at == '') {
            document.location.href = '{{route('product.list')}}';
        } else {
            document.location.href = '{{route('product.list.deleted')}}';
        }
    }
</script>
