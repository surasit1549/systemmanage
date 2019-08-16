@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {
    
    $('[data-toggle="tooltip"]').tooltip();

    $('#prtable').DataTable();

    $('.test').click(function() {
      $(this).next('form').submit();
    });

  })
</script>
@if(\Session::has('success'))
<div class="alert alert-success">
  <a>{{\Session::get('success')}}</a>
</div>
@endif


<div class="form-row col-md-12">
  <div class="form-group ml-2">
    <a class="btn btn-sm btn-primary text-white" href="#">
      <i class="fas fa-info-circle"></i>
      รายละเอียดการใช้งาน
    </a>
  </div>
</div>

<div class="card">
  <div class="card-header text-white">
    <div class="row">
      <div class="col-md-9">
        <h3 class="text-white"><i class="far fa-file"></i>&nbsp;&nbsp;ใบขอสั่งชื้อ (Puchase Request)</h3>
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="prtable">
      <thead>
        <tr>
          <th style="width:5%">ลำดับ</th>
          <th style="width:10%">วันที่ขอซื้อ</th>
          <th style="width:20%">เลขที่เอกสาร</th>
          <th style="width:10%">ผู้รับเหมา</th>
          <th style="width:20%">แบบงาน</th>
          <th style="width:15%">แปลง</th>
          <th style="width:20%">จัดการ</th>
        </tr>
      </thead>
      <tbody>
        @if(empty($pr_create))
          @foreach($pr_create as $row)
          <tr>
            <td>{{$number++}}</td>
            <td>{{$row['date']}}</td>
            <td>{{$row['key']}}</td>
            <td>{{$row['contractor']}}</td>
            <td>{{$row['formwork']}}</td>
            <td>{{$row['prequestconvert']}}</td>
            <td colspan="3">
              <a href="{{action('PuchaserequestController@show',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
              &nbsp;&nbsp;
              <a href="{{action('PuchaserequestController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
              &nbsp;&nbsp;
              <a href="#" data-toggle="tooltip" data-placement="top" title="Print"><i style="font-size:20px;" class="fas fa-print"></i></a>
              &nbsp;&nbsp;
              <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
              <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row['id'])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE" />
              </form>
            </td>
          </tr>
          @endforeach
        @else
          @foreach($PR_creates as $row)
            <tr>
              <td>{{$number++}}</td>
              <td>{{$row[2]}}</td>
              <td>{{$row[1]}}</td>
              <td>{{$row[3]}}</td>
              <td>{{$row[4]}}</td>
              <td>{{$row[5]}}</td>
              <td colspan="3">
                <a href="{{action('PuchaserequestController@show',$row[0])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
                &nbsp;&nbsp;
                <a href="{{action('PuchaserequestController@edit',$row[0])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
                &nbsp;&nbsp;
                <a href="#" data-toggle="tooltip" data-placement="top" title="Print"><i style="font-size:20px;" class="fas fa-print"></i></a>
                &nbsp;&nbsp;
                <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
                <form method="post" class="delete_form" action="{{action('PuchaserequestController@destroy',$row[0])}}">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="DELETE" />
                </form>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
    </table>
  </div>
</div>
@stop