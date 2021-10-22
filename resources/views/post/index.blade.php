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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên bài</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $item)
                            <tr>
                                <th scope="row">{{ $item->title }}</th>
                                <th scope="row">{{ $item->user->name }}</th>
                                <th scope="row">{{ $item->created_at }}</th>
                                <th scope="row">
                                    <a href="{{ route('dashboard') }}/#post_{{ $item->id }}"><i class="fas fa-eye text-success"></i></a>
                                    <a href="{{ route('post.edit',['id' => $item->id]) }}"><i class="fas fa-edit text-warning"></i></a>
                                    <a href="#" class="btn-del" data-id={{ $item->id }}><i class="fas fa-trash-alt text-danger"></i></a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="btn btn-success float-left m-2"><a href="{{ route('post.add') }}" class="text-white">Thêm mới</a></div>
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

