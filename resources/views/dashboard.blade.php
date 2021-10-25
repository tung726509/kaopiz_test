<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .avatar {
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 7px;
        }
        .avatar-comment {
            vertical-align: middle;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 7px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mb-2" id="post_{{ $post->id }}">
                        <div class="row mb-6">
                            <div class="col-12" style="border-bottom: 1px solid #9f9090;">
                                <div class="p-2">
                                    <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar">
                                    Tác giả : {{ $post->user->name }} - <span style="color:#afa4a4">Ngày đăng : {{ $post->created_at }}</span>
                                </div>
                            </div>
                            <div class="col-12" style="padding: 40px">
                                <div class="h2 text-center pt-2">{{ $post->title }}</div>
                                <div class="row">
                                    <div class="col-12">
                                        {!! $post->content !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" style="border-top: 1px solid #b2b6bb;border-bottom:1px solid #b2b6bb;">
                                <div class="row py-2">
                                    <div class="col-6 text-center" style="border-right: 1px solid #b2b6bb;">
                                        <i class="far fa-thumbs-up btn-unlike"></i>
                                        <i class="fas fa-thumbs-up btn-like d-none" style="color:#3c92dd"></i>
                                    </div>
                                    <div class="col-6 text-center">
                                        <i class="far fa-comment btn-comment" data-post-id="{{ $post->id }}"></i>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12">
                                <div class="container block-comment-{{ $post->id }}">
                                    @forelse ($post->comments as $item)
                                        <div class="row row_comment_{{ $item->id }}">
                                            <div class="p-2">
                                                <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar-comment">
                                                {{ $post->user->name }} : {{ $item->content_comment }}
                                                <span style="color:#afa4a4"> - 1 phút trước</span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="h5 mt-2 text-have-not-cmt-post-{{ $post->id }}">Hãy là người bình luận đầu tiên về bài viết này!</div>
                                    @endforelse
                                    <div class="row mt-2">
                                        <div class="col-11 p-1">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control input-mess-{{ $post->id }}" value="" placeholder="bình luận gì đó ...">
                                            </div>
                                        </div>
                                        <div class="col-1 p-1 text-center" style="margin: auto">
                                            <div class="btn btn-sm btn-primary w-100 btn-send-cmt" data-post-id="{{ $post->id }}">
                                                <i class="far fa-paper-plane"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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

        $(".btn-like").click(function (e) { 
            e.preventDefault();
            $(this).addClass('d-none');
            $(this).prev().removeClass('d-none');
        });

        $(".btn-unlike").click(function (e) { 
            e.preventDefault();
            $(this).addClass('d-none');
            $(this).next().removeClass('d-none');
        });

        $(".btn-send-cmt").click(function (e) { 
            e.preventDefault();
            let ele = $(this);
            let post_id = $(this).data('post-id');
            let message = $(`.input-mess-${post_id}`).val();
            let user_name = '{{ Auth::user()->name }}';

            @if(Auth::check())
                if(message){
                    $.ajax({
                        type: "post",
                        url: "{{ route('comment.add') }}",
                        data: {
                            post_id : post_id,
                            message : message,
                        },
                        success : function (res) {
                            if(res.success){
                                $(".text-have-not-cmt-post-"+post_id).remove();
                                $('.input-mess-'+post_id).val('');
                                $(`.block-comment-${post_id}`).prepend(`
                                    <div class="row row_comment_${res.comment_id}">
                                        <div class="p-2">
                                            <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="avatar-comment">
                                            ${user_name} : ${message}
                                            <span style="color:#afa4a4"> - 1 phút trước</span>
                                        </div>
                                    </div>
                                `);
                            }else{
                                Swal.fire({
                                    title: 'Error!',
                                    text: res.message,
                                    icon: 'error',
                                })
                            }
                        }
                    });
                }else{
                    $('.input-mess-'+post_id).focus();
                }
            @else
                Swal.fire({
                    title: 'Error!',
                    text: 'Cần đăng nhập để bình luận về bài viết!',
                    icon: 'error',
                })
            @endif
        });
    });
</script>
