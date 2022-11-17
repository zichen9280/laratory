<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function list(){
        $stock = Stock::all();
        return view('stocks', ['stock'=> $stock]);
    }

    public function list_deleted(){
        $stock = Stock::all();
        return view('stocksDelete', ['stock'=> $stock]);
    }

    public function create(){
        $product=Product::all();
        return view('modals/stocks/create',['product'=>$product]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ['status' => 0, 'message' => 'Fail to create stock.'];


        $validator = Validator::make($request->toArray(), [
            'kt_docs_repeater_basic.*.product_id' => 'required',
            'kt_docs_repeater_basic.*.cost' =>'required',
            'kt_docs_repeater_basic.*.sell_price' =>'numeric|required',
            'kt_docs_repeater_basic.*.remark'=>'string|required',
        ]);
        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else {
            foreach($request->kt_docs_repeater_basic as $item){
                $stock = new Stock();
                $stock->product_id = $item['product_id'];
                $stock->cost = $item['cost'];
                $stock->sell_price = $item['sell_price'];
                $stock->remark = $item['remark'];
                $stock->created_by = auth()->user()->id;
                $stock->save();
            }

            $response['status'] = 1;
            $response['message'] = "Stock Created Successfully.";
        }

        return $response;
    }

    public function view($id){
        $stock = Stock::find($id);
        return view( 'modals.stocks.view', ['stock' => $stock]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $stock = Stock::find($id);
        $product = Product::all();
        return view('modals.stocks.edit', ['stock' => $stock],['product'=>$product]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = ['status' => 0, 'message' => 'Fail to update stock.'];
        $validator = Validator::make($request->toArray(), [
            'product_id' => 'numeric|required',
            'cost' =>'numeric|required',
            'sell_price' =>'numeric|required',
            'remark'=>'string|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else {
            $stock = Stock::where('id',$id)->first();
            $stock->product_id = $request->product_id;
            $stock->cost = $request->cost;
            $stock->sell_price = $request->sell_price;
            $stock->remark = $request->remark;
            $stock->updated_by = auth()->user()->id;
            $stock->save();

            $response['status'] = 1;
            $response['message'] = "Stock Updated Successfully.";
        }

        return $response;

    }

    public function edit_sell($id){
        $customer = Customer::all();
        $stock = Stock::find($id);
        return view('modals.stocks.sold', ['customer' => $customer], ['stock'=>$stock]);
    }

    public function update_sell(Request $request, $id){

        $response = ['status' => 0, 'message' => 'Fail to update stock.'];

        $validator = Validator::make($request->toArray(), [
            'sold_to' =>'numeric|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else {
            $stock = Stock::where('id',$id)->first();
            $stock->status = $request->status;
            $stock->sold_to = $request->sold_to;
            $stock->sold_at = now();
            $stock->sold_by = auth()->user()->id;
            $stock->save();

            $response['status'] = 1;
            $response['message'] = "Stock Sold.";
        }

        return $response;
    }

    public function delete($id){
        $stock = Stock::find($id);
        return view('modals.stocks.delete', ['stock' => $stock]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     */
    public function destroy(Request $request, $id) {

        $response = ['status' => 0, 'message' => 'Fail to delete stock.'];

        $stock = Stock::where('id',$id)->first();
        $stock->status = 'Deleted';
        $stock->deleted_by = auth()->user()->id;
        $stock->deleted_at = now();
        $stock->save();

        $response['status'] = 1;
        $response['message'] = "Stock Deleted Successfully.";

        return $response;

    }
}
