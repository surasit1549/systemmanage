@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('ProductPriceController@show', $id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;ร้านค้า {{$data[0]['name']}}</label></h4>
          </div>
        </div><br>
        <form action="/search" method="POST" role="search">
            <div class="input-group">
                <input type="search" class="form-control" name="search"
                    placeholder="Search "> <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </span>
            </div>
        </form>

        <hr>

        <table class="table table-hover table-bordered">
          <thead class="text-center">
            <tr>
              <th>ลำดับที่</th>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>ราคาสินค้า (บาท)</th>
            </tr>
          </thead>
          <tbody>
          @foreach($data as $row)
              <tr>
                <td>{{$number++}}</td>
                <td>{{$row['Product']}}</td>
                <td>{{$row['Product_name']}}</td>
                <td>{{$row['Price']}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger btn-lg" href="{{route('Product_Price.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection