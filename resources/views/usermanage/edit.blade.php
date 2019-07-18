@extends('Home.master')
@section('title','Users Information')
@section('tabbarcss')
<style>
    #usertab {
        border-right: 5px solid rgb(41, 207, 219);
    }
    }
</style>
@stop
@section('content')
<div class="card">
    <div class="card-header" style="background-color:#435d7d;">
        <h3 class="text-white"><i class="far fa-file-alt"></i>&nbsp;&nbsp;แก้ไขข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-group"><label for="username">Username</label><input type="text" class="form-control" value="{{$user->username}}"></div>
            <div class="form-group"><label for="password">New Password</label><input type="password" class="form-control"></div>
            <div class="form-group"><label for="password">New Password again</label><input type="password" class="form-control"></div>
            <div class=" form-group"><label for="name">ชื่อผู้ใช้งาน</label><input type="text" class="form-control" value="{{$user->name}}"></div>
            <div class=" form-group"><label for="address">ที่อยู่</label><textarea class="form-control" rows="3">{{$user->address}}</textarea></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">เบอร์ติดต่อ</label>
                    <input type="text" class="form-control" value="{{$user->phone_number}}">
                </div>
                <div class=" form-group col-md-6"">
                    <label for=" priority">Priority</label>
                    <select class="form-control">
                        <option value="user" {{ if($user->priority == 'user') return "selected"; }}>User</option>
                        <option value="admin" {{ if($user->priority == 'admin') return "selected"; }}Admin</option> </select> </div> </div> <div class="form-group text-right mt-3">
                            <a class="btn btn-danger" href="{{route('usermanage.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                            <button type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
                </div>
        </form>
    </div>
</div>
@stop