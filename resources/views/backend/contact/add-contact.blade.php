@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Contact</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
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
                            <h3>Add Contact
                                <a class="btn btn-success float-right btn-sm" href="{{route('contacts.view')}}">
                                    <i class="fa fa-list"></i>  Contact Lists</a>
                            </h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="{{route('contacts.store')}}" id="myForm"  enctype ="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="from-control">
                                </div>
                               
                                <div class="form-group col-md-4">
                                    <label for="mobile_no">Mobile No</label>
                                    <input type="text" name="mobile_no" class="from-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="from-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" class="from-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" class="from-control">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" name="youtube" class="from-control">
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="google_plus">Google plus</label>
                                    <input type="text" name="google_plus" class="from-control">
                                </div>

                                <div class="form-group col-md-6" ">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                         </div>

                        </form>
                    </div> <!-- /.card-body-->
            </div>
            <!-- /.card -->
    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.contentainer-fluid-->
</section>

<!-- /.content-->
</div>
<!-- /.content-wrapper -->

@endsection