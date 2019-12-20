@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php if(isset($messenger['succes'])) {?>
                    <p style="color:red">{{$messenger['succes']}}</p>
                    <?php }?>
                    <form role="form" action="{{route('add_product_post')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="product_name">
                            @if(isset($data_error))
                            <p style="color: red">{{$data_error['error']['pro_name']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="product_price">
                            @if(isset($data_error))
                            <p style="color: red">{{$data_error['error']['pro_price']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none;" rows="8" name="product_desc" class="form-control ckeditor"
                                id="exampleInputPassword1" placeholder=""></textarea>
                            @if(isset($data_error))
                            <p style="color: red">{{$data_error['error']['pro_desc']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea required style="resize:none;" rows="8" name="product_content" class="form-control ckeditor"
                                id="exampleInputPassword1" placeholder=""></textarea>
                            @if(isset($data_error))
                            <p style="color: red">{{$data_error['error']['pro_content']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="exampleInputEmail1" placeholder=""
                                name="images">
                            @if(isset($data_error))
                            <p style="color: red">{{$data_error['error']['images']}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                <option value="">Chọn danh mục</option>
                                @foreach ($cat_list as $cat)
                                <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                            <select name="brand_id" class="form-control input-sm m-bot15">
                                <option value="">Chọn thương hiệu</option>
                                @foreach ($brand_list as $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
    </div>
</div>
@endsection