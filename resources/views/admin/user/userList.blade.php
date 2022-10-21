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
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>

                    </div>




                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <strong>Total - {{ count($users) }}</strong>
                            </div>


                        </div>
                    </div>





                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <div class="row">
                                    <tr>

                                        <th class="col-5">Image</th>
                                        <th>Name</th>
                                        <th class="">Email</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th class="col-5">Role</th>
                                        <th></th>

                                    </tr>
                                </div>
                            </thead>
                            <tbody id="dataList">

                                @foreach ($users as $u)
                                    <tr>

                                        <td class="">
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('image/defaultUser.jpg') }}" style="width:120px;"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @else
                                                    <img src="{{ asset('image/girl.jpg') }}" style="width:120px;"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}" style="width:120px;"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        </td>
                                        <input type="hidden" name="" id="userId" value="{{$u->id}}">
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td class="">
                                            <select name="role" class="form-control statusChange">
                                                <option value="user" @if ($u->role == 'user') selected  @endif>User</option>
                                                <option value="admin"@if ($u->role == 'admin') selected  @endif>Admin</option>

                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{route('admin#userDelete',$u->id)}}">
                                                <div class="text-white rounded-circle bg-danger d-flex justify-content-center         align-items-center" style="width:30px;height:30px;">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </div>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{$users->links()}}
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
        //change status

        $('.statusChange').change(function(){
            $currentRole = $(this).val();
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').val();

            $.ajax({
                type : 'get',
                url : '/user/change/role',
                data : {
                    'userId' : $userId,
                    'role' : $currentRole,
                },
                dataType : 'json',
            })

            location.reload();
        })
    })
</script>

@endsection
