@extends('Home.master')
@section('title','welcome Homepage')
@section('tabbarcss')
<style>
  #storetab {
    border-right: 5px solid rgb(41, 207, 219);
  }

  #searchtext:focus {
    outline: none !important;
    box-shadow: none;
  }
</style>
@stop
@section('content')
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.test').click(function() {
      $(this).next('form').submit();
    });

    $('#iconsearch').click(function() {
      var check = $('#searchform');
      if (check.hasClass('d-none'))
        check.removeClass('d-none');
      else
        check.addClass('d-none');
      $('#searchtext').focus();
    });

    $('#searchtext').keyup(function() {
      $('table tbody tr').filter(function() {
        var existnum = $(this).find('.schnum').text().toLowerCase();
        var existname = $(this).find('.schtext').text().toLowerCase();
        var search = $('#searchtext').val().toLowerCase();
        $(this).toggle((existnum.indexOf(search) > -1) || (existname.indexOf(search) > -1));
      });
    });

  });
</script>
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      @if(\Session::has('success'))
      <div class="alert alert-success">
        <a>{{\Session::get('success')}}</a>
      </div>
      @endif
      <div class="card">
        <div class="card-header" style="background-color:#435d7d;">
          <div class="row">
            <div class="col-md-10">
              <h3 class="text-white"><i class="fas fa-store"></i>&nbsp;&nbsp;STORES</h3>
            </div>

            <div class="col-md-2 text-right">
              <a href="#" id="iconsearch"><i style="font-size:18px" class="fas fa-search text-white"></i></a>
              &nbsp;&nbsp;
              <a class="btn btn-success text-white text-right" href="{{route('store.create')}}">
                <i class="fas fa-plus"></i>
                เพิ่มร้านค้า
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="input-group d-none" id="searchform">
            <div class="input-group-prepend">
              <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" id="searchtext" class="form-control" placeholder="กรอกรหัสร้านค้าหรือชื่อร้านค้าที่ต้องการค้นหา..">
          </div>
          <br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width:5%;">#</th>
                <th style="width:15%;">รหัสร้านค้า</th>
                <th style="width:40%;">ชื่อร้านค้า</th>
                <th colspan="3">Manage</th>
              </tr>
            </thead>
            <tbody>
              @foreach($store as $row)
              <tr>
                <td>{{$row['id']}}</td>
                <td class="schnum">{{$row['keystore']}}</td>
                <td class="schtext">{{$row['name']}}</td>
                <td colspan="3">
                  <a href="{{action('StoreController@show',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
                  &nbsp;&nbsp;
                  <a href="{{action('StoreController@edit',$row['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
                  &nbsp;&nbsp;
                  <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
                  <form method="post" class="delete_form" action="{{action('StoreController@destroy',$row['id'])}}">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE" />
                  </form>
              </tr>
        </div>
        @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>


@stop