@extends('Home.master')
@section('title','แก้ไขแปลง')
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
      <h3><i class="far fa-file"></i>&nbsp;&nbsp;แก้ไขข้อมูลแปลง</h3>
    </div>
    <div class="card-body">
      <form method="post" action="{{action('ProductController@update', $id)}}" class="needs-validation" novalidate>
        {{csrf_field()}}
        <div class="form-group">
          <label>ชื่อแปลง</label>
          <input type="text" name="convertname" class="form-control" value="{{$transform->convertname}}" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อแปลง
          </label>
        </div>
        <div class="form-group">
          <label>ขนาด</label>
          <input type="text" name="size" class="form-control" value="{{$transform->size}}" required>
          <label for="" class="invalid-feedback">
            กรอกชื่อขนาดแปลง
          </label>
        </div>
        <br>
        <div class="form-group text-center">
          <a class="btn btn-danger" href="{{route('transform.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
          &nbsp;
          <button id="subform" type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึก</button>
        </div>
        <input type="hidden" name="_method" value="PATCH" />
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#subform').click(function() {
      if ($('form')[0].checkValidity() == false) {
        event.preventDefault();
        event.stopPropagation();
        $('form').addClass('was-validated');
      }
    });
  });
</script>

@endsection