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
    <form id="create_user_form" method="post" action="{{ action('UsermanageController@update',$user['id']) }}">
        {{csrf_field()}}
        <input type="hidden" name="username" value="{{$user['username']}}">
        <div class="card-body">
            <h3><i class="fas fa-user"></i>&nbsp;&nbsp;รายละเอียดข้อมูลส่วนตัว</h3>
            <hr class="line">
            <br>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">ชื่อจริง</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user['firstname'] }}" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="">นามสกุล</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user['lastname'] }}" autocomplete="off">
                </div>
                <div class="form-group col-md-12">
                    <label for="">ที่อยู่ปัจจุบัน</label>
                    <textarea class="form-control" name="address" id="address" rows="3">{{ $user['address'] }}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="">เบอร์โทรติดต่อ</label>
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" value="{{ $user['phone'] }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="{{ $user['email'] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="">ตำแหน่ง</label>
                <select name="role" class="custom-select" id="role">
                    @foreach( $role as $roles )
                    <option value="{{$roles->id_role}}" @if( $user['role']==$roles->id_role ) selected @endif >{{$roles->name_role}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-center mb-3">
            <a href="#" id="deny" class="btn btn-danger text-white"><i class="fas fa-undo-alt"></i>&nbsp;&nbsp;ย้อนกลับ</a>
            <button type="submit" id="save" name="save" class="btn btn-success ml-2"><i class="fas fa-check"></i>&nbsp;&nbsp;บันทึก</button>
        </div>
        <input type="hidden" name="id" value="{{$user['id']}}">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="token" value="{{csrf_token()}}">
    </form>


    <div class="modal fade" id="passcode_confirm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i style="font-size:20px" class="fas fa-key mr-2 text-danger"></i>กรอกรหัสลับ</h5>
                    <button data-dismiss="modal" class="close">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/checkpasscode']) !!}
                    <div class="form-group">
                        {!! Form::label('รหัสลับ') !!}
                        {!! Form::password('passkey',['class' => 'form-control','maxlength' => 4]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('ยืนยัน',['class' => 'btn btn-success','id' => 'sub_confirm']) !!}
                    <a class="btn btn-secondary" data-dismiss="modal" href="#">ยกเลิก</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#create_user_form').validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    role: "required",
                    phone: {
                        required: true,
                        minlength: 9
                    },
                    address: "required",
                    email: "required"
                },
                messages: {
                    first_name: "กรุณากรอกชื่อจริง",
                    last_name: "กรุณากรอกนามสกุล",
                    role: "กรุณาเลือกตำแหน่ง",
                    email: {
                        required: 'กรุณากรอกอีเมล'
                    },
                    phone: {
                        required: 'กรุณากรอกเบอร์โทรศัพท์มือถือ',
                        minlength: 'เบอร์โทรต้องมีอย่างน้อย 9 ตัว'
                    },
                    address: {
                        required: 'กรอกที่อยู่ในปัจจุบัน'
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
                },
                submitHandler: function(form) {
                    $('#passcode_confirm').modal('show');
                    $('#sub_confirm').click(function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $.ajax({
                            type: 'POST',
                            url: 'checkpasscode',
                            data: {
                                _token: '{{csrf_token()}}',
                                passkey: $('input[name=passkey]').val()
                            },
                            success: function(data) {
                                if (data.msg) {
                                    form.submit();
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'รหัสลับไม่ถูกต้อง',
                                        text: 'กรอกรหัสลับอีกครั้ง',
                                        confirmButtonText: 'ตกลง',
                                        onAfterClose: () => {
                                            $('input[name=passkey]').val('').focus();
                                        }
                                    })
                                }
                            }
                        });
                    });
                }
            });


            $('#passcode_confirm').on('shown.bs.modal', function() {
                $(this).find('input[name=passkey]').focus();
            }).on('hidden.bs.modal', function() {
                $(this).find('input[name=passkey]').val('');
            });

            $('#deny').click(function() {
                event.preventDefault();
                event.stopPropagation();
                Swal.fire({
                    title: 'แน่ใจหรือไม่ว่าต้องการย้อนกลับ',
                    text: 'หากย้อนกลับข้อมูลทุกอย่างที่กรอกไว้จะสูญหายไป',
                    type: 'question',
                    confirmButtonText: 'ยอมรับ',
                    cancelButtonText: 'ปฎิเสธ',
                    showCancelButton: true,
                    focusCancel: true
                }).then((result) => {
                    if (result.value) {
                        window.history.back();
                    }
                });
            });
        });
    </script>
    @stop