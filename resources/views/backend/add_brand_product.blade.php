@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @if(isset($succes))
                    <p style="color:red">{{$succes}}</p>
                    @endif
                    <form role="form" action="{{route('add-brand-post')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Điền tên danh mục" name="brand_product_name">
                            @if (isset($error['brand_name']))
                            <p style="color:red">{{$error['brand_name']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize:none;" rows="8" name="brand_product_desc" class="form-control"
                                id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                            @if (isset($error['brand_desc']))
                            <p style="color:red">{{$error['brand_desc']}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Danh sách danh mục</label>
                            <select name="list_category_product" class="form-control input-sm m-bot15">
                                @foreach ($category as $item)
                                <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>

            </div>
    </div>
</div>
@endsection