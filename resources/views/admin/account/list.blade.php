@extends('admin.layouts.master')

@section('title', 'Category List')


@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <strong>Total - {{count($admin)}}</strong>
                            </div>


                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">

                                        <td>
                                            @if ($a->image == null)

                                            @if($a->gender == 'male')

                                            <img src="{{asset('image/defaultUser.jpg')}}" style="width:120px;"
                                            class="img-thumbnail shadow-sm" alt="">

                                            @else

                                            <img src="{{asset('image/girl.jpg')}}" style="width:120px;"
                                            class="img-thumbnail shadow-sm" alt="">

                                            @endif

                                            @else

                                            <img src="{{asset('storage/'.$a->image)}}" style="width:120px;"
                                            class="img-thumbnail shadow-sm" alt="">

                                            @endif
                                        </td>
                                        <input type="hidden" class="adminId" value="{{$a->id}}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>
                                            <select name="role" class="form-control changeRole">
                                                <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                                <option value="user"  @if ($a->role == 'user') selected @endif>User</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{route("admin#delete",$a->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>


                                              </a>
                                            </div>
                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{$admin->links()}}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptSection')

<script>
    $(document).ready(function(){
        $('.changeRole').change(function(){
            $currentRole = $(this).val();
            $parentTd = $(this).parents("tr");
            $adminId = $parentTd.find('.adminId').val();
            console.log($adminId);

            $.ajax({
                'type' : 'get',
                'url'  : '/admin/ajax/change/role',
                'data' : {
                    'role' : $currentRole,
                    'id'   : $adminId,
                },
                'dataType' : 'json',
            })

            location.reload();

        })
    })
</script>

@endsection
