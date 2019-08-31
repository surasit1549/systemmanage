@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('content')



<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างใบขอสั่งซื้อ PR</h3>
  </div>
  <div class="card-body">
    <form method="post" action="{{action('PuchaserequestController@update', $id)}}" class="needs-validation" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="form-group col-md-12 text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <input type="text" name="date" value="{{$pr_create['date']}}" class="border-0 bg-light" size="8">
          <input type="hidden" name="id" value="{{$id}}" class="border-0" >
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>เลขที่เอกสาร</label>
          <input type="text" name="keyPR" class="form-control" value="{{$pr_create['key']}}" autocomplete="off">
        </div>
        <div class="form-group col-md-8">
          <label>ชื่อผู้รับเหมา</label>
          <input type="text" name="contractor" class="form-control" value="{{$pr_create['contractor']}}" autocomplete="off">

        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label>แบบงาน</label>
          <input type="text" name="formwork" class="form-control" value="{{$pr_create['formwork']}}" >
        </div>
        <div class="form-group col-md-6">
          <label>แปลง</label>
          <input type="text" name="prequestconvert" class="form-control" value="{{$pr_create['prequestconvert']}}" >
        </div>
      </div>
      <!-- สินค้าที่ขอสั่งซื้อ -->
      <br>

      <table class="table table-hover table-bordered border-dark table-border-dark">
        <thead>
          <tr>
            <th colspan="4" class="text-center">จัดการสินค้า</th>
            <th colspan="4" class="text-center">จัดซื้อสินค้า</th>
          </tr>
          <tr class="text-center">
            <th style="width:5%;">ลำดับ</th>
            <th style="width:20%;">รายการสินค้า</th>
            <th style="width:10%;">จำนวน</th>
            <th style="width:10%;">หน่วย</th>
            <th style="width:20%;">ร้านค้า</th>
            <th style="width:10%;">ราคาต่อหน่วย</th>
            <th style="width:15%;">รวม</th>
          </tr>
        </thead>
        <tbody>
          @foreach($min as $row)
          <tr>
            <td class="text-center"><label class="col-form-label">{{$number++}}</label></td>
            <td class="text-center result"><input type="text" name="Product_name[]" class="form-control productname border-0" value="{{$row[0]}}" name="" required></td>
            <td class="text-center result"><input type="number" name="Product_number[]" min="1" class="form-control productnumber border-0" value="{{$row[1]}}" name="" required></td>
            <td class="text-center result"><input type="text" name="unit[]" class="form-control unit border-0" value="{{$row[2]}}" name="" required></td>
            <td>
              <input type="text" name="keystore[]" class="form-control keystore" value="{{$row[3]}}" required>
            </td>
            <td class="text-center result"><input type="number" name="price[]" min="1" class="form-control price border-0" value="{{$row[4]}}" required></td>
            <td class="text-center result"><input type="number" name="product_sum[]" min="1" class="sum col-form-label border-0" value="{{$row[5]}}" required></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th class="text-right" colspan="4">รวมเป็นเงิน</th>
            <th class="text-center"><input type="number" name="sum" id="sumofprice" class="text-danger" value="{{$sum[0]}}"></th>
            <th class="text-center">บาท</th>
          </tr>
        </tfoot>
      </table>
      </div>

      <div class="form-group text-center">
        <a class="btn btn-danger" href="#" onclick="window.history.back()"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        <button id="subform" type="submit" class="btn btn-success ml-2" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
      </div>
      <input type="hidden" name="_method" value="PATCH" />
    </form>
  </div>
</div>
@endsection