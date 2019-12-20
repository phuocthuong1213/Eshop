@extends('backend.master')
@section('BodyContent')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php if(isset($succes)) {?>
                    <p style="color:red">{{$succes}}</p>
                    <?php }?>
                    <form role="form" action="{{route('save_category')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Điền tên danh mục" name="category_product_name">
                            @if(isset($error['name']))
                            <p style="color: red">{{$error['name']}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none;" rows="8" name="category_product_desc" class="form-control"
                                id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Trạng thái</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
    </div>
</div>
@endsection