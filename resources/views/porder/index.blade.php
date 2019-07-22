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
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อเลขที่เอกสาร PO</th>
        <th>ชื่อเลขที่เอกสาร PR</th>
        <th>วันที่ใบสั่งซื้อ</th>
        <th>แปลง</th>
        <th>พิมพ์</th>
      </tr>
      @foreach($pr as $row)
      <tr>
        <td>{{$row['id']}}</td>
        <td>
          {{substr($row['date'],8)}}
          {{substr($row['date'],3,-5)}}

        </td>
        <td>{{$row['keyPR']}}</td>
        <td>{{$row['date']}}</td>
        <td>{{$row['prequestconvert']}}</td>
        <td><a href="{{action('PuchaserequestController@show',$row['id'])}}" class="btn btn-primary btn-sm">พิมพ์</a></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
</div>
</div>
@stop