@extends('backend.master')
@section('BodyContent')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              {{-- <label class="i-checks m-b-none">
                  <input type="checkbox"><i></i>
                </label> --}}
            </th>
            <th>Tên sản phẩm</th>
            <th>Hiển Thị</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list_product as $item)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$item->product_name}}</td>
            <td><span class="text-ellipsis">
                @if ($item->product_status == 0)
                <a href="{{route('unactive_product', ['id' => $item->product_id])}}"
                  style="font-size:27px; color:red"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                @else
                <a href="{{route('active_product', ['id' => $item->product_id])}}" style="font-size:27px;"><span
                    class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                @endif
              </span>
            </td>
            <td><img src="{{URL::to('../storage/app/avatarProduct/'.$item->product_images)}}" height="100" width="100"></td>
            <td>{{ $item->category_name }}</td>
            <td>{{ $item->brand_name }}</td>
            <td>
              <a href="{{route('update_product', ['id' => $item->product_id])}}" class="active" ui-toggle-class=""><i
                  class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a class="active" ui-toggle-class="" href="{{route('delete_product', ['id' => $item->product_id])}}"
                onclick="return confirm('Bạn có muốn xóa danh mục này không ???');"><i
                  class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        {{-- <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div> --}}
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$list_product->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection