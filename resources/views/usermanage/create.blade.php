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
    <div class="card-header">
        <h3 class="text-white"><i class="far fa-plus-square"></i>&nbsp;&nbsp;สร้างข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('text_username','Username') !!}
            {!! Form::text('username','',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('text_password','Password') !!}
            {!! Form::text('password','',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('text_password','Password') !!}
            {!! Form::text('password','',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('text_username','Username') !!}
            {!! Form::text('username','',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('text_address','Address') !!}
            {!! Form::textarea('address','',['class' => 'form-control','rows' => '3']) !!}
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {!! Form::label('text_phone','เบอร์ติดต่อ') !!}
                {!! Form::text('phone','',['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-6"">
                {!! Form::label('text_priority','Priority') !!}
                {!! Form::select('priority',array('blank' => 'กรุณาเลือกระดับการเข้าถึงของผู้ใช้','user' => 'user','admin' => 'admin'),'blank',['class' => 'form-control']) !!}
            </div>
        </div>
        <div class=" form-group text-right mt-3">
                <button type="submit" class="btn btn-success" value="Update"><i class="far fa-save"></i>&nbsp;&nbsp;เพิ่มข้อมูล</button>
                <a class="btn btn-danger" href="{{route('usermanage.index')}}"><i class="fas fa-undo"></i>&nbsp;&nbsp;ย้อนกลับ</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @stop