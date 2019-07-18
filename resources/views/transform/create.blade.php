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
  <div class="card" style="width:25rem;">
    <div class="card-header text-white" style="background-color:#435d7d">
      <h3><i class="fas fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{url('transform')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="">ชื่อแปลง</label> 
          <input type="text" name="convertname" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="">ขนาด</label>
          <input type="text" name="size" class="form-control"  />
        </div>
      </div>
      <div class="form-group text-center">
        <a class="btn btn-danger" href="{{route('transform.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        <button type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection
