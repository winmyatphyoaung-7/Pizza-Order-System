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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right ">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>ADD Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <strong>Total - {{ $pizza->total() }}</strong>
                            </div>

                            <div class="">
                                <form class="form-header" action="{{ route('product#list') }}" method="get">
                                    @csrf

                                    <input class="au-input au-input--xl" type="text" name="key"
                                        value="{{ request('key') }}" placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            @if (session('deleteSuccess'))
                                <div class="col-4 offset-8 alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="fa-solid fa-check"></i></strong> {{session('deleteSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('createSuccess'))
                            <div class="col-4 offset-8 alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i></strong> {{session('createSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        </div>
                    </div>

                    @if (count($pizza) != 0)

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>

                                        <th class="col-2">Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pizza as $p)
                                        <tr class="tr-shadow">

                                            <td>
                                                <div class="" style="width:120px;height:90px;overflow:hidden;background-position:center;background-attachment:fixed;">
                                                    <img src="{{ asset('storage/' . $p->image) }}"  class=" shadow-sm rounded" alt="">
                                                </div>

                                            </td>


                                            <td>
                                                {{ $p->name }}
                                            </td>

                                            <td>
                                                {{ $p->price }}
                                            </td>

                                            <td>
                                                {{ $p->categories_name }}
                                            </td>

                                            <td>
                                                <i class="fa-solid fa-eye me-1"></i>{{ $p->view_count }}
                                            </td>

                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{route('product#updatePage',$p->id)}}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('product#edit',$p->id)}}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye me-2"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id ) }}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $pizza->links() }}
                            </div>
                        </div>
                    @else
                        <h1 class="text-center my-5">There is no Product List.</h1>

                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection
