@extends('Home.master')
@section('title','ใบสังซื้อ ')
@section('tabbarcss')
<style>
  #prtab {
    border-right: 5px solid rgb(41, 207, 219);
  }
  }
</style>
@stop
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="text-white">ใบสังซื้อ (Puchase Order)</h3>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <tr>
        <th>ลำดับ</th>
        <th>ชื่อเลขที่เอกสาร PO</th>
        <th>ชื่อเลขที่เอกสาร PR</th>
        <th>วันที่ใบสั่งซื้อ</th>
        <th>แปลง</th>
        <th>สินค้า</th>
        <th>พิมพ์</th>
      </tr>
      @foreach($pr as $row)
        @foreach($porderproduct as $rows)
        
            @if($row['keyPR'] === $rows['keyPR'] )

                  <tr>
                    <td>{{$number++}}</td>
                    <td>
                      {{substr($row['date'],8)}}
                      {{substr($row['date'],3,-5)}}-
                      {{ strval($num1++)}}
                    </td>
                    <td>{{$row['keyPR']}}</td>
                    <td>{{$row['date']}}</td>
                    <td>{{$row['prequestconvert']}}</td>
                    <td>{{$rows['productname']}}</td>
                    <td><a href="{{action('PurchaseorderController@show',$row['id'])}}" class="btn btn-primary btn-sm">พิมพ์</a></td>
                  </tr>
            @endif
         
        @endforeach
      @endforeach
    </table>
  </div>
</div>


<script type="text/javascript">
  var a = "0",
    b = "0",
    c = "0",
    result, num;
  result = a + b + c;
  result = parseInt(result);
  result = result + 1;
  num = result;
  if (num < 10) {
    esult = result.toString();
    result = a + b + result;
  } else if (num < 100) {
    esult = result.toString();
    result = a + result;
  } else {
    esult = result.toString();
    result = result;
  }

  $(document).ready(function() {
    $('p').append(result);
  });
</script>
@stop