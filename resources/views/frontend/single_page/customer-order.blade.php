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
                  <table class="table table-bordered">
                      <thead >
                          <tr>
                              <th>Order No</th>
                              <th>Total Anount</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($orders as $order)
                          <tr>
                          <td>{{$order->order_no}}</td>
                          <td>{{$order->total}}</td>
                          <td>
                              @if($order->status=='0')
                              <span style="background:red; padding: 4px; color:#fff">Unapproved</span>
                              @elseif($order->status=='1')
                              <span style="background: #1BA160; padding: 4px; color:#fff">Approved</span>
                          </td>
                          <td>
                              <a href="" class="btn btn-primary btn-sm"><i class
                              ="fa fa-eye"></i>Details</a>
                          </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
				</div>
			</div>
		</div>
	

@endsection