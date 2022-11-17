<div id="kt_docs_repeater_basic" class="mx-10 my-10">
    <!--begin::Form group-->
    <form id="create_stock">
        @csrf
        <div class="alert" id="response-message"></div>
        <div class="form-group">
            <div data-repeater-list="kt_docs_repeater_basic">
                <div data-repeater-item>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="required fw-semibold fs-6 mb-2 mt-5">Product Name</label>
                            <select name="product_id" class="form-control ">
                                <option hidden>Product Name</option>
                                @foreach ($product as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="required fw-semibold fs-6 mb-2 mt-5">Cost</label>
                            <!--end::Label-->
                            <input type="number" name="cost" class="form-control" placeholder="" value="">

                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2 mt-5">Sell Price</label>
                            <!--end::Label-->
                            <input type="number" name="sell_price" class="form-control" placeholder="" value="">
                        </div>
                        <div class="col-md-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2 mt-5">Remark</label>
                            <!--end::Label-->
                            <input type="text" name="remark" class="form-control" placeholder="" value="">
                        </div>

                        <div>
                            <div class="col-md-4">
                                <a href="javascript:;" data-repeater-delete
                                   class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                    <i class="la la-trash-o"></i>Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Form group-->

        <!--begin::Form group-->
        <div class="form-group mt-5">
            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                <i class="la la-plus"></i>Add
            </a>
        </div>
        <div class="card-footer d-flex justify-content-center py-6 px-9 mt-10 bg-light">
            <input type="hidden" name="action" value="create_stock">
            <button type="submit" class="btn btn-lg btn-success" id="create_product">Create</button>
            <button type="button" class="btn btn-lg btn-secondary" id="cancel_create" style="margin-left: 25px" onclick="document.location.href= '{{route('stock.list')}}'">Cancel</button>
        </div>
    </form>
    <!--end::Form group-->
</div>

<script>var hostUrl = "/assets/";</script>
<script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>

<script>
    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function () {
            $(this).slideDown();
        },

        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
</script>

<script>
    var formId = '#create_stock'; // Setup form id variable with # here

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
            url: "{{route('stock.store')}}",
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
