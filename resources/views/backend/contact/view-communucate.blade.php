@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Communicate</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Communicate</li>
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
              <h3>Communicate List
              </h3>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Mobile No</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach($allData as $key => $communucate)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$communucate->name}}</td>
                  <td>{{$communucate->address}}</td>
                  <td>{{$communucate->mobile_no}}</td>
                  <td>{{$communucate->email}}</td>
                  <td>{{$communucate->message}}</td>
                  <td>

                    <a title="Delete" id="delete" class="btn btn-sm btn-danger" 
                    href="{{route('contacts.communucate.delete',$communucate->id)}}">
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