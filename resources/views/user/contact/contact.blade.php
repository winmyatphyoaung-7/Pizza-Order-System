@extends('user.layout.master')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col ">




                <div class="card shadow-sm rounded p-3">

                    <div class="mb-2">
                        <h1 class="text-center">Contact Us</h1>
                    </div>
                    <form action="{{ route('user#contact') }}" method="POST">
                        @csrf

                        <div class="row">
                            @if (session('sendSuccess'))
                            <div class="col-6 offset-6 alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check me-2"></i></strong> {{session('sendSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-5 offset-1">
                                <label for="a">Name</label>
                                <input type="text" name="contactName" id="a"
                                    class="form-control @error('contactName') is-invalid @enderror"
                                    placeholder="Enter your Name..." value="{{old('contactName')}}">

                                @error('contactName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-5 offset-1">
                                <label for="b">Email</label>
                                <input type="email" name="contactEmail" id="b" class="form-control @error('contactEmail') is-invalid @enderror" placeholder="Enter your email..." value="{{old('contactEmail')}}">

                                @error('contactEmail')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5 offset-1">
                                <label for="d">Phone Number</label>
                                <input type="text" name="contactNumber" id="d" class="form-control @error('contactNumber') is-invalid @enderror" placeholder="Enter your Number..." value="{{old('contactNumber')}}">

                                @error('contactNumber')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-5 offset-1">
                                <label for="e">Address</label>
                                <input type="text" name="contactAddress" id="e" class="form-control @error('contactAddress') is-invalid @enderror"  placeholder="Enter your Address..." value="{{old('contactAddress')}}">

                                @error('contactAddress')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="offset-1 col-11">
                                <label for="c">Message</label>
                                <textarea name="contactMessage" id="c" class="form-control @error('contactMessage') is-invalid @enderror" cols="30" rows="10" placeholder="Enter your Message...">{{old('contactMessage')}}</textarea>

                                @error('contactMessage')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 offset-9">
                                <button type="submit" class="w-100 btn btn-lg btn-dark rounded text-white">Send Message</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
