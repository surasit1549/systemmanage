@extends('Home.master')
@section('title','My Company ')
@section('tabbarcss')
<style>
    #teratab {
        border-right: 5px solid rgb(41, 207, 219);
    }
</style>
@stop
@section('content')

<a href="/mycompany/1/edit" class="btn btn-sm btn-success mb-2"><i class="fas fa-edit"></i>&nbsp;&nbsp;แก้ไขข้อมูล</a>

<div class="card">
    <div class="card-header text-white">
        <h3><i class="fas fa-home"></i>&nbsp;&nbsp;บริษัท ธีร่า แอสเสท</h3>
    </div>
    <div class="card-body">
        <h3><i class="fas fa-building"></i>&nbsp;&nbsp;ข้อมูลบริษัท</h3>
        <hr class="line">
        <br>
        <div class="form-group">
            <label for="name">ชื่อบริษัท</label>
            <input disabled type="text" class="form-control" name="name" value="{{$com['name']}}">
        </div>
        <div class="form-group">
            <label for="name">ที่อยู่บริษัท</label>
            <textarea disabled name="address" class="form-control" cols="5" rows="4">{{$com['address']}}</textarea>
        </div>
        <div class="row">
            <div class="form-group col-12 col-sm-12 col-md-6">
                <label for="name">เบอร์โทร</label>
                <input disabled type="text" class="form-control" name="phone" value="{{$com['phone']}}">
            </div>
            <div class="form-group col-12 col-sm-12 col-md-6">
                <label for="name">Fax</label>
                <input disabled type="text" class="form-control" name="fax" value="{{$com['fax']}}">
            </div>
        </div>
        <br>
        <h3><i class="fas fa-id-card-alt"></i>&nbsp;&nbsp;ข้อมูลผู้ติดต่อ</h3>
        <hr class="line">
        <br>
        <div class="row">
            <div class="form-group col-12 col-sm-12 col-md-6">
                <label for="name">ชื่อผู้ติดต่อ</label>
                <input disabled type="text" class="form-control" name="contact_name" value="{{$com['contact_name']}}">
            </div>
            <div class="form-group col-12 col-sm-12 col-md-6">
                <label for="name">เบอร์โทรศัพท์</label>
                <input disabled type="text" class="form-control" name="contact_phone" value="{{$com['contact_phone']}}">
            </div>
        </div>
    </div>
</div>


@stop