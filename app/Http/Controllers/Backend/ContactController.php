<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Model\Contact;
use App\Models\Model\communucate;


class ContactController extends Controller
{
    public function view(){
        $data['allData'] = Contact::all();
        return view ('backend.contact.view-contact',$data);
     }
 
    public function add(){
        return view('backend.contact.add-contact');
     }
 
 
    public function store (Request $request){
       
        $data= new Contact();
        $data->address = $request->address;
        $data->mobile_no = $request->mobile_no;
        $data->email = $request->email;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->youtube = $request->youtube;
        $data->google_plus = $request->google_plus;
        $data->created_by=Auth::user()->id;
        $data->save();
        return redirect()->route('contacts.view')->with('success','Data Inserted successfully');
     }
 
    public function edit($id){
        $editData = Contact::find($id);
        return view ('backend.contact.edit-contact',compact('editData'));
     }
 
    public function update(Request $request,$id){
        $data = Contact::find($id);
        $data->address = $request->address;
        $data->mobile_no = $request->mobile_no;
        $data->email = $request->email;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->youtube = $request->youtube;
        $data->google_plus = $request->google_plus;
        $data->updated_by=Auth::user()->id;
        $data->save();
       return redirect()->route('contacts.view')->with('success','Data updated successfully');
     }
 
 
     public function delete($id){
       $contact = Contact::find($id);
      
       $contact->delete();
       return redirect()->route('contacts.view')->with('success','Data Delete successfully');
     }

     public function viewCommunucate(){
        $allData = communucate::orderBy('id','desc')->get();
        return view('backend.contact.view-communucate', compact('allData'));
     }

     public function deleteCommunucate($id){
      $Communucate = communucate::find($id);
      $Communucate->delete();
      return redirect()->route('contacts.communicate')->with('success','Data Delete successfully');
   }
}
