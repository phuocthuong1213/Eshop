@extends('Master')

@section('BodyContent')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Đăng nhập vào tài khoản</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        @csrf
                        <input type="text" name="email_account" placeholder="Tên tài khoản" />
                        <input type="password" name="password_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký tài khoản</h2>
                    <?php if(isset($succes)) {?>
                    <p style="color:red">{{$succes}}</p>
                    <?php }?>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        @csrf
                        <input type="text" placeholder="Họ và tên" name="customer_name" />
                        @if(isset($error['name']))
                        <p style="color: red">{{$error['name']}}</p>
                        @endif
                        <input type="email" placeholder="Địa chỉ Email" name="customer_email" />
                        @if(isset($error['email']))
                        <p style="color: red">{{$error['email']}}</p>
                        @endif
                        <input type="password" placeholder="Mật khẩu" name="customer_password" />
                        @if(isset($error['password']))
                        <p style="color: red">{{$error['password']}}</p>
                        @endif
                        <input type="number" placeholder="Số điện thoại" name="customer_number" />
                        @if(isset($error['number']))
                        <p style="color: red">{{$error['number']}}</p>
                        @endif
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

@endsection