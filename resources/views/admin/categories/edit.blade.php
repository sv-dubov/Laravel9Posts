@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="h4">Edit category</h1>
            <div class="mt-1 mb-4">
                <a class="btn btn-success" href="{{ route('categories.index') }}">{{ __('Categories list') }}</a>
            </div>
            <form method="POST" action="{{ route('categories.update', [ $category->id ]) }}">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{$category->title}}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection
