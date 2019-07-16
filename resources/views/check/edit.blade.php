@extends('Home.master')
@section('title','ตรวจสอบสินค้า ')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        <h1 align="center">ตรวจสอบสินค้า ( Check )</h1><br><br>
        <table class="table table-hover">
          <tr>
            <th>ลำดับ</th>
            <th>วันที่ใบสั่งซื้อ</th>
            <th>ชื่อเลขที่เอกสาร PO</th>
            <th>ชื่อเลขที่เอกสาร PR</th>
            <th>แปลง</th>
            <th>ตรวจสอบ</th>
            <th>ลบ</th>
          </tr>
        </table>
    </div>
  </div>
</div>
@stop
