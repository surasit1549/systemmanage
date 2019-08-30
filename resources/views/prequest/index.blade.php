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
    <div class="table-responsive">
      <table class="table table-bordered" id="prtable">
        <thead>
          <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col" class="text-nowrap">วันที่ขอซื้อ</th>
            <th scope="col" class="text-nowrap">เลขที่เอกสาร</th>
            <th scope="col" class="text-nowrap">ผู้รับเหมา</th>
            <th scope="col" class="text-nowrap">แบบงาน</th>
            <th scope="col">แปลง</th>
            <th scope="col">สถานะ</th>
            <th scope="col">จัดการ</th>
          </tr>
        </thead>
        <tbody>
          @if(empty($pr_create))

          @else
          @foreach($PR_creates as $row)
          <tr>
            <td scope="row">{{$number++}}</td>
            <td>{{$row[2]}}</td>
            <td class="text-nowrap">{{$row[1]}}</td>
            <td>{{$row[3]}}</td>
            <td class="text-nowrap">{{$row[4]}}</td>
            <td>{{$row[5]}}</td>
            <td>สถานะ</td>
            <td class="text-nowrap">
              &nbsp;&nbsp;
              <a href="{{action('PuchaserequestController@edit',$row[0])}}" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
              &nbsp;&nbsp;
              <a href="#" data-toggle="tooltip" data-placement="top" title="PDF"><i style="font-size:20px" class="text-danger fas fa-file-pdf"></i></a>
              &nbsp;&nbsp;
              <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="ยกเลิกใบขอซื้อ"><i style="font-size:20px;" class="text-danger fas fa-times-circle"></i></a>
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
</div>
@stop