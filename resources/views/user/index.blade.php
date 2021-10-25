<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            @if (isset($header))
                {{ $header }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">ưe
                <form action="{{ route('user.index') }}" method="get">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">user_id</span>
                                </div>
                                <input type="text" class="form-control" placeholder="user_id" name="user_id">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">phone</span>
                                </div>
                                <input type="text" class="form-control" placeholder="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">role_name</span>
                                </div>
                                <select name="role_name">
                                        <option value="">chọn</option>
                                    @foreach ($roles as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <input class="btn btn-secondary w-100" type="submit" value="Tìm kiếm">
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên user</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <th scope="row">{{ $item->name }}</th>
                                <th scope="row">{{ $item->phone->number }}</th>
                                <th scope="row">{{ $item->email }}</th>
                                <th scope="row" class="text-uppercase">{{ $item->roles->first()->name }}</th>
                                <th scope="row">{{ $item->created_at }}</th>
                                {{-- <th scope="row">
                                    <a href="{{ route('dashboard') }}/#post_{{ $item->id }}"><i class="fas fa-eye text-success"></i></a>
                                    <a href="{{ route('post.edit',['id' => $item->id]) }}"><i class="fas fa-edit text-warning"></i></a>
                                    <a href="#" class="btn-del" data-id={{ $item->id }}><i class="fas fa-trash-alt text-danger"></i></a>
                                </th> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-del").click(function (e) { 
            e.preventDefault();
            let ele = $(this);
            let id = $(this).data('id');
            if(id){
                $.ajax({
                    type: "post",
                    url: "{{ route('post.delete') }}",
                    data: {
                        id : id,
                    },
                    success : function (res) {
                        console.log(id,ele);
                        if(res.success){
                            ele.parent().parent().remove();
                            Swal.fire({
                                title: 'Thành công',
                                text: res.message,
                                icon: 'success',
                            })
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: res.message,
                                icon: 'error',
                            })
                        }
                    }
                });
            }
        });
    });
</script>

