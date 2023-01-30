@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="mt-1 mb-4">
                <a class="btn btn-success" href="{{ route('posts.index') }}">{{ __('Posts list') }}</a>
            </div>
            <h1>{{$post->title}}</h1>
            <p class="fs-13 text-muted">{{$post->category->title}}</p>
            <div class="img-thumbnail">
                <img src="{{$post->getImage()}}" alt="" class="img-fluid mt-4 mb-4"/>
                {{--<img src="{{ asset('storage/uploads/posts/'. $post->image)}}" alt="{{$post->title}}"/>--}}
            </div>
            <div class="mt-1 mb-4">
                {!!$post->content!!}
            </div>
            <p class="fs-13 text-muted">{{$post->created_at->format('d M Y H:i')}}</p>
            <div class="mt-1 mb-4">
                {{$post->user->name}}
            </div>
        </div>
    </div>
@endsection
