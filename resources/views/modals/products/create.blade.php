<form id="create_product">
    @csrf
    <div class="alert" id="response-message"></div>
    <!--begin::Form-->

    <div class="card-body">
        <!--begin::row-->
        <div class="row">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">Name</label>
                <!--end::Label-->
                <input type="text" name="name" class="form-control" placeholder="" value="">
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">Universal Product Code</label>
                <!--end::Label-->
                <input type="text" name="upc" class="form-control" placeholder="" value="" required>
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">Stock Keeping Unit</label>
                <!--end::Label-->
                <input type="text" name="sku" class="form-control" placeholder="" value="" required>
            </div>

            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">Remark</label>
                <!--end::Label-->
                <input type="text" name="remark" class="form-control" placeholder="" value="" required>
            </div>

            <!--end::col-->
        </div>
        <!--end::row-->
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-9 bg-light mt-5">
        <input type="hidden" name="action" value="create_product">
        <button type="submit" class="btn btn-lg btn-success">Create</button>
        <a href="{{route('product.list')}}" type="button" class="btn btn-lg btn-secondary mx-5">Cancel</a>
    </div>
</form>

<script>
    var formId = '#create_product'; // Setup form id variable with # here

    $(formId).submit(function(event){
        event.preventDefault(); // Prevent form submission normally
        var thisForm = $(this);
        var formInputs = thisForm.find("input, textarea, button, select");	// Select all the inputs in the form
        var responseMessageDiv = document.getElementById('response-message');

        // Serialize the data in the form for Ajax submit
        var formData = thisForm.serialize(); // Use this line if form is text only without file upload
        // var formData = new FormData(this); // Use this line if form is multipart / involve file upload

        // Disable inputs during Ajax submission & show processing message
        formInputs.prop("disabled", true);
        responseMessageDiv.classList.remove("alert-success", "alert-danger", "alert-warning");
        responseMessageDiv.classList.add("alert-warning");
        responseMessageDiv.innerHTML = "Processing your request, please wait..."; // Display a message as AJAX is submitted, to let user know it's processing.

        $.ajax({
            url: "{{route('product.store')}}",
            method: "POST",
            dataType: "json",
            // contentType: false,       // Uncomment these 3 lines if the form is multipart / involve file upload - The content type used when sending data to the server.
            // cache: false,             // To enable request pages to be cached
            // processData: false,       // To send DOMDocument or non processed data file it is set to false
            data: formData,
            // Will execute when ajax request is success
            success: function(response) {
                responseMessageDiv.classList.remove("alert-success", "alert-danger", "alert-warning");
                if(response['status'] == 1){
                    responseMessageDiv.innerHTML = response['message'];
                    responseMessageDiv.classList.add("alert-success");
                    thisForm.trigger("reset"); // Reset the form fields
                    setTimeout(function(){ location.reload(); }, 500); // Refresh the page
                    // setTimeout(function(){ location.href = "https://www.google.com"; }, 500); // Redirect to specific page
                }
                else{

                    responseMessageDiv.classList.add("alert-danger");
                    responseMessageDiv.innerHTML = response['message'];
                }
            },
            // Will execute when ajax request is failed
            error : function(response){
                if (response['message'] == 0)
                    responseMessageDiv.innerHTML = "Server Connection Error, Error: "+response['message']+" | No Internet Connection Or Server Is Down";
                else
                    responseMessageDiv.innerHTML = 'Error '+response['status']+': '+response['message'];
            }
        })
            // Will always execute when ajax is success or fail
            .always( function(response){
                formInputs.prop("disabled", true); // Re-enable form inputs
            });
    });
</script>
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
