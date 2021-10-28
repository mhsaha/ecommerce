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

class Youtube extends Controller
{
    public function index()

    {

        $data['logo'] = Logo::first();
        $data['sliders'] = Slider::all();
        $data['contact'] = Contact::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::orderBy('id','desc')->paginate(6);
        return view('frontend.layouts.home',$data);
    }

    public function productList(){

        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::orderBy('id','desc')->paginate(12);
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_page.product-list',$data);
    }



    public function categoryWiseproduct($category_id){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::where('category_id',$category_id)->orderBy('id','desc')->get();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_page.category-wise-product',$data);
    }


    public function brandWiseproduct($brand_id){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::where('brand_id',$brand_id)->orderBy('id','desc')->get();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_page.brand-wise-product',$data);
    }

    public function productDetails($slug){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['product'] = Product::where('slug',$slug)->first();
        $data['product_sub_images'] = ProductSubImage::where('product_id',$data['product']->id)->get();
        $data['product_colors'] = ProductColor::where('product_id',$data['product']->id)->get();
        $data['product_sizes'] = ProductSize::where('product_id',$data['product']->id)->get();
        
        return view('frontend.single_page.product-detail',$data);
    }

    public function aboutUs()
    {
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['about'] = About::first();
        return view('frontend.single_page.about-us', $data);
    }

    public function contactUs()
    {
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        return view('frontend.single_page.contact-us', $data);
    }

   
    public function shoppimgCart()
    {
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
       
        return view('frontend.single_page.shopping-cart', $data);
    }
    public function store(Request $request)
    {
        $contact = new communucate();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile_no = $request->mobile_no;
        $contact->address = $request->address;
        $contact->message = $request->message;
        $contact->save();

        $data = array(
            'name'   => $request->name,
            'email'  => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'message' => $request->message,
        );

        Mail::send('frontend.emails.contact', $data,  function ($message) use ($data) {
            $message->from('mhsaha16@gmail.com', 'popular soft Bd');
            $message->to($data['email']);
            $message->subject('Thanks for contact us');
        });



        return redirect()->back()->with('success', 'Your message successfully sent');
    }


    public function viewCommunicate()
    {
        dd('ok');
    }
}
