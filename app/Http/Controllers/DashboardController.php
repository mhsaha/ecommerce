<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\Logo;
use App\Models\Model\Slider;
use App\Models\Model\Contact;
use App\Models\Model\About;
use App\Models\Model\Product;
use App\Models\Model\ProductSubImage;
use App\Models\Model\ProductSize;
use App\Models\Model\ProductColor;
use App\Models\Model\communucate;
use Mail;
use App\Models\User;
use Auth;
use DB;
use App\Models\Model\Shipping;
use App\Models\Model\Payment;
use App\Models\Model\Order;
use App\Models\Model\OrderDetail;
use Session;
use Cart;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['user'] = Auth::user();
    
        return view('frontend.single_page.customer-dashboard', $data);
    }

    public function editProfile(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['editData'] = User::find(Auth::user()->id);
    
        return view('frontend.single_page.customer-edit-profile', $data);
    }

    public function updateProfile(Request $request){
        $user = User::find(Auth::user()->id);
        $this->validate($request,[
            'name' => 'required' ,
            'email'  =>'required|unique:users,email,' .$user->id,
             'mobile'=> ['required','unique:users,mobile,' .$user->id,
             'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/']
           
        ]);

        $user->name =$request->name;
        $user->email =$request->email;
        $user->mobile =$request->mobile;
        $user->address =$request->address;
        $user->gender =$request->gender;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$user->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $user['image'] = $filename;
        }
        $user->save();
        return redirect()->route('dashboard')->with('success', 'Profile updated
         successfully');

        
    }
    public function passwordChange(){
            
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
    
    
        return view('frontend.single_page.customer-password-change', $data);
    }

    public function passwordUpdate(Request $request){
        if(Auth::attempt(['id'=>Auth::user()->id,'password'=>$request-> 
        current_password])){
             $user = User::find(Auth::user()->id);
             $user->password = bcrypt($request->new_password);
             $user->save();
             return redirect()->route('profiles.view')->with('success','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Sorry! your 
            current password does not match');
        }

    }

       public function payment(){
              
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        
        return view('frontend.single_page.customer-payment', $data);
    
        }

        public function paymentStore( Request  $request){
            if($request->product_id==NULL){
                return redirect()->back()->with('message','please add any product');
            }
            else{
                $this->validate($request,[
                    'payment_method'=>'required'
                 ]);
             if($request->payment_method=='Bikash' && $request->transaction_on==NULL){
                 return redirect()->back()->with('message','Please enter your transaction no');
             }
                 DB::transaction(function() use($request){
                     $payment = new Payment();
                     $payment->payment_method = $request->payment_method;
                     $payment->transaction_on = $request->transaction_on;
                     $payment->save();
                     $order = new Order();
                     $order->user_id = Auth::user()->id; 
                     $order->shipping_id = Session::get('shipping_id');
                     $order->payment_id = $payment->id;
                     $order_data = Order::orderBy('id', 'desc')->first();
                     if($order_data == null) {
                          $firstReg = '0';
                          $order_no = $firstReg +1;
                     }else{
                      $order_data = Order::orderBy('id','desc')->first()->order_no;
                      $order_no = $order_data+1;
                     }
                      $order->order_no = $order_no;
                      $order->order_total = $request->order_total;
                      $order->status ='0';
                      $order->save();
                      $contents = Cart::content();
                      foreach ($contents as $content) {
                      $order_details = new OrderDetail();
                      $order_details->order_id = $order->id;
                      $order_details->product_id = $content->id;
                      $order_details->color_id = $content->options->color_id;           
                      $order_details->size_id = $content->options->size_id;
                      $order_details->quantity = $content->qty;
                      $order_details->save();
    
                      } 
                 });
            }
    
          


              Cart::destroy();
              return redirect()->route('profiles.view')->with('success', 'Profile saved
              successfully');

             
            }

            public function orderList(){
                $data['logo'] = Logo::first();
                $data['contact'] = Contact::first();
                
                return view('frontend.single_page.customer-order', $data);
            }
            
          
}
