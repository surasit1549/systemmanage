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

@if(session('msg'))
<div class="alert alert-success alert-dismissible fade show">
    <h5 class="alert-heading"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;กระบวนการสำเร็จ</h5>
    <hr>
    <p>{{ session('msg') }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('update'))
<div class="alert alert-success alert-dismissible fade show">
    <h5 class="alert-heading"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;แก้ไขข้อมูลสำเร็จ</h5>
    <hr>
    <p>{{ session('update') }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<div class="form-row col-md-12">
    <div class="form-group">
        <a class="btn btn-sm btn-success text-white" href="{{action('UsermanageController@create')}}">
            <i class="fas fa-plus"></i>
            เพิ่มผู้ใช้งาน
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="text-white card-title"><i class="fas fa-users"></i>&nbsp;&nbsp;จัดการข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="main_table" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap">#</th>
                    <th class="text-nowrap">ชื่อจริง</th>
                    <th class="text-nowrap">นามสกุล</th>
                    <th class="text-nowrap">Username</th>
                    <th class="text-nowrap">ตำแหน่ง</th>
                    <th class="text-nowrap">สถานะ</th>
                    <th class="text-nowrap">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $user as $index=>$users )
                <tr>
                    <input type="hidden" class="email" value="{{$users['email']}}">
                    <input type="hidden" class="phone" value="{{$users['phone']}}">
                    <input type="hidden" class="address" value="{{$users['address']}}">
                    <td style="cursor:pointer" class="text-nowrap details-control text-center"><i style="font-size:20px" class="fa fa-plus-square text-success" aria-hidden="true"></i></td>
                    <td class="text-nowrap">{{$users['firstname']}}</td>
                    <td class="text-nowrap">{{$users['lastname']}}</td>
                    <td class="text-nowrap">{{$users['username']}}</td>
                    <td class="text-nowrap">{{$users['name_role']}}</td>
                    <td class="text-nowrap">
                        @if( $users['status'] == 'Active' )
                        <button class="btn btn-sm btn-success">Active</button>
                        @else
                        <button class="btn btn-sm btn-secondary">Banned</button>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{action('UsermanageController@edit',$users['id'])}}" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
                        &nbsp;&nbsp;
                        <a style="font-size:20px" data-toggle="tooltip" data-placement="top" title="เปลี่ยนรหัสผ่าน" href="/usermanage/{{$users['id']}}/changepass"><i class="fas fa-key text-info"></i></a>
                        &nbsp;&nbsp;
                        @if( $users['status'] == 'Active' )
                        <span data-toggle="tooltip" data-placement="top" title="ปลดแบน">
                            <a class="test" data-id="{{$users['id']}}" data-toggle="modal" data-target="#passcode_confirm"><i style="font-size:20px" class="fas fa-ban text-danger"></i></a>
                        </span>
                        <form method="post" action="{{action('UsermanageController@destroy',$users['id'])}}">
                            @csrf
                            <input type="hidden" name="username" value="{{$users['username']}}">
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                        @else
                        <span data-toggle="tooltip" data-placement="top" title="แบนผู้ใช้งาน">
                            <a class="test" data-id="{{$users['id']}}" data-toggle="modal" data-target="#passcode_confirm"><i style="font-size:20px" class="fas fa-check-circle text-success"></i></a>
                        </span>
                        <form method="post" action="/usermanage/activeUser">
                            @csrf
                            <input type="hidden" name="id" value="{{$users['id']}}">
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="passcode_confirm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5><i style="font-size:20px" class="fas fa-key mr-2 text-danger"></i>กรอกรหัสลับ</h5>
                    <button data-dismiss="modal" class="close">&times;</button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => 'checkpasscode']) !!}
                    <div class="form-group">
                        {!! Form::label('รหัสลับ') !!}
                        {!! Form::password('passkey',['class' => 'form-control','maxlength' => 4]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="trythis">
                    {!! Form::submit('ยืนยัน',['class' => 'btn btn-success','id' => 'sub_confirm']) !!}
                    <a class="btn btn-secondary" data-dismiss="modal" href="#">ยกเลิก</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            var table = $('#main_table').DataTable({
                'scrollX': true,
                order: [
                    [1, 'desc']
                ],
                'columns': [{
                        'orderable': false,
                        'width': '5%'
                    },
                    null,
                    null,
                    null,
                    null,
                    null,
                    {
                        'orderable': false
                    }
                ],
                "oLanguage": {
                    "sSearch": 'ค้นหา',
                    "sInfo": 'ผู้ใช้งานจำนวน _TOTAL_ ไอดี',
                    'sEmptyTable': 'ไม่มีข้อมูลผู้ใช้งาน',
                    'sInfoEmpty': 'ไม่พบรายการที่ต้องการ',
                    'sZeroRecords': 'ไม่พบคำที่ต้องการค้นหา',
                    "oPaginate": {
                        "sPrevious": 'ก่อนหน้า',
                        "sNext": 'ถัดไป'
                    },
                    "sInfoFiltered": '( จากทั้งหมด _MAX_ รายการ )',
                    "sLengthMenu": 'แสดงข้อมูล <select class="custom-select custom-select-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="30">30</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">ทั้งหมด</option>' +
                        '</select> รายการ'
                }
            });
            $('[data-toggle="tooltip"]').tooltip();

            function format(email, phone, address) {
                // `d` is the original data object for the row
                return '<table class="table table-light"><tr><th>อีเมล</th><td>' + email + '</td><th>เบอร์โทรศัพท์</th><td>' + phone + '</td></tr><tr><th>ที่อยู่</th><td>' + address + '</td></tr></table>';
            }

            $('#main_table tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var tdi = tr.find('i.fa');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square text-danger');
                    tdi.first().addClass('fa-plus-square text-success');
                } else {
                    // Open this row
                    var email = $(this).parent().find('.email').val();
                    var phone = $(this).parent().find('.phone').val();
                    var address = $(this).parent().find('.address').val();
                    row.child(format(email, phone, address)).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square text-success');
                    tdi.first().addClass('fa-minus-square text-danger');
                }
            });



            $('.test').click(function() {
                $('#passcode_confirm').find('#trythis').val($(this).data('id'));
            });


            $('#passcode_confirm').on('shown.bs.modal', function() {
                $(this).find('input[name=passkey]').focus();
            }).on('hidden.bs.modal', function() {
                $(this).find('input[name=passkey]').val();
            });

            $('#sub_confirm').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                var id = $(this).prev('input[type=hidden]').val();
                $.ajax({
                    type: 'POST',
                    url: 'Product/checkpasscode',
                    data: {
                        _token: '{{csrf_token()}}',
                        passkey: $('input[name=passkey]').val()
                    },
                    success: function(data) {
                        if (data.msg) {
                            $('#main_table').find('a[data-id=' + id + ']').parent().next('form').submit();
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


        });
    </script>

    @stop