<form id="edit_product">
    @csrf
    <div class="alert" id="response-message"></div>
    <!--begin::Form-->
    <div class="card-header">
        <h3 class="card-title ">Update Product</h3>

    </div>
    <div class="card-body">
        <!--begin::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID</label>
                <!--end::Label-->
                <input type="text" name="product_id" class="form-control" value="{{$product->id}}" readonly>
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Name</label>
                <!--end::Label-->
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Universal Product Code</label>
                <!--end::Label-->
                <input type="text" name="upc" class="form-control" value="{{$product->upc}}">
            </div>
            <!--end::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Stock Keeping Unit</label>
                <!--end::Label-->
                <input type="text" name="sku" class="form-control" value="{{$product->sku}}">
            </div>
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Remark</label>
                <!--end::Label-->
                <input type="text" name="remark" class="form-control" value="{{$product->remark}}">
            </div>
            <!--end::col-->
            <!--end::row-->
        </div>
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-5 bg-light mt-5">

        <input type="hidden" name="action" value="edit_product">
        <label class=" fw-semibold fs-6 mb-2 mt-3">Username: </label>
        <input type="hidden" name="password" id="adminPassword">
        <select name="adminId" class="form-control me-5 ml-2 px-5 w-lg-auto">
            @foreach($users as $user)
                @if($user->id == auth()->user()->id)
                    <option value="{{$user->id}}" selected hidden> {{$user->name}} </option>
                @endif
                    <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-lg btn-success" id="updateProduct">Update</button>
        <button type="button" class="btn btn-lg btn-secondary ml-5" id="cancel_create"
                onclick="document.location.href= '{{route('product.list')}}'">Cancel
        </button>
    </div>
</form>

<script>
    var formId = '#edit_product'; // Setup form id variable with # here
    var pin_error = 0;

    $(formId).submit(async function (event) {
        event.preventDefault(); // Prevent form submission normally

        if (pin_error)
            var redtext = '<b style="color: red;">Incorrect PIN</b>';
        else
            var redtext = "";

        await Swal.fire({
            title: 'Enter Your PIN',
            html: redtext,
            input: 'password',
            inputPlaceholder: 'Enter your PIN',
            inputAttributes: {
                required: true,
                maxlength: 10,
                autocapitalize: 'off',
                autocorrect: 'off'
            },
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementsByName('password')[0].value = result.value;

                var thisForm = $(this);
                var formInputs = thisForm.find("input, textarea, button, select");	// Select all the inputs in the form
                var responseMessageDiv = document.getElementById('response-message');

                // Serialize the data in the form for Ajax submit
                var formData = thisForm.serialize(); // Use this line if form is text only without file upload
                // var formData = new FormData(this); // Use this line if form is multipart / involve file upload

                // Disable inputs during Ajax submission & show processing message
                formInputs.prop("disabled", true);
                responseMessageDiv.classList.remove("alert-success", "alert-danger", "alert-warning", "alert-info");
                responseMessageDiv.classList.add("alert-warning");
                responseMessageDiv.innerHTML = "Processing your request, please wait..."; // Display a message as AJAX is submitted, to let user know it's processing.

                $.ajax({
                    url: "{{route('product.edit',$product->id)}}",
                    method: "POST",
                    dataType: "json",
                    // contentType: false,       // Uncomment these 3 lines if the form is multipart / involve file upload - The content type used when sending data to the server.
                    // cache: false,             // To enable request pages to be cached
                    // processData: false,       // To send DOMDocument or non processed data file it is set to false
                    data: formData,
                    // Will execute when ajax request is success
                    success: function (response) {
                        responseMessageDiv.classList.remove("alert-success", "alert-danger", "alert-warning");
                        if (response['status'] == 1) {
                            responseMessageDiv.classList.add("alert-success");
                            responseMessageDiv.innerHTML = response['message'];
                            //thisForm.trigger("reset"); // Reset the form fields
                            setTimeout(function () {
                                location.reload();
                            }, 500); // Refresh the page
                            // setTimeout(function(){ location.href = "https://www.google.com"; }, 500); // Redirect to specific page
                        }
                        if (response['status'] == 0) {
                            responseMessageDiv.classList.add("alert-danger");
                            responseMessageDiv.innerHTML = response['message'];
                        }
                        if (response['status'] == 2) {
                            responseMessageDiv.classList.add("alert-info");
                            responseMessageDiv.innerHTML = response['message'];
                            pin_error = 1;
                            thisForm.submit();
                        }

                    },
                    // Will execute when ajax request is failed
                    error: function (response) {
                        if (response['message'] == 0)
                            responseMessageDiv.innerHTML = "Server Connection Error, Error: " + response['message'] + " | No Internet Connection Or Server Is Down";
                        else
                            responseMessageDiv.innerHTML = 'Error ' + response['status'] + ': ' + response['message'];
                    }
                })
                    // Will always execute when ajax is success or fail
                    .always(function (response) {
                        formInputs.prop("disabled", false); // Re-enable form inputs
                    });
            } else if (result.isDismissed) {
                pin_error = 0;
            }
        });
    });
</script>

<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
