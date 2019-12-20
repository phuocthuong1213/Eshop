@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('update_brand', ['id' => $brand->brand_id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Điền tên thương hiệu" name="brand_product_name"
                                value="{{ old('brand_product_name', $brand->brand_name) }}">
                            @if(isset($error['name']))
                            <p style="color: red">{{$error['name']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none;" rows="8" name="brand_product_desc" class="form-control"
                                id="exampleInputPassword1"
                                placeholder="Mô tả danh mục">{{$brand->brand_desc}}</textarea>
                            @if(isset($error['desc']))
                            <p style="color: red">{{$error['desc']}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Danh sách danh mục</label>
                            <select name="list_category_product" class="form-control input-sm m-bot15">
                                <option value="0" selected>Chọn danh mục</option>
                                @foreach ($category as $item)
                                <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                            @if(isset($error['list']))
                            <p style="color: red">{{$error['list']}}</p>
                            @endif
                        </div>
                        <button type="submit" name="update_brand_product" class="btn btn-info">Update thương
                            hiệu</button><br>
                    </form>
                </div>

            </div>
    </div>
</div>
@endsection