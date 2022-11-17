<form id="view_customer">
    <!--begin::Form-->
    <div class="card-header">
        <h3 class="card-title mb-5">View Customer</h3>

    </div>
    <div class="card-body">
        <!--begin::row-->
        <div class="row">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID</label>
                <!--end::Label-->
                <input type="text" name="id" class="form-control" value="{{$customer->id}}" readonly>
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Name</label>
                <!--end::Label-->
                <input type="name" name="name" class="form-control" value="{{$customer->name}}" readonly>
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Contact</label>
                <!--end::Label-->
                <input type="text" name="contact" class="form-control" value="{{$customer->contact}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Email</label>
                <!--end::Label-->
                <input type="email" name="email" class="form-control" value="{{$customer->email}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created By</label>
                <!--end::Label-->
                <input type="text" name="created_by" class="form-control" value="{{$customer->create_user->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Created At</label>
                <!--end::Label-->
                <input type="text" name="created_at" class="form-control" value="{{$customer->created_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated By</label>
                <!--end::Label-->
                <input type="text" name="updated_by" class="form-control" value="{{$customer?->update_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Updated At</label>
                <!--end::Label-->
                <input type="text" name="updated_at" class="form-control" value="{{$customer->updated_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted by</label>
                <!--end::Label-->
                <input type="text" name="deleted_by" class="form-control" value="{{$customer?->delete_user?->name}}" readonly>
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Deleted At</label>
                <!--end::Label-->
                <input type="text" name="deleted_at" class="form-control" value="{{$customer->deleted_at}}" readonly>
            </div>
        </div>
        <!--end::row-->
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-9 bg-light mt-5 rounded-b-lg">
        <button type="button" class="btn btn-lg btn-primary" style="margin-left: 25px" onclick="redirect_page()">Back</button>
    </div>
</form>

<script>
    function redirect_page(){
        var deleted_by = '{{$customer->deleted_by}}';

        if (deleted_by == ''){
            document.location.href= '{{route('customer.list')}}';
        }else
            document.location.href= '{{route('customer.list.deleted')}}';
    }
</script>
