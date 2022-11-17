<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $customer = Customer::all();
        return view('customers', ['customer'=> $customer]);
    }

    public function list_deleted()
    {
        $customer = Customer::all();
        return view('customersDelete', ['customer'=> $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('modals/customers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ['status' => 0, 'message' => 'Fail to crete customer.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'contact' =>'string|required',
            'email' =>'string|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->contact = $request->contact;
            $customer->email = $request->email;
            $customer->created_by = auth()->user()->id;
            $customer->save();

            $response['status'] = 1;
            $response['message'] = "Customer Created Successfully.";
        }

        return $response;
    }

    public function view($id){
        $customer = Customer::find($id);
        return view( 'modals.customers.view', ['customer' => $customer]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $customer = Customer::find($id);
        return view('modals.customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = ['status' => 0, 'message' => 'Fail to update customer.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'contact' =>'string|required',
            'email' =>'string|required|email',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else {
            $customer = Customer::where('id',$id)->first();
            $customer->name = $request->name;
            $customer->contact = $request->contact;
            $customer->email = $request->email;
            $customer->updated_by = auth()->user()->id;
            $customer->save();

            $response['status'] = 1;
            $response['message'] = "Customer Updated Successfully.";
        }

        return $response;
    }

    public function delete($id){
        $customer = Customer::find($id);
        return view('modals.customers.delete', ['customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $response = ['status' => 0, 'message' => 'Fail to delete customer.'];
        $customer = Customer::where('id',$id)->first();
        $customer->deleted_by = auth()->user()->id;
        $customer->deleted_at = now();
        $customer->save();

        $response['status'] = 1;
        $response['message'] = "Customer Deleted Successfully.";

        return $response;
    }
}
