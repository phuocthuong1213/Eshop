@extends('Master')

@section('BodyContent')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="register-req">
            <p>Đăng ký hoặc đang nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gởi hàng</p>
                        <div class="form-one">
                        <form action="{{route('save_sipping')}}" method="post">
                            @csrf
                                <input type="text" placeholder="Họ và tên" name="shipping_name">
                                <input type="email" placeholder="Email" name="shipping_email">
                                <input type="text" placeholder="Địa chỉ" name="shipping_address">
                                <input type="number" placeholder="Phone" name="shipping_phone">
                                <textarea placeholder="Ghi chú đơn hàng của bạn!!!"
                            rows="16" name="shipping_nodes"></textarea>
                                <input type="submit" value="Gửi" name="sent_order" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div> --}}
    </div>
</section>
<!--/#cart_items-->
@endsection