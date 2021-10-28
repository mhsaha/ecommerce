<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Size;
use DB;
use Auth;
use App\Http\Requests\SizeRequest;

class SizeController extends Controller
{
    public function view(){
        $data['allData'] = Size::all();
        return view ('backend.size.view-size',$data);
     }
 
    public function add(){
        return view('backend.size.add-size');
     }
 
 
    public function store(Request $request){
        $this->validate($request,[
            'name' =>'required|unique:sizes,name'
        ]);
        $data= new Size();
        $data->name = $request->name;
        $data->created_by= Auth::user()->id;
        $data->save();
        return redirect()->route('sizes.view')->with('success','Data Inserted successfully');
     }
 
    public function edit($id){
        $editData = Size::find($id);
        return view('backend.size.add-size',compact('editData'));
     }
 
    public function update(SizeRequest $request,$id){
        $data = Size::find($id);
        $data->name = $request->name;
        $data->updated_by=Auth::user()->id;
        $data->save();
       return redirect()->route('sizes.view')->with('success','Data updated successfully');
     }
 
 
     public function delete($id){
       $data = Size ::find($id);
       $data->delete();
       return redirect()->route('sizes.view')->with('success','Data Delete successfully');
     }
}
