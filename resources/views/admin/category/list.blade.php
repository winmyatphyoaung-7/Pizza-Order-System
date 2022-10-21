@extends('admin.layouts.master')

@section('title','Category List')


@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>ADD CATEGORY
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                @if(session('categorySuccess'))

                <div class="col-4 offset-8 alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-check"></i></strong> Category Created!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                @endif

                @if(session('deleteSuccess'))

                <div class="col-4 offset-8 alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-trash-check"></i></strong> Category Deleted!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>

                @endif
                @if (count($category) == 0)
                    <h1 class="text-secondary text-center">There is no category here!</h1>


                @else

                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <strong>Total - {{$category->total()}}</strong>
                        </div>

                        <div class="">
                            <form class="form-header" action="{{route('category#list')}}" method="get">
                                @csrf

                                <input class="au-input au-input--xl" type="text" name="key" value="{{request('key')}}" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="col-5">CATEGORY NAME</th>
                                <th>CREATED DATE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($category as $item)

                           <tr class="tr-shadow">
                            <td>{{$item->id}}</td>
                            <td>
                                <span class="block-email">{{$item->name}}</span>
                            </td>

                            <td>{{$item->created_at->format('j-F-Y')}}</td>
                            <td>
                                <div class="table-data-feature">
                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="zmdi zmdi-mail-send"></i>
                                    </button> --}}
                                    <a href="{{route('category#edit',$item->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('category#delete',$item->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                        <i class="zmdi zmdi-more"></i>
                                    </button> --}}
                                </div>
                            </td>

                        </tr>

                           @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{$category->appends(request()->query())->links()}}
                    </div>
                </div>

                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection
