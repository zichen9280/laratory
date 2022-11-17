<form id="sold_stock">
    @csrf
    <div class="alert" id="response-message"></div>
    <!--begin::Form-->
    <div class="card-header">
        <h3 class="card-title">Sell Stock</h3>

    </div>
    <div class="card-body">
        <!--begin::row-->
        <div class="row">
            <!--begin::col-->
            <div class="col-md-6 mt-5">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Stock ID</label>
                <!--end::Label-->
                <input type="text" name="id" class="form-control"
                       value="{{$stock->id}}" readonly>
            </div>
            <!--end::col-->
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class="fw-semibold fs-6 mb-2 mt-5">Product Name</label>
                <!--end::Label-->
                <input type="text" name="product_name" class="form-control" value="{{$stock->product_of->name}}" readonly>
            </div>
            <!--end::col-->
        </div>
        <!--end::row-->
        <div class="row mt-5">
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Cost</label>
                <!--end::Label-->
                <input type="number" name="cost" class="form-control"
                       value="{{$stock->cost}}" readonly>
            </div>
            <!--begin::col-->
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Sell Price</label>
                <!--end::Label-->
                <input type="number" name="sell_price" class="form-control"
                       value="{{$stock->sell_price}}" readonly>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">Remark</label>
                <!--end::Label-->
                <input type="text" name="remark" class="form-control"
                       value="{{$stock->remark}}" readonly>
            </div>
        </div>
        <div class="row mt-5">

            <input type="hidden" name="status" value="Sold">
            <!--begin::col-->

            <div class="col-md-6">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb- required">Sold To</label>
                <!--end::Label-->
                <select name="sold_to" class="form-control" id="sold_to" onchange="checker()">
                    <option hidden>Select Customer</option>
                    @foreach ($customer as $row)
                        @if($row->deleted_by == null)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-center py-6 px-9 bg-light mt-5">
        <input type="hidden" name="action" value="sold_stock">
        <button type="submit" class="btn btn-lg btn-info" id="submit_sold_to" disabled>Select Customer</button>
        <button type="button" class="btn btn-lg btn-secondary" id="cancel_create" style="margin-left: 25px" onclick="document.location.href= '{{route('stock.list')}}'">Cancel</button>
    </div>
</form>
<script>
    function checker(){
        let checker = document.getElementById("sold_to").innerHTML;
        let control = "Select Customer";

        if(checker != control){
            document.getElementById("submit_sold_to").innerHTML = 'Sell';
            document.getElementById("submit_sold_to").disabled = false;
        }
    }
</script>
<script>
    var formId = '#sold_stock'; // Setup form id variable with # here

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
            url: "{{route('stock.sold',$stock->id)}}",
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
                    //thisForm.trigger("reset"); // Reset the form fields
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
