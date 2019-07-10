@extends('Home.master')
@section('title','ใบสังซื้อ ')
@section('tabbarcss')
  <style>
    #prtab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
        <h1 align="center">ใบสังซื้อ (Puchase Order)</h1><br><br>
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
@stop
