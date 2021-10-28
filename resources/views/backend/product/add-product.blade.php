@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                            @if(isset($editData))
                            Edit Product
                            @else
                            Add Product
                            @endif
                            <h3>Add Product
                                <a class="btn btn-success float-right btn-sm" href="{{route('products.view')}}">
                                    <i class="fa fa-list"></i> Product Lists</a>
                            </h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="{{(@$editData)?route('products.update',$editData->id):route('products.store')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="from-group col-md-4">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{(@$editData->category_id==$category->id)?"selected":""}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="from-group col-md-4">
                                    <label>Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->id}}"{{(@$editData->brand_id==$brand->id)?"selected":""}}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="form-group col-md-4">
                                    <label>Product Name</label>
                                    <input type="text" name="name" value="{{@$editData->name}}" class="form-control" placeholder="Write Product Name">
                                    <font color:"red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                                </div>

                                <div class="from-group col-md-6">
                                    <label>Color</label>
                                    <select name="color_id[]" class="form-control select2" multiple>
                                        @foreach($colors as $color)
                                        <option value="{{$color->id}}">{{$color->name}}</option> 
                                        @endforeach
                                    </select>
                                    <font color="red">{{($errors->has('color_id'))?($errors->first('color_id')):''}}</font>
                                </div>

                                <div class="from-group col-md-6">
                                    <label>Size</label>
                                    <select name="size_id[]" class="form-control select2" multiple>
                                        @foreach($sizes as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                        @endforeach
                                    </select>
                                    <font color="red">{{($errors->has('size_id'))?($errors->first('size_id')):''}}</font>
                                </div>

                                <div class="from-group col-md-12">
                                    <label>Short Description</label>
                                  <textarea name="short_desc" class="form-control">{{@$editData->short_desc}}</textarea>
                                      
                                    </select>
                                    <font color="red">{{($errors->has('short_desc'))?($errors->first('short_desc')):''}}</font>
                                </div>

                                <div class="from-group col-md-12">
                                    <label>Long Description</label>
                                  <textarea name="long_desc" class="form-control" rows="4">{{@$editData->long_desc}}</textarea>
                                      
                                
                                    <font color="red">{{($errors->has('long_desc'))?($errors->first('long_desc')):''}}</font>
                                </div>

                                <div class="from-group col-md-3">
                                    <label>price</label>
                                 <input type="number" name="price" value="{{@$editData->price}}" class="form-control">
                                    <font color:"red">{{($errors->has('price'))?($errors->first('price')):''}}</font>
                                </div>


                                <div class="from-group col-md-3">
                                    <label>Image</label>
                                 <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="from-group col-md-3">
                                    <img id="showImage" src="{{(!empty($editData->image))
                                    ?url('public/upload/product_images/'.$editData->image):url 
                                     ('public/upload/no_img.png')}}" style="width: 150px; height:160px; border:1px solid #000;">
                                </div>

                                <div class="from-group col-md-3">
                                    <label> Sub Image</label>
                                 <input type="file" name="sub_image[]" id="sub_image" class="form-control" multiple>
                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary">{{(@$editData)?"Update":"Submit"}}</button>
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
<script>
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,

                },
                category_id: {
                    required: true,

                },
                brand_id: {
                    required: true,

                },
                short_desc: {
                    required: true,

                },
                long_desc: {
                    required: true,

                },
                price: {
                    required: true,

                },
            },
            messages: {},
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script> -->

@endsection