<form id="view_stock" >
<!--begin::Form-->
<div class="card-header">
    <h3 class="card-title">View Stock</h3>
</div>
<div class="card-body">
    <!--begin::row-->
    <div class="row">
        <!--begin::col-->
        <div class="col-md-6">
            <!--begin::Label-->
            <label class=" fw-semibold fs-6 mb-2">Stock ID</label>
            <!--end::Label-->
            <input type="text" name="id" class="form-control" value="{{$stock->id}}" readonly>
        </div>
        <!--end::col-->
        <!--begin::col-->
        <div class="col-md-6">
            <!--begin::Label-->
            <label class=" fw-semibold fs-6 mb-2">Product ID</label>
            <!--end::Label-->
            <input type="name" name="product_id" class="form-control" value="{{$stock->product_id}}" readonly>
        </div>
        <!--end::col-->
    </div>
    <!--end::row-->
    <div class="row mt-5">
        <!--begin::col-->
        <div class="col-md-6">
            <!--begin::Label-->
            <label class=" fw-semibold fs-6 mb-2">Status</label>
            <!--end::Label-->
            <input type="text" name="status" class="form-control" value="{{$stock->status}}" readonly>
        </div>
        <!--end::col-->
        <div class="col-md-6">
            <!--begin::Label-->
            <label class=" fw-semibold fs-6 mb-2">Sell Price</label>
            <!--end::Label-->
            <input type="text" name="sell_price" class="form-control" value="{{$stock->sell_price}}" readonly>
        </div>
    </div>
    <div class="row mt-5">
        <!--begin::col-->
        <div class="col-md-6">
            <!--begin::Label-->
            <label class=" fw-semibold fs-6 mb-2">Remark</label>
            <!--end::Label-->
            <input type="text" name="remark" class="form-control" value="{{$stock->remark}}" readonly>
        </div>
        <!--end::col-->
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created By</label>
                <!--end::Label-->
                <input type="text" name="created_by" class="form-control" value="{{$stock->create_user->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created At</label>
                <!--end::Label-->
                <input type="text" name="created_at" class="form-control" value="{{$stock->created_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated By</label>
                <!--end::Label-->
                <input type="text" name="updated_by" class="form-control" value="{{$stock?->update_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated At</label>
                <!--end::Label-->
                <input type="text" name="updated_at" class="form-control" value="{{$stock->updated_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted by</label>
                <!--end::Label-->
                <input type="text" name="deleted_by" class="form-control" value="{{$stock?->delete_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted At</label>
                <!--end::Label-->
                <input type="text" name="deleted_at" class="form-control" value="{{$stock?->deleted_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Sold To</label>
                <!--end::Label-->
                <input type="text" name="sold_to" class="form-control" value="{{$stock?->sell_customer?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Sold By</label>
                <!--end::Label-->
                <input type="text" name="sold_by" class="form-control" value="{{$stock?->sell_user?->name}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2 ">Sold At</label>
                <!--end::Label-->
                <input type="text" name="sold_at" class="form-control mb-6" value="{{$stock?->sold_at}}" readonly>
            </div>
            <!--end::col-->
            <!--end::row-->
        </div>
        <div class="card-footer d-flex justify-content-center py-6 px-9 bg-light">
            <button type="button" class="btn btn-lg btn-primary" id="cancel_create" style="margin-left: 25px" onclick="redirect_page()">Back</button>
        </div>
    </div>
</div>
</form>

<script>
    function redirect_page() {
        var deleted_at = '{{$stock->deleted_at}}';

        if (deleted_at == '') {
            document.location.href = '{{route('stock.list')}}';
        } else {
            document.location.href = '{{route('stock.list.deleted')}}';
        }
    }
</script>
