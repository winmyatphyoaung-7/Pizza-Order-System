@extends('admin.layouts.master')

@section('title','Category List')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">

                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row d-flex align-items-center">
                                    <div class="col-2">
                                        <a href="{{route('category#list')}}">
                                            <div class="btn btn-dark text-white border-2 px-2"><i class="fa-solid fa-arrow-left-long me-2"></i>Back</div>
                                        </a>
                                    </div>
                                    <div class="col-6 offset-3">
                                        <h3 class="title-2">Account Info</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        @if(session('updateSuccess'))

                                            <div class="col-6 offset-6 alert alert-warning alert-dismissible fade show" role="alert">
                                               <strong><i class="fa-solid fa-trash-check"></i></strong> {{session('updateSuccess')}}
                                               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>

                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3 offset-2">
                                        @if (Auth::user()->image == null)

                                            <img src="{{asset('image/defaultUser.jpg')}}" class="img-thumbnail shadow-sm" alt="">

                                            @else

                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">

                                        @endif
                                    </div>
                                    <div class="col-5 offset-1">
                                        <h4 class="my-2 mb-4"><i class="fa-solid fa-user-pen me-2"></i>{{Auth::user()->name}}</h4>
                                        <h4 class="my-2 mb-4"><i class="fa-solid fa-envelope me-2"></i>{{Auth::user()->email}}</h4>
                                        <h4 class="my-2 mb-4"><i class="fa-solid fa-phone me-2"></i>{{Auth::user()->phone}}</h4>
                                        <h4 class="my-2 mb-4"><i class="fa-solid fa-venus-mars me-2"></i>{{Auth::user()->gender}}</h4>
                                        <h4 class="my-2 mb-4"><i class="fa-solid fa-map-location-dot me-2"></i>{{Auth::user()->address}}</h4>
                                        <h4 class="my-2 mb-4"><i class="fa-regular fa-calendar-check me-2"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>


                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12  mt-3 d-flex justify-content-end">
                                        <button class="btn bg-dark text-white">
                                            <a href="{{route('admin#edit')}}" class="text-white">
                                                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                            </a>
                                        </button>
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
