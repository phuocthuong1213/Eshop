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
        <div class="review-payment">
            <h2>Cám ơn bạn đã đặt hàng chỗ chúng tôi,Chúng tôi sẽ liên hệ lại bạn 1 cách sớm nhất</h2>
        </div>       
    </div>
</section>
<!--/#cart_items-->
@endsection