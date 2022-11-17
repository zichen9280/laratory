<form id="create_customer">
    @csrf
    <div class="alert" id="response-message"></div>
    <!--begin::Form-->
    <div class="card-header">
        <h3 class="card-title">Create Customer</h3>

    </div>
    <div class="card-body">
        <!--begin::row-->
        <div class="row">
            <!--begin::col-->
            <div class="col-md-6 mt-5">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">Name</label>
                <!--end::Label-->
                <input type="text" name="name" class="form-control" placeholder="" value="" required>
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2 mt-5">Contact</label>
                <!--end::Label-->
                <input type="number" name="contact" class="form-control" placeholder="0123456789" value="" required>
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6">Email</label>
                <!--end::Label-->
                <input type="email" name="email" class="form-control" placeholder="example@example.com" value="" required>
                <input type="hidden" name="action" value="create_customer">
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-9 mt-5 bg-light">
        <button type="submit" class="btn btn-lg btn-success">Create</button>
        <button type="button" class="btn btn-lg btn-secondary" id="cancel_create" style="margin-left: 25px" onclick="document.location.href= '{{route('customer.list')}}'">Cancel</button>
    </div>
    <div>
        <input type="hidden" name="action" value="create_customer">
    </div>
</form>
<script>
    var formId = '#create_customer'; // Setup form id variable with # here

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
            url: "{{route('customer.create')}}",
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
