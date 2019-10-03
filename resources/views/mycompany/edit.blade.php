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

<div class="card">
    <div class="card-header text-white">
        <h3><i class="fas fa-home"></i>&nbsp;&nbsp;บริษัท ธีร่า แอสเสท</h3>
    </div>
    <div class="card-body">
        <h3><i class="fas fa-building"></i>&nbsp;&nbsp;ข้อมูลบริษัท</h3>
        <hr class="line">
        <br>
        {!! Form::model($com,['route' => ['mycompany.update', $com->id],'method' => 'patch']) !!}
        <div class="form-group">
            {!! Form::label('ชื่อบริษัท') !!}
            {!! Form::text('name',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ที่อยู่บริษัท') !!}
            {!! Form::textarea('address',null,['class' => 'form-control','rows' => '4']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('โทรศัพท์') !!}
            {!! Form::text('phone',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Fax') !!}
            {!! Form::text('fax',null,['class' => 'form-control']) !!}
        </div>
        <br>
        <h3><i class="fas fa-building"></i>&nbsp;&nbsp;ข้อมูลบริษัท</h3>
        <hr class="line">
        <br>
        <div class="row">
            <div class="form-group col-12 col-sm-12 col-md-6">
                {!! Form::label('ชื่อผู้ติดต่อ') !!}
                {!! Form::text('contact_name',null,['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-12 col-sm-12 col-md-6">
                {!! Form::label('เบอร์โทรศัพท์') !!}
                {!! Form::text('contact_phone',null,['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" id="confirm">บันทึกข้อมูล</button>
            <a class="btn btn-secondary ml-2" href="#" onclick="window.history.back()">ย้อนกลับ</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    $(document).ready(function() {
        $('#confirm').click(function() {
            $(this).html('<div class="spinner-border spinner-border-sm" role="status"><span class = "sr-only">Loading...< /span></div>&nbsp;&nbsp;กำลังประมวลผล');
        });

        $('form').validate({
                rules: {
                    'name': {
                        'required': true,
                        'minlength': 5
                    },
                    'address': {
                        'required': true,
                        'minlength': 10
                    },
                    'phone': {
                        'required': true,
                        'minlength': 10
                    },
                    'fax': {
                        'required': true,
                        'minlength': 9
                    },
                    'contact_name': 'required',
                    'contact_phone': {
                        'required': true,
                        'minlength': 10
                    }
                },
                messages: {
                    'name': {
                        'required': 'กรอกชื่อบริษัท',
                        'minlength': 'กรอกอย่างน้อย 5 ตัวอักษร'
                    },
                    'address': {
                        'required': 'กรอกที่อยู่บริษัท',
                        'minlength': 'กรอกอย่างน้อย 10 ตัวอักษร'
                    },
                    'phone': {
                        'required': 'กรอกเบอร์บริษัท',
                        'minlength': 'กรอกอย่างน้อย 10 ตัวอักษร'
                    },
                    'fax': {
                        'required': 'กรอกหมายเลข Fax',
                        'minlength': 'กรอกอย่างน้อย 9 ตัวอักษร'
                    },
                    'contact_name': 'กรอกชื่อผู้ติดต่อ',
                    'contact_phone': {
                        'required': 'กรอกเบอร์โทรศัพท์',
                        'minlength': 'กรอกอย่างน้อย 10 ตัวอักษร'
                    }
                },
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }

            });
    });
</script>


@stop