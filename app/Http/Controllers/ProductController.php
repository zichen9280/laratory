<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list()
    {
        $product = Product::all();
        return view('products', ['product' => $product]);
    }

    public function list_deleted()
    {
        $product = Product::all();
        return view('productsDelete', ['product' => $product]);
    }

    public function create()
    {
        return view('modals/products/create');
    }

    public function store(Request $request)
    {
        $response = ['status' => 0, 'message' => 'Fail to create product.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'upc' => 'string|required',
            'sku' => 'string|required',
            'remark' => 'string|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->upc = $request->upc;
            $product->sku = $request->sku;
            $product->remark = $request->remark;
            $product->created_by = auth()->user()->id;
            $product->save();

            $response['status'] = 1;
            $response['message'] = "Product Created Successfully.";
        }

        return $response;
    }

    public function view($id)
    {
        $product = Product::find($id);
        return view('modals.products.view', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $users = User::all();
        return view('modals.products.edit', ['product' => $product, 'users'=>$users]);
    }

    public function update(Request $request, $id)
    {

        $response = ['status' => 0, 'message' => 'Fail to update product.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'upc' => 'string|required',
            'sku' => 'string|required',
            'remark' => 'string|required',
            'adminId' => 'required',
            'password' => 'string|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        } else {
            $validPin = (new PinValidateController)->pinVal($request->adminId, $request->password);
        }

        if ($validPin == false) {
            $response['status'] = 2;
            $response['message'] = 'Incorrect pin.';
            return $response;

        }

        if ($validPin == true) {
            $product = Product::where('id', $id)->first();
            $product->name = $request->name;
            $product->upc = $request->upc;
            $product->sku = $request->sku;
            $product->remark = $request->remark;
            $product->updated_by = auth()->user()->id;
            $product->save();
            $response['status'] = 1;
            $response['message'] = "Product Updated Successfully.";
        }

        return $response;

    }

    public function delete($id)
    {

        $response = ['status' => 0, 'message' => 'Fail to delete product.'];
        $stocks = Stock::all();
        $exists = false;
        foreach ($stocks as $stock) {
            if ($stock['product_id'] == $id && $stock['status'] == 'In Stock')
                $exists = true;
        }
        $product = Product::find($id);
        return view('modals.products.delete', ['product' => $product], ['exists' => $exists]);
    }

    public function destroy(Request $request, $id)
    {

        $stocks = Stock::all();
        $exists = false;
        foreach ($stocks as $stock) {
            if ($stock['product_id'] == $id && $stock['status'] == 'In Stock')
                $exists = true;
        }

        if (!$exists) {
            $product = Product::where('id', $id)->first();
            $product->deleted_by = auth()->user()->id;
            $product->deleted_at = now();
            $product->save();

            $response['status'] = 1;
            $response['message'] = "Product Deleted Successfully.";
        } else {
            $response['status'] = 0;
            $response['message'] = "Product Not Deleted.";
        }

        return $response;

    }

}
