@extends('Home.master')
@section('title','ข้อมูลใบขอสั่งซื้อ PR')
@section('tabbarcss')
<style>
  #checktab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
<script>
  $(document).ready(function() {
    $('#prpo_form').click();
  });
</script>
@stop
@section('content')




<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบขอสั่งซื้อ</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('CheckController@update', $po_id[0]['PO_ID'])}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="row">
          <div class="col-form-label col-md-6">
            <h4 class="d-inline shadow-sm" style="padding:10px"><label class="text-danger">&nbsp;PO {{$po_id[0]['PO_ID']}}</label></h4>
            <input type="hidden" name="PO_ID" value="{{$po_id[0]['PO_ID']}}">
          </div>
        </div>
        <hr>
        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th> ผู้ขาย :</th>
              <td>
                {{$store[0]['name']}}&nbsp;&nbsp; [ {{$store[0]['keystore']}} ]
              </td>
              <th> วันที่เอกสาร :</th>
              <td>
                {{substr($pr_store[0]['created_at'],0,-9)}}
              </td>
            </tr>
            <tr>
              <th> ที่อยู่ :</td>
              <td>
                {{$store[0]['address']}}
              </td>
              <th> ผู้ติดต่อ : </th>
              <td>
                {{$store[0]['contect']}} &nbsp;&nbsp; {{$store[0]['cellphone']}}
              </td>
            </tr>
            <tr>
              <th> โทรศัพท์ :</th>
              <td>
                {{$store[0]['phone']}}
              </td>
              <th> วันที่กำหนดส่ง : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> โทรสาร : </th>
              <td>
                {{$store[0]['fax']}}
              </td>
              <th> จำนวนเครดิต : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> </th>
              <td> </td>
              <th> เงื่อนไขการชำระ : </th>
              <td>

              </td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th style="width:15%;">เช็กสินค้า</th>
              <th style="width:10%;">เหลือ</th>
              <th style="width:15%;">จำนวนสินค้าที่รับ</th>
              <th>ชื่อสินค้า</th>
              <th style="width:15%;">จำนวนสินค้า</th>
              <th style="width:10%;">หน่วย</th>
            </tr>
          </thead>
          <tbody>
            @if(empty($check_po))
            @foreach($data as $row)
            <tr>
              <td class="text-center">
                <label class="form-control check border-0" >{{$row['status']}}</label>
                <input type="hidden" name="check[]" value="{{$row['status']}}">
              </td>
              <td>
                <label class="form-control surplus border-0" >{{$row['Product_number']}}</label>
                <input type="hidden" name="surplus[]" value="0">
              </td>
              <input type="hidden" name="PO_ID[]" value="{{$row['PO_ID']}}">
              <input type="hidden" name="keyPR[]" value="{{$row['keyPR']}}">
              <input type="hidden" name="keystore[]" value="{{$row['keystore']}}">
              <input type="hidden" name="price[]" value="{{$row['PO_ID']}}">
              <input type="hidden" name="product_sum[]" value="{{$row['PO_ID']}}">
              <input type="hidden" name="sumofprice[]" value="{{$row['PO_ID']}}">
              <td><input type="number" name="receive[]" class="form-control productname border-0" ></td>
              <td class="text-center result"><label class="form-control productname border-0" value="{{$row['Product_name']}}" name="product[]" >{{$row['Product_name']}}</label><input type="hidden" value="{{$row['Product_name']}}" name="product[]" ></td>
              <td class="text-center result"><label class="form-control productnumber border-0" value="{{$row['Product_number']}}" >{{$row['Product_number']}}</label> <input type="hidden" name="Product_number[]" value="{{$row['Product_number']}}"></td>
              <td class="text-center result"><label class="form-control unit border-0" value="{{$row['unit']}}" >{{$row['unit']}}</label> <input type="hidden" name="unit[]" value="{{$row['unit']}}"></td>
            </tr>
            @endforeach
            @else
            @foreach($data as $row)
            <tr>
              <td class="text-center">
                <label class="form-control check border-0" require>{{$row[9]}}</label>
                <input type="hidden" name="check[]" value="{{$row[9]}}">
              </td>
              <td>
                <label class="form-control surplus border-0" require>{{$row[10]}}</label>
                <input type="hidden" name="surplus[]" value="{{$row[10]}}">
              </td>
              <input type="hidden" name="PO_ID[]" value="{{$row[0]}}">
              <input type="hidden" name="keyPR[]" value="{{$row[1]}}">
              <input type="hidden" name="keystore[]" value="{{$row[5]}}">
              <td><input type="number" name="receive[]" class="form-control productname border-0" ></td>
              <td class="text-center result"><label class="form-control productname border-0" >{{$row[2]}}</label><input type="hidden" value="{{$row[2]}}" name="product[]" ></td>
              <td class="text-center result"><label class="form-control productnumber border-0" >{{$row[3]}}</label> <input type="hidden" name="Product_number[]" value="{{$row[3]}}"></td>
              <td class="text-center result"><label class="form-control unit border-0" >{{$row[4]}}</label> <input type="hidden" name="unit[]" value="{{$row[4]}}"></td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
        <br>
        <div class="form-group text-center">
          <a class="btn btn-danger" href="{{route('check.index')}}"><i style="font-size:18px" class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          <button id="subform" type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
        </div>
        <input type="hidden" name="_method" value="PATCH" />
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection