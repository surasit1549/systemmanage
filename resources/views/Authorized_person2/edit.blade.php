@extends('Home.master')
@section('title','ใบขอสั่งซื้อ')
@section('tabbarcss')
<style>
  #transformtab {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }

  .main_detail_po {
    width: 100%;
    border: 1px solid black;
  }


  .detail_po {
    padding: 10px;
    font-size: 18px;
  }

  .detail_po td,
  .detail_po th {
    padding: 10px;
  }
</style>
@stop
@section('content')



<div class="card">
  <div class="card-header text-white">
    <h3><i class="far fa-plus-square"></i>&nbsp;&nbsp;ผู้มีอำนาจคนที่ 2</h3>
  </div>
  <div class="card-body">
    <form method="post" action="{{action('mastertwoController@update', $id)}}" class="needs-validation" novalidate>
      {{csrf_field()}}
      <div class="row">
        <div class="form-group col-md-6">
          <a class="btn btn-info text-white" onclick="location.reload();">Refresh</a>
        </div>
        <div class="form-group col-md-6 text-right">
          <label>วันที่ขอสั่งชื้อ</label><br>
          <input type="text" name="date" value="{{$pr_create['date']}}" class="border-0" size="8" autocomplete="off">
          <input type="hidden" name="id" value="{{$id}}" class="border-0" size="8" autocomplete="off">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>เลขที่เอกสาร</label>
          <input type="text" name="keyPR" class="form-control" value="{{$pr_create['key']}}" autocomplete="off" required>

        </div>
        <div class="form-group col-md-8">
          <label>ชื่อผู้รับเหมา</label>
          <input type="text" name="contractor" class="form-control" value="{{$pr_create['contractor']}}" autocomplete="off" required>

        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label>แบบงาน</label>
          <input type="text" name="formwork" class="form-control" value="{{$pr_create['formwork']}}" required>
        </div>
        <div class="form-group col-md-6">
          <label>แปลง</label>
          <input type="text" name="prequestconvert" class="form-control" value="{{$pr_create['prequestconvert']}}" required>
        </div>
      </div>
      <input type="hidden" name="_method" value="PATCH" />
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
            <td class="text-center result"><input type="text" name="Product_name[]" class="form-control productname border-0" value="{{$row[0]}}" name="" required></label>
            <td class="text-center result"><input type="number" name="Product_number[]" min="1" class="form-control productnumber border-0" value="{{$row[1]}}" name="" required></label></td>
            <td class="text-center result"><input type="text" name="unit[]" class="form-control unit border-0" value="{{$row[2]}}" required></label>
            <td>
              <input type="text" name="keystore[]" class="form-control keystore" value="{{$row[3]}}" required>
            </td>
            <td class="text-center result"><input type="number" name="price[]" min="1" class="form-control price border-0" value="{{$row[4]}}" required></label></td>
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
      
      <div class="form-group col-md-8">
        <label>key master</label>
        <input type="text" name="key_person" class="form-control" value="{{$carbon}}" autocomplete="off" required>
      </div>

      <table class="table table-hover table-bordered border-dark table-border-dark">
        <thead>
            <tr class="text-center">
              <th >ชื้อร้านค้า</th>
            </tr>
          </thead>
          <tbody>
            @foreach($PO as $row)
              <tr>
                <td ><input type="text" name="PO_ID[]" class="form-control productname border-0" value="{{$row}}" required></label></td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </form>
  </div>
  <input type="hidden" name="_method" value="PATCH" />

  <br><br><br>

  <div>
    <div style="text-align:center">
      <div>
        <img src="{{asset('pic/store.png')}}" alt="pic">
      </div>
      <br>
      <h4>{{ $store[0]->name }}</h4>
      <h5>{{ $store[0]->address }}</h5>
      <h5>{{ $store[0]->phone }}</h5>
      <h5>ใบสั่งซื้อ</h5>
    </div>
    <table class="main_detail_po">
      <tr>
        <td>
          <table class="detail_po">
            <tr>
              <th>ผู้ขาย :</th>
              <td>{{$stores[0]['name']}}</td>
            </tr>
            <tr>
              <th>โทรศัทพ์ :</th>
              <td>ผู้ขาย</td>
            </tr>
            <tr>
              <th>ที่อยู่ :</th>
              <td>ผู้ขาย</td>
            </tr>
            <tr>
              <th>โทรสาร :</th>
              <td>ผู้ขาย</td>
            </tr>
          </table>
        </td>
        <td>
          <table class="detail_po">
            <tr>
              <th>วันที่เอกสาร :</th>
              <td>ผู้ขาย</td>
            </tr>
            <tr>
              <th>ผู้ติดต่อ :</th>
              <td>ผู้ขาย</td>
            </tr>
            <tr>
              <th>วันที่กำหนดส่ง :</th>
              <td>ผู้ขาย</td>
            </tr>
            <tr>
              <th>จำนวนเครดิต :</th>
              <td>ผู้ขาย</td>
              <th>วัน</th>
            </tr>
            <tr>
              <th>เงื่อนไขการชำระ :</th>
              <td>ผู้ขาย</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>





  <br><br><br><br>
  <table class="table table-hover table-bordered border-dark table-border-dark">
    <thead>
      <tr class="text-center">
        <th>ชื้อร้านค้า</th>
        <th>รหัสร้านค้า</th>
        <th>ที่อยู่</th>
        <th>โทรศัทพ์</th>
        <th>โทรสาร</th>
        <th>ผู้ติดต่อ</th>
        <th>เบอร์โทร</th>
      </tr>
    </thead>
    <tbody>
      @foreach($stores as $row)
      <tr>
        <td><input type="text" name="name[]" class="form-control productname border-0" value="{{$row[0]['name']}}" required></label></td>
        <td><input type="text" name="keystore[]" min="1" class="form-control productnumber border-0" value="{{$row[0]['keystore']}}" required></label></td>
        <td><input type="text" name="address[]" class="form-control unit border-0" value="{{$row[0]['address']}}" required></label></td>
        <td><input type="text" name="phone[]" class="form-control keystore" value="{{$row[0]['phone']}}" required></td>
        <td><input type="text" name="fax[]" min="1" class="form-control price border-0" value="{{$row[0]['fax']}}" required></label></td>
        <td><input type="text" name="contect[]" min="1" class="sum col-form-label border-0" value="{{$row[0]['contect']}}" required></td>
        <td><input type="text" name="cellphone[]" min="1" class="sum col-form-label border-0" value="{{$row[0]['cellphone']}}" required></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  </form>
</div>
@endsection