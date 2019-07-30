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
    <table class="table table-hover">
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
        @foreach($pr as $row)
        <tr>
          @for($i=0; $i<$l; $i++) 
            <td>{{$number++}}</td>
            <td>{{$p1[$i]}}</td>
            <td>{{$p2[$i]}}</td>
            <td>{{$date[$i]}}</td>
            <td>{{$p3[$i]}}</td>
            <td><a href="{{action('PurchaseorderController@show',$row['id'])}}" class="btn btn-primary btn-sm">พิมพ์</a></td>
          </tr>
            @endfor
        @endforeach
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