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
                    <div class="row">
						<div class="col-md-2"></div>
							<div class="col-md-8">

							    <div class="card">
								<div class="card-body">
                                        <div class="img-circle text-center">
                                             <img src="{{(!empty($user->image))?url
												('public/upload/user_images/'.$user->image):url 
                                                ('public/upload/no_img.png')}}" style="height:140px; 
												width:130px">
											
								
										</div>
										<h3 class="text-center">{{$user->name}}</h3>
										<p class="text-center">{{$user->address}}</p>


										<table class="table table-bordered">
											<tbody>
												<tr>
													<td>Mobile No</td>
													<td>{{$user->mobile}}</td>
												</tr>

												<tr>
													<td>Email:</td>
													<td>{{$user->email}}</td>
												</tr>

												<tr>
													<td>Gender:</td>
													<td>{{$user->gender}}</td>
												</tr>
											</tbody>
										</table>
										<a class="btn btn-primary btn-block" href="{{route('customer.edit.profile')}}">
											Edit Profile
										</a>
								</div>
								</div>
								
							</div>
						

					</div>
				</div>
			</div>
		</div>
	

@endsection