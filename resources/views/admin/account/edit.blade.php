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
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Admin Profile</h3>
                                </div>

                                <hr>

                                <form action="{{route('admin#update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">

                                    @csrf
                                    <div class="row">

                                        <div class="col-5 offset-1">
                                            @if (Auth::user()->image == null)

                                                <img src="{{asset('image/defaultUser.jpg')}}" class="img-thumbnail shadow-sm w-75" alt="">

                                                @else


                                                    <img src="{{asset('storage/'.Auth::user()->image)}}" alt="">


                                            @endif

                                            <div class="mt-3">
                                                <input type="file" name="image" class="form-control @error('image') is-invalid  @enderror" id="">

                                                @error('image')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-5 ">
                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1 ">Name</label>
                                                <input id="cc-pament" name="name" value="{{old('name',Auth::user()->name)}}" type="text" class="form-control @error('name') is-invalid  @enderror" placeholder="Enter New Password">

                                                @error('name')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Email</label>

                                                <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email" value="{{old('email',Auth::user()->email)}}" id="" placeholder="Enter Admin Email">

                                                @error('email')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Phone</label>

                                                <input type="number" class="form-control @error('phone') is-invalid  @enderror" name="phone" value="{{old('phone',Auth::user()->phone)}}" id="" placeholder="Enter Admin Phone">

                                                @error('phone')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Gender</label>

                                                <select name="gender" class="form-control @error('gender') is-invalid  @enderror">
                                                    <option value="">ChooseGender</option>
                                                    <option value="male" @if (Auth::user()->gender == 'male') selected  @endif>Male</option>
                                                    <option value="female" @if (Auth::user()->gender == 'female') selected   @endif>Female</option>
                                                </select>

                                                @error('gender')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Address</label>

                                                <textarea name="address" class="form-control @error('address') is-invalid  @enderror" id="" cols="30" rows="10" placeholder="Enter Admin Address">{{old('address',Auth::user()->address)}}</textarea>

                                                @error('address')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Role</label>

                                                <input type="text" class="form-control @error('role') is-invalid  @enderror" name="role" id="" value="{{old('role',Auth::user()->role)}}" disabled>

                                                @error('role')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>




                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12  mt-3 d-flex justify-content-end">
                                            <button class="btn bg-dark text-white" type="submit">
                                                Update<i class="fa-solid fa-circle-right ms-2"></i>
                                            </button>
                                        </div>
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
