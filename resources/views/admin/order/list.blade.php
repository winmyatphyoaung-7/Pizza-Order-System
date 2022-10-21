@extends('admin.layouts.master')

@section('title', 'Category List')


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool d-flex justify-content-between">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                    </div>




                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <strong>Total - {{ count($order) }}</strong>
                            </div>

                            <form action="{{route('admin#changeStatus')}}" method="get" class="col-3">
                                @csrf

                                <div class="d-flex">

                                    <div class="input-group mb-3">
                                        <select name="orderStatus" class="form-control">
                                            <option value="all" >All</option>
                                            <option value="0" @if (request('orderStatus') == 0) selected  @endif>Pending</option>
                                            <option value="1" @if (request('orderStatus') == 1) selected  @endif>Success</option>
                                            <option value="2" @if (request('orderStatus') == 2) selected  @endif>Reject</option>
                                        </select>
                                        <button type="submit" class="input-group-text" id="basic-addon2">Search</button>
                                      </div>



                                </div>
                            </form>

                        </div>
                    </div>





                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>

                                    <th class="">User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($order as $o)

                                    <tr class="tr-shadow">

                                        <input type="hidden" class="orderId" value="{{$o->id}}">

                                        <td>
                                            {{ $o->user_id }}
                                        </td>


                                        <td>
                                            {{ $o->user_name }}
                                        </td>

                                        <td>
                                            {{ $o->created_at->format('F-j-Y') }}
                                        </td>

                                        <td>
                                            <a href="{{route('admin#listInfo',$o->order_code)}}">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>

                                        <td>
                                            {{ $o->total_price }} Kyats
                                        </td>

                                        <td>
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>


                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>



                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scriptSection')

    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://localhost:8000/order/ajax/status',
            //         data: {
            //             'status': $status,
            //         },
            //         dataType: 'json',
            //         success: function(response) {



            //             //append
            //             $list = ``;

            //             for ($i = 0; $i<response.length; $i++) {

            //                 $months = ['January','February','March','April','May','June','Jully','August','September','October','November','December'];

            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();
            //                 if(response[$i].status == 0){
            //                     $statusMessage = `
            //                     <select name="status" class="form-control statusChange">
            //                        <option value="0" selected>
            //                            Pending...</option>
            //                        <option value="1" >
            //                            Success...</option>
            //                        <option value="2" >
            //                            Reject...</option>
            //                    </select>
            //                     `;
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                     <select name="status" class="form-control statusChange">
            //                        <option value="0" >
            //                            Pending...</option>
            //                        <option value="1" selected>
            //                            Success...</option>
            //                        <option value="2" >
            //                            Reject...</option>
            //                    </select>
            //                     `;
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `
            //                     <select name="status" class="form-control statusChange">
            //                        <option value="0" >
            //                            Pending...</option>
            //                        <option value="1" >
            //                            Success...</option>
            //                        <option value="2" selected>
            //                            Reject...</option>
            //                    </select>
            //                     `;
            //                 }



            //                 $list += `
            //              <tr class="tr-shadow">

            //                <input type="hidden" class="orderId" value=${"response[$i]->id"}>
            //                <td>
            //                     ${response[$i].user_id}
            //                </td>


            //                <td>
            //                    ${response[$i].user_name}
            //                </td>

            //                <td>
            //                     ${$finalDate}
            //                </td>

            //                <td>
            //                     ${response[$i].order_code}
            //                </td>

            //                <td>
            //                     ${response[$i].total_price}  Kyats
            //                </td>

            //                <td>
            //                    ${$statusMessage}
            //                </td>

            //              </tr>
            //               `;
            //             }

            //             $('#dataList').html($list);

            //         }


            //     })

            // })

            //change status

            $('.statusChange').change(function(){
                console.log("hello world");
                $parentNode = $(this).parents("tr");
                $currentStatus = $(this).val();
                $orderId = $parentNode.find(".orderId").val();

                // $data = {
                //     'status' : $currentStatus,
                //     'orderId': $orderId
                // }

                $.ajax({
                    type: 'get',
                    url : 'http://localhost:8000/order/ajax/change/status',
                    data : {
                        'status' : $currentStatus,
                        'orderId' : $orderId,
                    },
                    dataType : 'json',
                    success : function(response) {

                    }
                })
            })
        })
    </script>

@endsection
