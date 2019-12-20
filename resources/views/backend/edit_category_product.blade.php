@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{route('update_category_post', ['id' => $cat->category_id])}}"
                        method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Điền tên danh mục" name="category_product_name"
                                value="{{ old('category_product_name', $cat->category_name) }}">
                            @if(isset($error['name']))
                            <p style="color: red">{{$error['name']}}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none;" rows="8" name="category_product_desc" class="form-control"
                                id="exampleInputPassword1"
                                placeholder="Mô tả danh mục">{{$cat->category_desc}}</textarea>
                        </div>
                        @if(isset($error['desc']))
                        <p style="color: red">{{$error['desc']}}</p>
                        @endif
                        <br><button type="submit" name="update_category_product" class="btn btn-info">Update danh
                            mục</button><br>

                    </form>
                </div>

            </div>
    </div>
</div>
@endsection