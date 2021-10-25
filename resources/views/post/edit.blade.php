<x-app-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            @if (isset($header))
                {{ $header }}
            @endif
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('post.edit',['id'=>$post->id]) }}" method="post">
                    @csrf
                    <div class="row px-2 py-6">
                        <div class="col-12">
                            @if(session('fail') || $errors->any())
                                <div class="alert alert-danger bg-danger alert-dismissible border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong style="position: relative;padding-left: 35px;">
                                        <i class="fas fa-dizzy" style="font-size: 30px;position: absolute;left: 0;top: -7px;"></i>
                                    </strong>
                                    {!! $errors->any() ? 'Vui lòng thử lại sau !' : session('fail') !!}
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success bg-success alert-dismissible border-0 fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong style="position: relative;padding-left: 35px;"><i class="fas fa-laugh-beam" style="font-size: 30px;position: absolute;left: 0;top: -7px;"></i></strong> 
                                    {!! session('success') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <h4>Tác giả : {{ $post->user->name }}</h4>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Tên bài viết</span>
                                </div>
                                <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" name="title" value="{{ $post->title }}">
                            </div>
                        </div>
                        <div class="col-6">
                        </div>
                        <div class="col-12 py-2">
                            <textarea name="content" id="editor">{{ $post->content }}</textarea>
                        </div>
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mt-6">
                            <input type="submit" class="btn btn-success" value="Cập nhật">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

