<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Admin\Rafting;
use Session;

class RaftingController extends Controller
{
    public function rafting()
    {
        $rafting =Rafting::with('customer')->get();
        Session::flash('page', 'rafting');
        return view('admin.rafting.view_rafting', compact('rafting'));
    }

    public function addEditRafting(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add  Rafting";
            $button ="Submit";
            $rafting = new Rafting;
            $raftingData = array();
            $message = "Rafting has been added sucessfully";
        }else{
            $title = "Edit Rafting";
            $button ="Update";
            $raftingData = Rafting::where('id',$id)->first();
            $raftingData= json_decode(json_encode($raftingData),true);
            $rafting = Rafting::find($id);
            $message = "Rafting has been updated sucessfully";
        }
        if($request->isMethod('post')) {
           $data = $request->all();
        // return($data);
            $rules = [
                'customer_id' => 'required',
                'number_of_customer' =>'required|numeric',
                'price' =>'required|numeric',
                'duration' =>'required',


            ];

            $customMessages = [
                'customer_id.required' => 'Customer Name is required',
                'number_of_customer.required' => 'Number of customer is required',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price is invalid ',
                'duration.required' => 'Duration is required',
            ];
            $this->validate($request, $rules, $customMessages);
                
            if(empty($data['paid']))
            {
                $data['paid'] = "";
            }
            if(empty($data['due']))
            {
                $data['due'] = "";
            }
            if(empty($data['total']))
            {
                $data['total'] = "";
            }
            $rafting->admin_id = auth('admin')->user()->id;
            $rafting->customer_id = $data['customer_id'];
            $rafting->number_of_customer = $data['number_of_customer'];
            $rafting->duration = $data['duration'];
            $rafting->price = $data['price'];
            $rafting->total = $data['total'];
            $rafting->paid = $data['paid'];
            $rafting->due = $data['due'];
            $rafting->save();
            Session::flash('success_message', $message);
            return redirect()->route('admin.rafting');
        }
        $customers = Customer::get();
        Session::flash('page', 'rafting');
        return view('admin.rafting.add_edit_rafting', compact('title','button','raftingData', 'customers'));
    }

    public function deleteRafting($id=null)
    {
        Rafting::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Rafting has been deleted successfully');
    }
}
