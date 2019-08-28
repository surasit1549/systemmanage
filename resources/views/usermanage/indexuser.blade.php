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

<div class="form-row col-md-12">
    <div class="form-group">
        <a class="btn btn-sm btn-success text-white" href="{{action('UsermanageController@create')}}">
            <i class="fas fa-plus"></i>
            เพิ่มผู้ใช้งาน
        </a>
    </div>
    <div class="form-group ml-2">
        <a class="btn btn-sm btn-primary text-white" href="#">
            <i class="fas fa-info-circle"></i>
            รายละเอียดการใช้งาน
        </a>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="text-white"><i class="fas fa-users"></i>&nbsp;&nbsp;จัดการข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="usertable">
            <thead>
                <tr>
                    <th style="width:5%">#</th>
                    <th style="width:15%">ชื่อจริง</th>
                    <th style="width:15%">นามสกุล</th>
                    <th style="width:25%">Username</th>
                    <th style="width:20%">ตำแหน่ง</th>
                    <th style="width:30%">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $user as $index=>$users )
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{$users['first_name']}}</td>
                    <td>{{$users['last_name']}}</td>
                    <td>{{$users['username']}}</td>
                    <td>{{$users['role']}}</td>
                    <td>
                        <a href="{{action('UsermanageController@show',$users['id'])}}" data-toggle="tooltip" data-placement="top" title="View"><i style="font-size:20px;;" class="fas fa-eye text-primary"></i></a>
                        &nbsp;&nbsp;
                        <a href="{{action('UsermanageController@edit',$users['id'])}}" data-toggle="tooltip" data-placement="top" title="Edit"><i style="font-size:20px;" class="fas fa-edit text-warning"></i></a>
                        &nbsp;&nbsp;
                        <a class="test" href="#" data-toggle="tooltip" data-placement="top" title="Remove"><i style="font-size:20px;" class="fas fa-trash-alt text-danger"></i></a>
                        <form method="post" class="delete_form" action="{{action('UsermanageController@destroy',$users['id'])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usertable').DataTable({
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
    });
</script>

@stop