@extends('Home.master')
@section('title','ใบสังซื้อ ')
@section('tabbarcss')
<style>
  #potab {
    border-right: 5px solid rgb(41, 207, 219);
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
          <th>ชื่อเลขที่เอกสาร PO</th>
          <th>ชื่อเลขที่เอกสาร PR</th>
          <th>วันที่ใบสั่งซื้อ</th>
          <th>สถานะ</th>
          <th>จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(!empty($data))
        <tr>
          @foreach($data as $row)
          <td>{{$row['PO_ID']}}</td>
          <td>{{$row['keyPR']}}</td>
          <td>{{substr($row['created_at'],0,-9)}}</td>
          <td>
            @if( $row['status'] == 'ครบ' )
            <button class="btn btn-sm btn-success"><i class="fas fa-check"></i>&nbsp;&nbsp;{{$row['status']}}</button>
            @else
            <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i>&nbsp;&nbsp;{{$row['status']}}</button>
            @endif
          </td>
          <td>
            <a class="ml-2" href="{{action('PurchaseorderController@show',$row['PO_ID'])}}" data-toggle="tooltip" data-placement="top" title="PDF"><i style="font-size:20px" class="text-danger fas fa-file-pdf"></i></a>
          </td>
        </tr>
        @endforeach
        @endif
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#prpo_form').click();
    $('[data-toggle=tooltip]').tooltip();
    $('table').DataTable({
      'columnDefs': [{
        'orderable': false,
        'targets': 4
      }]
    });
  });
</script>

@stop