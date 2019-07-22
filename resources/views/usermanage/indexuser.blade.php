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
        <h3 class="text-white"><i class="fas fa-users"></i>&nbsp;&nbsp;จัดการข้อมูลผู้ใช้งาน</h3>
    </div>
    <div class="card-body">
        <div>
            <div class="text-right mb-3">
                <a class="btn btn-info" href="{{action('UsermanageController@create')}}">Create</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:10%">ลำดับ</th>
                        <th style="width:30%">ชื่อ</th>
                        <th style="width:30%">ไอดี</th>
                        <th style="width:10%">สิทธิ์</th>
                        <th style="width:20%">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $user as $users )
                    <td>{{$users['id']}}</td>
                    <td>{{$users['name']}}</td>
                    <td>{{$users['username']}}</td>
                    <td>
                        {{$users['priority']}}

                    </td>
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
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@stop