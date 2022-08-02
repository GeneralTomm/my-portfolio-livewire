<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Customer;

class CustomerController extends Controller
{
    public function store(Request $request) {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_customer'  => 'required',          
            'no_hp' => 'required|digits_between:10,13|numeric|starts_with:08', 
            'email_customer' => 'required|email:rfc,dns'    
                     
        ]);

        if($validate->fails())
            return response(['message' => 'email atau no hp tidak valid'], 400);

        $customer = Customer::create($storeData);
        return response([
            'message' => 'Add Customer Success',
            'data' => $customer,
        ], 200);
    }

    public function update(Request $request, $cari){
        $customer = Customer::find($cari);
        if(is_null($customer)){
            return response([
                'message' => 'Customer Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
           'nama_customer'  => 'required', 
           'no_hp' => 'required|digits_between:10,13|numeric|starts_with:08',          
           'email_customer' => 'required'   
                   
        ]);

        if($validate->fails())              
            return response(['message' => 'No hp atau Email tidak valid'],400);
        
        $customer -> nama_customer = $updateData['nama_customer'];  
        $customer -> no_hp = $updateData['no_hp'];  
        $customer -> email_customer = $updateData['email_customer'];
        

        if($customer->save()){
            return response([
                'message' => 'Update Customer Success',
                'data' => $customer,
            ],200);
        }

        return response([
            'message' => 'Update customers Failed',
            'data' => null,    
            ],400);
        }
    
    public function index(){
        $customers = Customer::all();
        $customerCount = $customers ->count();
        if(count($customers)>0){
            return response([
                'count' => $customerCount,
                'message' => 'Retrieve All Success',
                'data' => $customers
            ],200);
        }

        return response([
            'data' => null
        ],404);

    }
    
    public function destroy($cari){
        $customer = Customer::find($cari);
        if(is_null($customer)){
            return response([
                'message' => 'Item Not Found',
                'data' => null
            ],404);
        }

        if($customer->delete()){
            return response([
                'message' => 'Delete Item Success',
                'data' => $customer,
            ],200);
        }

        return response([
            'message' => 'Delete customer Failed',
            'data' => null,
        ],400);

    }

    public function show($cari) {
        $customer = Customer::find($cari);

        if(!is_null($customer)) {
            return response([
                'message' => 'Retrive customer Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'customer Not Found',
            'data' => null
        ], 404);
    }

}
