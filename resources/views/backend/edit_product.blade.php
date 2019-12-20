@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @if (isset($messenger['error']))
                    <p style="color: red">{{$messenger['error']}}</p>
                    @endif
                    <form role="form" action="{{route('update_product', ['id' => $product->product_id])}}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="product_name" value="{{$product->product_name}}">
                            @if (isset($error['name']))
                            <p style="color: red">{{$error['name']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="product_price" value="{{$product->product_price}}">
                            @if (isset($error['price']))
                            <p style="color: red">{{$error['price']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none;" rows="8" name="product_desc" class="form-control ckeditor"
                                id="exampleInputPassword1" placeholder="">{{$product->product_desc}}</textarea>
                            @if (isset($error['desc']))
                            <p style="color: red">{{$error['desc']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize:none;" rows="8" name="product_content" class="form-control ckeditor"
                                id="exampleInputPassword1" placeholder="">{{$product->product_content}}</textarea>
                                @if (isset($error['content']))
                                <p style="color: red">{{$error['content']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="images" >
                            <img src="{{URL::to('../storage/app/avatarProduct/'.$product->product_images)}}" alt=""
                                height="100px" width="100px">
                        </div>
                        {{-- <div class="form-group" >
                            <label>Ảnh sản phẩm</label>
                            <input required id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="images" onchange="changeImg(this)">
                            <img id="avatar" class="thumbnail" width="300px" src="{{URL::to('../storage/app/avatarProduct/'.$product->product_images)}}">
                        </div> --}}

                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                <option value="">Chọn danh mục</option>
                                @foreach ($category as $cat)
                                @if ( $cat->category_id == $product->category_id)
                                <option selected value="{{$cat->category_id}}">{{$cat->category_name}}</option> --}}
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                            <select name="brand_id" class="form-control input-sm m-bot15">
                                <option value="">Chọn thương hiệu</option>
                                @foreach ($brand as $item)
                                @if ( $item->brand_id == $product->brand_id )
                                <option selected value="{{$item->brand_id}}">{{$item->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <br><button type="submit" name="update_product" class="btn btn-info">Update sản phẩm</button>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection