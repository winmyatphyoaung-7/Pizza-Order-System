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
                                <h2 class="title-1">Contact Lists</h2>

                            </div>
                        </div>

                    </div>




                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <strong>Total - {{ count($contactList) }}</strong>
                            </div>


                        </div>
                    </div>





                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Message</th>

                                </tr>
                            </thead>
                            <tbody id="contactTableList">

                                @foreach ($contactList as $cl)
                                <tr>

                                    <td>{{$cl->name}}</td>
                                    <td>{{$cl->email}}</td>
                                    <td>{{$cl->phone}}</td>
                                    <td>{{$cl->address}}</td>
                                    <td>{{$cl->message}}</td>

                                </tr>



                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{$contactList->links()}}
                        </div>


                    </div>



                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

