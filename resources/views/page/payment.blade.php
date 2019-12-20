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
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
                // echo "<pre>";
                // print_r($content);
                // echo "</pre>";
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Gía</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <img src="{{URL::to('../storage/app/avatarProduct/'.$v_content->options->image)}}" alt="">
                        </td>
                        <td class="cart_description">
                            <h4>{{$v_content->name}}</h4>
                            <p>Web ID: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price)}}đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('update-qty-cart')}}" method="post">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{$v_content->qty}}" autocomplete="off" size="2">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
                                        class="form control">
                                    <input type="submit" value="Cập nhật" name="update_qty"
                                        class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($v_content->price * $v_content->qty)}}vnđ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"
                                href="{{URL::to('delete-to-cart').'/'.$v_content->rowId}}"><i
                                    class="fa fa-times">Xóa</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{URL::to('/order-place')}}" method="post">
            <div class="payment-options">
                @csrf
                <h4>Chọn hình thức thanh toán</h4>
                <span>
                    <label><input type="checkbox" name="payment_option" value="1"> Trả bằng ATM</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" value="2"> Nhận tiền mặt</label>
                </span>
                <span>
                    <label><input type="checkbox" name="payment_option" value="3">Thanh toán thẻ ghi nợ</label>
                </span>
                <input style="margin-bottom:15px" type="submit" value="Đặt hàng" name="sent_order_place" class="btn btn-primary btn-sm">
                {{-- <span>
                <label><input type="checkbox"> Paypal</label>
            </span> --}}
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->
@endsection