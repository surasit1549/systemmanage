@extends('Home.master')
@section('title','ตรวจสอบสินค้า ')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="text-white"><i class="far fa-calendar-check"></i>&nbsp;&nbsp;ตรวจสอบสินค้า (Check) </h4>
  </div>
  <div class="card-body">

    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>วันที่ใบสั่งซื้อ</th>
          <th>ชื่อเลขที่เอกสาร PO</th>
          <th>ชื่อเลขที่เอกสาร PR</th>
          <th>แปลง</th>
          <th>ตรวจสอบ</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>AA</td>
          <td>BB</td>
          <td>CC</td>
          <td>DD</td>
          <td>EE</td>
          <td>FF</td>
          <td>GG</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('table').DataTable();
  });
</script>

@stop