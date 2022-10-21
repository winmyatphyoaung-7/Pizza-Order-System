@extends('admin.layouts.master')

@section('title', 'Category List')


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->





                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                {{-- <strong>Total - {{ count($order) }}</strong> --}}
                            </div>


                        </div>
                    </div>


                    <a href="{{route('admin#orderList')}}" class="text-dark"><i class="me-2 fa-solid fa-arrow-left-long"></i>Back</a>

                    <div class="row col-5">
                        <div class="card mt-4 pl-0 pr-0">
                            <div class="card-header ">
                               <h4 class="text-center">CARD INFO</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                    <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col">{{$orderList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-clock me-2"></i>Oder Date</div>
                                    <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col"><i class="fa-solid fa-clock me-2"></i>Total</div>
                                    <div class="col">{{$order->total_price}} Kyats</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="">User Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Time</th>
                                    <th>Qty</th>
                                    <th>Amount</th>

                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($orderList as $ol )

                                <tr>
                                    <td></td>
                                    <td>{{$ol->user_id}}</td>
                                    <td><img src="{{asset('storage/'.$ol->product_image)}}" class="rounded" style="width: 100px;height:100px;"  alt=""></td>
                                    <td>{{$ol->product_name}}</td>
                                    <td>{{$ol->created_at->format('F-j-Y')}}</td>
                                    <td>{{$ol->qty}}</td>
                                    <td>{{$ol->total}} Kyats</td>

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

