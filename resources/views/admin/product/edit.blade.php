@extends('admin.layouts.master')

@section('title', 'Category List')


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">

                        <div class="col-lg-11 offset-1">
                            <div class="card">

                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-4 btn bg-dark">
                                            <a href="{{ route('product#list') }}" class="text-white">
                                                <i class="fa-solid fa-arrow-left me-1" onclick="history.back()"></i>Back
                                            </a>
                                        </div>
                                        <div class="col-4 offset-3">
                                            <span class="title-2">Pizza Info</span>
                                        </div>
                                    </div>

                                </div>


                                <div class="card-body">




                                    <hr>

                                    <div class="row">
                                        <div class="col-12">
                                            @if (session('updateSuccess'))
                                                <div class="col-6 offset-6 alert alert-warning alert-dismissible fade show"
                                                    role="alert">
                                                    <strong><i class="fa-solid fa-trash-check"></i></strong>
                                                    {{ session('updateSuccess') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4  d-flex align-items-center">

                                                <img src="{{ asset('storage/' . $pizza->image) }}"
                                                    class="img-thumbnail shadow-sm w-75" alt="">




                                            </div>
                                            <div class="col-7 ">
                                                <div class="mb-2">
                                                    <span
                                                        class="my-2 btn-lg btn-danger text-white px-5 mb-4 ">{{ $pizza->name }}
                                                    </span>
                                                </div>
                                                <span class="my-2 btn bg-dark text-white-50 mb-4"><i
                                                        class="fa-solid fa-sack-dollar me-2"></i>{{ $pizza->price }}
                                                </span>
                                                <span class="my-2 btn bg-dark text-white-50 mb-4"><i
                                                        class="fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }}min
                                                </span>
                                                <span class="my-2 btn bg-dark text-white-50 mb-4"><i
                                                        class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}
                                                </span>

                                                <span class="my-2 btn bg-dark text-white-50 mb-4"><i
                                                    class="fa-regular fa-calendar-check me-2"></i>{{ $pizza->categories_name }}
                                                </span>

                                                <span class="my-2 btn bg-dark text-white-50 mb-4"><i
                                                        class="fa-regular fa-calendar-check me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}
                                                </span>

                                                <div class="my-2 mb-4"><i
                                                        class="fa-solid fa-book-open me-2"></i>{{ $pizza->description }}
                                                </div>


                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
