@extends('frontend.layouts.master')
@section('content')
<style>
    #login .container #login-row #login-column #login-box {

        max-width: 600px;
        /* height: 320px; */
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }

    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>
<!-- Banner Section -->
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/frontend/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Customer Singup
    </h2>
</section>

<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{route('singup.store')}}" method="post">
                        @csrf
                        <h3 class="text-center text-info">Sing up</h3>
                        <div class="form-group">
                            <label class="text-info">Full Name</label><br>
                            <input type="text" name="name" id="name" class="form-control">
                            <font color:"red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                        </div>
                        <div class="form-group">
                            <label class="text-info">Email</label><br>
                            <input type="email" name="email" id="email" class="form-control">
                            <font color:"red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                        </div>
                        <div class="form-group">
                            <label class="text-info">Mobile No</label><br>
                            <input type="text" name="mobile" id="mobile" class="form-control">
                            <font color:"red">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
                        </div>
                        <div class="form-group">
                            <label  class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                            <font color:"red">{{($errors->has('password'))?($errors->first('password')):''}}</font>
                        </div>

                        <div class="form-group">
                            <label  class="text-info"> Confirm Password:</label><br>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group">

                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Signup">
                            <i class="fa fa-user"> </i> Have any account?<a href="{{route('customer.login')}}">
                                <span>Login here</span></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <script>
    $(document).ready(function() {
                $('#login-form').validate({
                        rules: {
                            name: {
                                required: true,
                            },
                            mobile: {
                                required: true,
                            },
                            email: {
                                required: true,
                                email: true,
                            },
                            password: {
                                required: true,
                                minlength: 9
                            },
                            password_confirmation: {
                                required: true,
                                equalTo: '#password'
                            }
                        },
                        messages: {
                            name: {
                                required: 'Please enter your full name',
                            },

                           mobile: {
                                required: 'Please enter your mobile no',
                            },

                            email: {
                                required: 'Please enter email address',
                                email: 'Please enter a  <em>vaild</em> email address',
                            },
                            password: {
                                required: 'Please enter password',
                                minlength: 'password will be  minimum 9 characters or numbers',
                            },

                            password_confirmation: {
                                required: 'Please enter confirm password',
                                equalTo: 'Confirm password does not match',
                            }
                         },
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
</script>

@endsection