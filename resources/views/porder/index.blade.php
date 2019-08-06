@extends('Home.master')
@section('title','ใบสังซื้อ ')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
  }
</style>
@stop
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="text-white">ใบสังซื้อ (Puchase Order)</h3>
  </div>
  <div class="card-body">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อเลขที่เอกสาร PO</th>
          <th>ชื่อเลขที่เอกสาร PR</th>
          <th>วันที่ใบสั่งซื้อ</th>
          <th>แปลง</th>
          <th>พิมพ์</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          @foreach($prporders as $row)
            <td>{{$number++}}</td>
            <td>        
              
            </td>
            <td>{{$row[1]}}</td>
            <td>{{$row[3]}}</td>
            <td>{{$row[2]}}</td>
            <td><a href="{{action('PurchaseorderController@show',$row[0])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a></td>
        </tr>
        @endforeach
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
    $('table').DataTable();
  });
</script>

@stop