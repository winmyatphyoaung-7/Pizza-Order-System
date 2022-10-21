@extends('admin.layouts.master')

@section('title','Category List')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{route('product#list')}}">
                                <button class="btn bg-dark text-white my-3">List</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Create Your Pizza</h3>
                                </div>
                                <hr>
                                <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">

                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('pizzaName')}}" placeholder="Enter pizza name...">

                                        @error('pizzaName')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" id="">
                                            <option value="">Choose your category</option>
                                            @foreach ($categories as $c )

                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('pizzaCategory')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter description...">{{old('pizzaDescription')}}</textarea>

                                        @error('pizzaDescription')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Image</label>
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror"">
                                        @error('pizzaImage')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Waiting Time</label>
                                        <input type="number" name="pizzaWaitingTime" class="form-control @error('pizzaWaitingTime') is-invalid @enderror"" value="{{old('pizzaWaitingTime')}}" placeholder="Enter waiting time...">
                                        @error('pizzaWaitingTime')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryName" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{old('pizzaPrice')}}" placeholder="Enter pizza price...">

                                        @error('pizzaPrice')
                                        <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Create</span>
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
