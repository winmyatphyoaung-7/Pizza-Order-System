@extends('admin.layouts.master')

@section('title','Category List')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">

                    <div class="col-lg-6 offset-3">
                        <div class="card">

                            <div class="card-header">
                                <div class="row d-flex align-items-center">
                                    <div class="col-1">
                                        <a href="{{route('category#list')}}">
                                            <div class="btn btn-dark text-white border-2 px-2"><i class="fa-solid fa-arrow-left-long me-2"></i>Back</div>
                                        </a>
                                    </div>
                                    <div class="col-7 offset-2">
                                        <h3 class="title-2">Change Password</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">


                                @if(session('changeSuccess'))

                                  <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                                       <strong><i class="fa-solid fa-trash-check"></i></strong> Password Changed Success
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>

                                @endif

                                <hr>
                                <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">

                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror @if (session('notMatch')) is-invalid @endif" aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">

                                        @error('oldPassword')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror

                                        @if (session('notMatch'))
                                        <small class="invalid-feedback">{{session('notMatch')}}</small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false"  placeholder="Enter New Password">

                                        @error('newPassword')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Confirm New Password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm New Password...">

                                        @error('confirmPassword')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Change Password</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
