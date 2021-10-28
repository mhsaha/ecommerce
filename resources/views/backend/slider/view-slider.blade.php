@extends('backend.layouts.master')
 @section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Slider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>Slider List
                <a class="btn btn-success float-right btn-sm" href="{{route('sliders.add')}}">
                <i class="fa fa-plus-circle"></i> Add Slider</a>
                </h3>
                </div>
              </div>
              <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                       <thead>
                         <tr>
                         <th>Sl</th>
                         <th>Image</th>
                         <th>Short Title</th>
                         <th>Long Title</th>
                         <th>Action</th>
                         </tr>
                        </thead>
                      <tbody>

                        @foreach($allData as $key => $slider)
                          <tr>
                           <td>{{$key+1}}</td>
                              <td>
                                       <img src="{{(!empty($slider->image))
                                    ?url('public/upload/slider_images/'.$slider->image):url 
                                     ('public/upload/no_img.png')}}" width="120px" height="130px">

                              </td>
                              <td>{{$slider->short_title}}</td>
                              <td>{{$slider->long_title}}</td>
                             <td>
                                 <a title="Edit" class="btn btn-sm btn-primary" href="{{route('sliders.edit',$slider->id)}}">
                                 <i class="fa fa-edit"></i></a>
                                 <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{route('sliders.delete',$slider->id)}}">
                                 <i class="fa fa-trash"></i></a>

                             </td>
                          </tr>
                        @endforeach
                      </tbody>
                      </table>
               
                  </div><!-- /.card-body -->
         
            <!-- /.card -->
            <!-- /.card-body -->
                   </div>
                  <!-- /.card -->
                      </section>
                     <!-- right col -->
                           </div>
                    <!-- /.row (main row) -->
                        </div><!-- /.container-fluid -->
                   </section>
                    
            <!-- /.card -->
          </section>
 @endsection
          