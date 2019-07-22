@extends('Home.master')
@section('title','Users Information')
@section('tabbarcss')
<style>
    #usertab {
        border-right: 5px solid rgb(41, 207, 219);
    }
</style>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-white"><i class="far fa-file-alt"></i>&nbsp;&nbsp;ข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <div class="form-group"><label for="username">Username</label><input type="text" class="form-control" value="{{$user->username}}" disabled></div>
        <div class="form-group"><label for="name">ชื่อผู้ใช้งาน</label><input type="text" class="form-control" value="{{$user->name}}" disabled></div>
        <div class="form-group"><label for="address">ที่อยู่</label><textarea class="form-control" rows="3" disabled>{{$user->address}}</textarea></div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">เบอร์ติดต่อ</label>
                <input type="text" class="form-control" value="{{$user->phone_number}}" disabled>
            </div>
            <div class="form-group col-md-6"">
                    <label for=" priority">Priority</label>
                <input type="text" class="form-control" value="{{$user->priority}}" disabled>
            </div>
        </div>
        <div class="form-group text-center mt-3">
            <a class="btn btn-lg btn-danger" href="{{route('usermanage.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
        </div>
    </div>
</div>
@stop