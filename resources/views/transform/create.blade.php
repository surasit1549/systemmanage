@extends('Home.master')
@section('title','เพิ่มแปลง')
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
  <div class="card">
    <div style="background-color:#435d7d" class="card-header text-white">
      <h3>เพิ่มข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
        <form method="post" action="{{url('transform')}}">
          {{csrf_field()}}
          <div class="form-group">
            <table style="width:100%">
              <tr>
                  <td>ชื่อแปลง</td>
                  <td><input type="text" name="convertname" class="form-control"/></td>
              </tr>
              <tr>
                <div class="form-group">
                  <td>ขนาด</td>
                  <td><input type="text" name="size" class="form-control"  /></td>
                </div>
              </tr>
            </table>
          </div>
          <div class="form-group">
            <button class="btn btn-danger"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</button>
            <button type="submit" class="btn btn-success"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection
