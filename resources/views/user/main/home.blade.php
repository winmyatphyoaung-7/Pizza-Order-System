@extends('user.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        Categories</span></h5>
                <div class="bg-light  mb-30">
                    <form>
                        <div
                            class="bg-dark p-3 text-white custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="m-0" for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        <div class="px-4">
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 pt-1">

                                <a href="{{route('user#home')}}">
                                    <label class="text-dark" for="price-1">All Category</label>
                                </a>

                    </div>
                        </div>


                        <div class="px-4">
                            @foreach ($category as $c)
                                <div
                                    class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 pt-1">

                                    <a href="{{route('user#filter',$c->id)}}">
                                        <label class="text-dark" for="price-1">{{ $c->name }}</label>
                                    </a>

                                </div>
                            @endforeach
                        </div>

                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>


                                <a href="{{route('user#cartList')}}">
                                    <button type="button" class="btn btn-dark rounded position-relative">
                                        <i class="fa-solid fa-cart-shopping "></i>
                                        <span class="position-absolute px-2 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{count($cart)}}
                                        </span>
                                    </button>
                                </a>

                                <a href="{{route('user#history')}}" class="ms-3">
                                    <button type="button" class="btn btn-dark rounded position-relative">
                                        History <i class="fa-solid fa-clock-rotate-left "></i>
                                        <span class="position-absolute px-2 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{count($history)}}
                                        </span>
                                    </button>
                                </a>

                            </div>
                            <div class="ml-2">
                                <div class="btn-group">

                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Ascending</a>
                                        <a class="dropdown-item" href="#">descending</a>
                                    </div> --}}

                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Choose Sorting....</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">
                        @if(count($pizza) != 0)

                        @foreach ($pizza as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4 " id="myForm">
                                    <div class="product-img position-relative overflow-hidden" style="height: 250px;background-position:center;">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                            alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}}"><i
                                                    class="fa-brands fa-readme"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }} kyats</h5>
                                            {{-- <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @else

                        <p class="text-center shadow-sm  fs-1 col-6 offset-3 py-5">There is no Pizza. <i class="fa-solid fa-pizza-slice ms-3"></i></p>

                        @endif
                    </div>




                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $.ajax({
            //     type : 'get',
            //     url  : 'http://localhost:8000/user/ajax/pizza/list',
            //     dataType : 'json',
            //     success :function(response){
            //         console.log(response)
            //     }
            // })

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();

                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response[0].name)

                            $list = ``;

                            for ($i = 0; $i<response.length; $i++) {

                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4 " id="myForm">
                                      <div class="product-img position-relative overflow-hidden" style="height: 180px">
                                         <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                         <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-brands fa-readme"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>

                                </div>
                            </div>
                          </div>
                                `;
                            }

                            $('#dataList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            "status": 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = ``;

                            for ($i = 0; $i < response.length; $i++) {

                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4 " id="myForm">
                                      <div class="product-img position-relative overflow-hidden" style="height: 180px">
                                         <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                         <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa-brands fa-readme"></i></a>

                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>

                                </div>
                            </div>
                        </div>
                                `;
                            }

                            $('#dataList').html($list);
                        }
                    })
                }
            })
        });
    </script>
@endsection
