@extends('Home.master')
@section('title','ข้อมูลใบสั่งซื้อ PO')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header text-white">
      <h3><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลใบสั่งซื้อ</h3>
    </div>
    <div class="card-body">
    <form method="post" action="{{action('PurchaseorderController@show', $id)}}">
        {{csrf_field()}}
        <div class='text-right'>
          <button class="btn btn-lg btn-primary"><i class="fas fa-print"></i>&nbsp;&nbsp;พิมพ์เอกสาร</button>
        </div>

        <hr>

        <div class="container">
          <table class="table table-borderless">
            <tr>
              <th> ผู้ขาย :</th>
              <td>
                {{$po_store[0][1]}}&nbsp;&nbsp; [ {{$po_store[0][0]}} ] 
              </td>
              <th> วันที่เอกสาร :</th>
              <td>
                {{$po_date}}
              </td>
            </tr>
            <tr>
              <th> ที่อยู่ :</td>
              <td>
                {{$po_store[0][2]}}
              </td>
              <th>  ผู้ติดต่อ : </th>
              <td>
                {{$po_store[0][5]}} &nbsp;&nbsp; {{$po_store[0][6]}}
              </td>
            </tr>
            <tr>
              <th> โทรศัพท์ :</th>
              <td>
                {{$po_store[0][3]}}
              </td>
              <th> วันที่กำหนดส่ง : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> โทรสาร : </th>
              <td>
                {{$po_store[0][4]}}
              </td>
              <th> จำนวนเครดิต : </th>
              <td>

              </td>
            </tr>
            <tr>
              <th> </th>
              <td> </td>
              <th> เงื่อนไขการชำระ :  </th>
              <td>

              </td>
            </tr>
          </table>
        </div>

        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>ลำดับที่</th>
              <th>ชื่อสินค้า</th>
              <th>จำนวนสินค้า</th>
              <th>หน่วย</th>
              <th>ราคา (บาท)</th>
              <th>จำนวนเงิน</th>
            </tr>
          </thead>
          <tbody>
            @foreach($po_product as $row)
              <tr>
                  <td style="width:5%">{{$number++}}</td>
                  <td style="width:20%">{{$row[2]}}</td>
                  <td style="width:10%">{{$row[3]}}</td>
                  <td style="width:10%">{{$row[4]}}</td>
                  <td style="width:10%">{{$row[6]}}</td>
                  <td style="width:10%">{{$row[7]}}</td>
              </tr><br>
            @endforeach
          </tbody>

        </table>
        <br>
        <div class="text-center">
          <a class="btn btn-danger btn-lg" href="{{route('porder.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection