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
        <h3 class="text-white"><i class="far fa-file-alt"></i>&nbsp;&nbsp;แก้ไขข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        {!! Form::model($user,['action' => 'UsermanageController@store']) !!}
        <div class="form-group">
            <label for="username">Username</label>
            {!! Form::text('username',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            {!! Form::text('new_password','',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="password">New Password again</label>
            {!! Form::text('renew_password','',['class' => 'form-control']) !!}
        </div>
        <div class=" form-group">
            <label for="name">ชื่อผู้ใช้งาน</label>
            {!! Form::text('name',null,['class' => 'form-control']) !!}
        </div>
        <div class=" form-group">
            <label for="address">ที่อยู่</label>
            {!! Form::textarea('address',null,['class' => 'form-control','rows' => '4']) !!}
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="address">เบอร์ติดต่อ</label>
                {!! Form::text('phone_number',null,['class' => 'form-control']) !!}
            </div>
            <div class=" form-group col-md-6"">
                <label for=" priority">Priority</label>
                {!! Form::select('priority',array('user' => 'user','admin' => 'admin'),null,['class' => 'form-control']) !!}

            </div>
            <div class="form-group text-right mt-3">
                <a class="btn btn-danger" href="{{route('usermanage.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
                <button type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;บันทึกข้อมูล</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop