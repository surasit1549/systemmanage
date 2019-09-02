@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('CheckController@show', $id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PR {{$pr_create['key']}}</label></h4>
          </div>
          <div class='col-md-6 text-right'>
            <button class="btn btn-danger"><i style="font-size:18px" class="far fa-file-pdf"></i>&nbsp;&nbsp;PDF</button>
          </div>
        </div>
        <hr>

        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th>
                เลขที่เอกสาร
                </td>
              <td>
                {{$pr_create['key']}}
              </td>
              <th>
                วันที่ขอสั่งซื้อ
                </td>
              <td>
                {{$pr_create['date']}}
              </td>
            </tr>
            <tr>
              <th>
                ชื่อผู้รับเหมา
                </td>
              <td>
                {{$pr_create['contractor']}}
              </td>
              <th>
                แบบงาน
                </td>
              <td>
                {{$pr_create['formwork']}}
              </td>
            </tr>
            <tr>
              <th>แปลง</th>
              <td>
                {{$pr_create['prequestconvert']}}
              </td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead class="text-center">
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>หน่วย</th>
            </tr>
          </thead>
          <tbody>
          @foreach($productdb as $row)
              <tr>
                <td>{{$number++}}</td>
                <td>{{$row['productname']}}</td>
                <td>{{$row['productnumber']}}</td>
                <td>{{$row['unit']}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger" onclick="window.history.back()" href="#"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection