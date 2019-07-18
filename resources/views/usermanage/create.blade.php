@extends('Home.master')
@section('title','Users Information')
@section('tabbarcss')
<style>
    #usertab {
        border-right: 5px solid rgb(41, 207, 219);
    }

    #searchtext:focus {
        outline: none !important;
        box-shadow: none;
    }
</style>
@stop
@section('content')
<div class="card">
    <div class="card-header" style="background-color:#435d7d;">
        <h3 class="text-white"><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-group"><label for="username">Username</label><input type="text" class="form-control"></div>
            <div class="form-group"><label for="password">Password</label><input type="password" class="form-control"></div>
            <div class="form-group"><label for="password">Password again</label><input type="password" class="form-control"></div>
            <div class="form-group"><label for="name">ชื่อผู้ใช้งาน</label><input type="text" class="form-control"></div>
            <div class="form-group"><label for="address">ที่อยู่</label><textarea class="form-control" rows="3"></textarea></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">เบอร์ติดต่อ</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group col-md-6"">
                    <label for="priority">Priority</label>
                    <select class=" form-control">
                        <option value="blank">กรุณาเลือกระดับการใช้งานของผู้ใช้</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group text-right mt-3">
                <button type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;เพิ่มข้อมูล</button>
                <a class="btn btn-danger" href="{{route('usermanage.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
            </div>
        </form>
    </div>
</div>
@stop