<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\Brand;
use DB;
use Auth;
use App\Http\Requests\BrandRequest;

class BrandController  extends Controller
{
    public function view(){
        $data['allData'] = Brand::all();
        return view ('backend.brand.view-brand',$data);
     }
 
    public function add(){
        return view('backend.brand.add-brand');
     }
 
 
    public function store(Request $request){
        $this->validate($request,[
            'name' =>'required|unique:brands,name'
        ]);
        $data= new Brand();
        $data->name = $request->name;
        $data->created_by= Auth::user()->id;
        $data->save();
        return redirect()->route('brands.view')->with('success','Data Inserted successfully');
     }
 
    public function edit($id){
        $editData = Brand::find($id);
        return view('backend.brand.add-brand',compact('editData'));
     }
 
    public function update(BrandRequest $request,$id){
        $data = Brand::find($id);
        $data->name = $request->name;
        $data->updated_by=Auth::user()->id;
        $data->save();
       return redirect()->route('brands.view')->with('success','Data updated successfully');
     }
 
 
     public function delete($id){
       $brand = Brand::find($id);
       $brand->delete();
       return redirect()->route('brands.view')->with('success','Data Delete successfully');
     }
}
