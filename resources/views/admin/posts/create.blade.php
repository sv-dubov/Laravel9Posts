@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="h4">Create post</h1>
            <div class="mt-1 mb-4">
                <a class="btn btn-success" href="{{ route('posts.index') }}">{{ __('Posts list') }}</a>
            </div>
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" cols="30" rows="5">{{old('content')}}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select form-control @error('content') is-invalid @enderror" name="category_id" id="category_id">
                        <option>Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
