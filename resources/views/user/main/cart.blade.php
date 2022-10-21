@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <td>Image</td>
                            <td>Products</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td class="col-3">Total</td>
                            <td>Remove</td>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach ($cartList as $cl)
                            <tr>
                                <td class="align-middle">
                                    <img class="rounded " src="{{ asset('storage/' . $cl->pizza_image) }}" alt=""
                                        style="width: 80px;">
                                </td>
                                <td class="align-middle">
                                    <span class="">{{ $cl->pizza_name }}
                                        <input type="hidden" class="orderId" value="{{ $cl->id }}">
                                        <input type="hidden" class="productId" value="{{ $cl->products_id }}">
                                        <input type="hidden" class="userId" value="{{ $cl->user_id }}">
                                    </span>
                                </td>
                                <td class="align-middle" id="price">{{ $cl->pizza_price }} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cl->qty }}" id="qty" disabled>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle" id="total">{{ $cl->pizza_price * $cl->qty }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalResult">{{ $totalPrice + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            Proceed To Checkout
                        </button>

                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">
                                Clear Cart
                            </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    {{-- jquery --}}
    <script>
        $(document).ready(function() {
            $('.btn-plus').click(function() {
                $parentNote = $(this).parents("tr");
                $price = Number($parentNote.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNote.find('#qty').val());
                $totalValue = $price * $qty;
                $parentNote.find('#total').html($totalValue + "Kyats");

                summaryCalculation();
            });

            $('.btn-minus').click(function() {
                $parentNote = $(this).parents("tr");
                $price = Number($parentNote.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNote.find('#qty').val());

                if ($qty == 0) {
                    $(".btn-minus").attr('disabled');
                }
                $totalValue = $price * $qty;
                $parentNote.find('#total').html($totalValue + "Kyats");

                // total summary

                summaryCalculation();

            })



            function summaryCalculation() {
                $totalPrice = 0;
                $("#dataTable tbody tr").each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
                });

                $("#subTotalPrice").html($totalPrice + "Kyats");
                $("#finalResult").text(($totalPrice + 3000) + " Kyats");
            }
        })
    </script>

    {{-- ajax --}}
    <script>
        $('#orderBtn').click(function() {

            $orderList = [];

            $random = Math.floor(Math.random() * 100000001);

            $("#dataTable tbody tr").each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace("Kyats", "") * 1,
                    'order_code': 'POS' + $random
                });
            });

            console.log($orderList);


            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/order',
                data: Object.assign({},$orderList) ,
                dataType: 'json',
                success: function(response) {
                    if(response.status == "true") {
                        window.location.href = "http://localhost:8000/user/home";
                    }
                }
            })

        })

        $('#clearBtn').click(function(){

            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/cart',
                dataType: 'json',

            });


            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html("0 Kyats");
            $('#finalResult').html("3000 Kyats");



        })

          //remove current product

        $(".btnRemove").click(function() {
                $parentNote = $(this).parents("tr");
                $productId = $parentNote.find(".productId").val();
                $orderId = $parentNote.find(".orderId").val();

                $parentNote.remove();
                $totalPrice = 0;
                $("#dataTable tbody tr").each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
                });

                $("#subTotalPrice").html($totalPrice + "Kyats");
                $("#finalResult").text(($totalPrice + 3000) + " Kyats");

                $.ajax({
                type: 'get',
                url: '/user/ajax/clear/current/product',
                data: { 'productId' : $productId, 'orderId' : $orderId },
                dataType: 'json',
                })
            })
    </script>
@endsection
