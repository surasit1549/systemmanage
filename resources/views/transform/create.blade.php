@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">เพิ่มข้อมูลแปลง</h3> <br />
      <form method="post" action="{{url('transform')}}">
        {{csrf_field()}}
        <div class="form-group">
          <table style="width:100%">
            <tr>
              <td>
                <h>ชื่อแปลง :</h>
                <td><input type="text" name="convertname" class="form-control"/></td>
              </td>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ขนาด :</h></td>
                <td><input type="text" name="size" class="form-control"  /></td>
              </div>
            </tr>
          </table>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="save" />
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
