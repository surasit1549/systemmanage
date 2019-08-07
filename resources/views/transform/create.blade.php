@extends('Home.master')
@section('title','เพิ่มแปลง')
@section('tabbarcss')
<style>
  #transformtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
  }
</style>
@stop
@section('content')
<div class="container">
  <div class="card" style="width:25rem;">
    <div class="card-header text-white">
      <h3><i class="fas fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
<<<<<<< HEAD
      <form method="post" action="{{url('transform')}}" class="need-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">ชื่อแปลง</label>
          <input type="text" name="convertname" class="form-control" required>
          <div class="invalid-feedback">
            กรอกแปลง
          </div>
        </div>
        <div class="form-group">
          <label for="">ขนาด</label>
          <input type="text" name="size" class="form-control" required>
          <div class="invalid-feedback">
            กรอกขนาดแปลง
          </div>
=======
      <form method="post" action="{{url('transform')}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label for="">ชื่อแปลง</label>
          <input type="text" name="convertname" class="form-control" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อแปลง
          </label>
        </div>
        <div class="form-group">
          <label for="">ขนาด</label>
          <input type="text" name="size" class="form-control" autocomplete="off" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อขนาดแปลง
          </label>
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
        </div>
    </div>
    <div class="form-group text-center">
      <a class="btn btn-danger" href="{{route('transform.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
      <button id="subform" type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
    </div>
    </form>
  </div>
</div>
</div>

<<<<<<< HEAD
<script>
  $(document).ready(function() {

=======

<script>
  $(document).ready(function() {
>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });
<<<<<<< HEAD

  });
</script>


=======
  });
</script>

>>>>>>> cfa5a5140ff28a4d4cb674ac54d43ecd56aa995b
@endsection