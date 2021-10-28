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
use App\Models\Model\Size;
use App\Models\Model\Color;
use Cart;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Mail;
use App\Models\Model\Shipping;
use App\Models\Model\Payment;
use App\Models\Model\Order;
use App\Models\Model\OrderDetail;
use Auth;
use Session;



class CheckoutController extends Controller
{
    public function customerLogin(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        return view('frontend.single_page.customer-login',$data);

    }

    public function customerSingup(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        return view('frontend.single_page.customer-singup',$data);

    }

    public function signupStore(Request $request){
      DB::transaction(function() use($request){
        $this->validate($request,[
            'name' => 'required' ,
            'email'  =>'required|unique:users,email',
             'mobile'=> ['required','unique:users,mobile',
             'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
             'password' => 'min:9|required_with:password_confirmation|same:password_confirmation',
               'password_confirmation' => 'min:9'
        ]);
        $code = rand(0000,9999);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->code = $code;
        $user->status = '0';
        $user->usertype = 'customer';
        $user->save();

        $data = array(
            'email'   => $request->email,
            'code'  => $code
           
            
        );

        Mail::send('frontend.emails.verify-email', $data,  function ($message) use ($data) {
            $message->from('mhsaha16@gmail.com', 'Furnish Furniture');
            $message->to($data['email']);
            $message->subject('Please verify your email address');
        });

      });
      return redirect()->route('email.verify')->with('success', 'You have
      successfully signedup, please verify your email');
    }

    public function emailVerify(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        return view('frontend.single_page.email-verify',$data);

    }

    public function verifyStore(Request $request){
        $this->validate($request,[
            'email' => 'required' ,
            'code'  =>'required',
             
        ]);

        $checkData = User::where('email',$request->email)->where('code',$request->code)->first();
        if($checkData){
            $checkData -> status = '1';
            $checkData->save();
            return redirect()->route('customer.login')->with('success', 'You have successfully 
            verified,please login');

        }else{
            return redirect()->back()->with('error','Sorry! email or verification code doesnot match!');
        }

    }

    public function checkOut(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        return view('frontend.single_page.customer-checkout',$data);
    }

    public function checkStore(Request $request){
        $this->validate($request,[
            'name' => 'required' ,
          
             'mobile_no'=> ['required',
             'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
             'address'=> 'required'
        ]);

        $checkout = new Shipping();
        $checkout->user_id = Auth::user()->id;
        $checkout->name = $request->name;
        $checkout->email = $request->email;
        $checkout->mobile_no = $request->mobile_no;
        $checkout->address = $request->address;
        $checkout->save();
        Session::put('shipping_id',$checkout->id);
        return redirect()->route('customer.payment')->with('success','Data Saved Successfully');
    }
   

    
}
