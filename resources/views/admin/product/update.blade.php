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
                                        <a href="{{route('product#list')}}">
                                            <div class="btn btn-dark text-white border-2 px-2"><i class="fa-solid fa-arrow-left-long me-2"></i>Back</div>
                                        </a>
                                    </div>
                                    <div class="col-6 offset-3">
                                        <h3 class="title-2">Pizza Update</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">


                                <hr>

                                <form action="{{route('product#update')}}" method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                    <div class="row">

                                        <div class="col-5 offset-1">

                                                <img src="{{asset('storage/'.$pizza->image)}}"  class="img-thumbnail shadow-sm w-75" alt="">


                                            <div class="mt-3">
                                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid  @enderror" id="">

                                                @error('pizzaImage')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-5 ">
                                            <div class="form-group">
                                                <label for="pizzaName" class="control-label mb-1 ">Name</label>
                                                <input id="cc-pament" name="pizzaName" value="{{old('pizzaName',$pizza->name)}}" type="text" class="form-control @error('pizzaName') is-invalid  @enderror" placeholder="Enter Name...">

                                                @error('pizzaName')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Description</label>

                                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid  @enderror" id="" cols="30" rows="10" value="{{old('pizzaDescription')}}">{{$pizza->description}}</textarea>

                                                @error('pizzaDescription')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror

                                            </div>


                                            <div class="form-group">
                                                <label for="categoryName" class="control-label mb-1">Category</label>

                                                <select name="pizzaCategory" class="form-control @error('gender') is-invalid  @enderror">
                                                    <option value="">Choose your Category</option>

                                                    @foreach ($category as $c )
                                                      <option value="{{$c->id}}" @if ($pizza->categories_id == $c->id)  selected    @endif>{{$c->name}}</option>
                                                    @endforeach
                                                </select>

                                                @error('gender')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pizzaName" class="control-label mb-1 ">Price</label>
                                                <input id="cc-pament" name="pizzaPrice" value="{{old('pizzaPrice',$pizza->price)}}" type="number" class="form-control @error('pizzaPrice') is-invalid  @enderror" placeholder="Enter price...">

                                                @error('pizzaPrice')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pizzaName" class="control-label mb-1 ">Waiting Time</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}" type="number" class="form-control @error('pizzaWaitingTime') is-invalid  @enderror" placeholder="Enter Name...">

                                                @error('pizzaWaitingTime')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pizzaName" class="control-label mb-1 ">ViewCount</label>
                                                <input id="cc-pament" name="viewCount" value="{{old('viewCount',$pizza->view_count)}}"  class="form-control " placeholder="Enter View Count..." disabled>

                                                @error('viewCount')
                                                <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="pizzaName" class="control-label mb-1 ">Created at</label>
                                                <input id="cc-pament" name="createdAt" value="{{old('createdAt',$pizza->created_at->format('j-F-Y'))}}" type="text" class="form-control " placeholder="" disabled>

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
