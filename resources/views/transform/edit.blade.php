@extends('Home.master')
@section('title','แก้ไขแปลง')
@section('tabbarcss')
  <style>
    #transformtab {
      border-right : 5px solid rgb(41, 207, 219);
    }
  }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12"> <br />
      <h3 align="center">แก้ไขข้อมูลแปลง</h3> <br />
      <form method="post" action="{{action('TransformController@update', $id)}}">
        {{csrf_field()}}
        <div class="form-group">
          <table style="width:100%">
            <tr>
              <td>
                <h>ชื่อแปลง :</h>
                <td><input type="text" name="convertname" class="form-control" value="{{$transform->convertname}}"/></td>
              </td>
            </tr>
            <tr>
              <div class="form-group">
                <td><h>ขนาด :</h></td>
                <td><input type="text" name="size" class="form-control" value="{{$transform->size}}" /></td>
              </div>
            </tr>
          </table>
        </div>
          </table>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Update" />
          </div>
            <input type="hidden" name="_method" value="PATCH"/>
      </form>
    </div>
  </div>
</div>
@endsection
