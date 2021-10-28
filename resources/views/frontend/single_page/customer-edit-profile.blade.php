@extends('frontend.layouts.master')
@section('content')
 <!-- Banner Section -->

 <style >
	 .prof li{
		 background: #1781BF;
		 padding: 7px;
		 margin: 3px;
		 border-radius: 15px;
	 }
     
	 .prof li a {
		 color: #fff;
		 padding-left: 15px;
	 }






 </style>
 <!-- Title page -->
   <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/frontend/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Customer Dashboard
		</h2>
	</section>	

	

		<div class="container">
			<div class="row" style="padding:15px 0px 15px 0px;">
				<div class="col-md-2">
				  <ul class="prof">
					  <li><a href="{{route('dashboard')}}"> My Profile</a></li>
					  <li><a href="{{route('customer.password.change')}}">Password Change</a></li>
					  <li><a href="{{route('customer.order.list')}}"> My orders</a></li>
				  </ul>



				</div>
				<div class="col-md-10">
                    <h3>Edit Profile</h3>
                  <form action="{{route('customer.update.profile')}}" method="post" enctype="multiple/form-data"> 
                     @csrf
                     <div class="row">
                         <div class="col-md-4">
                             <label for="">Full name</label>
                             <input type="text" name="name" value="{{$editData->name}}" class="form-control">
                             <font color="red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                         </div>

                         <div class="col-md-4">
                             <label for="">Email:</label>
                             <input type="text" name="email" value="{{$editData->email}}" class="form-control">
                             <font color="red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                         </div>

                         <div class="col-md-4">
                             <label for="">Mobile:</label>
                             <input type="text" name="mobile" value="{{$editData->mobile}}" class="form-control">
                             <font color="red">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
                         </div>
                         <div class="col-md-4">
                             <label for="">Address</label>
                             <input type="text" name="address" value="{{$editData->address}}" class="form-control">
                             
                         </div>
                         <div class="col-md-4">
                             <label >Gender</label>
                             <select name="gender" class="form-control">
                                 <option value="">Select Gender</option>
                                 <option value="Male"{{($editData->gender=="Male")?"selected":""}}>Male</option>
                                 <option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
                             </select>
                         </div>

                         <div class="col-md-4">
                             <label for="">Image</label>
                             <input type="file" name="image" id="image" class="form-control">
                         </div>
                         <div class="col-md-2" >
                         <img id="showImage" src="{{(!empty($editData->image))
                         ?url('public/upload/user_images/'.$editData->image):url 
                        ('public/upload/no_img.png')}}"
                        style="width: 80px; height:90px; border:1px solid #000;">
                         </div>

                         <div class="col-md-4" style="padding-top:30px">
                             <button type="submit" class="btn btn-primary">Profile Update</button>
                         </div>
                     </div>


                  </form>
				</div>
			</div>
		</div>
	

@endsection