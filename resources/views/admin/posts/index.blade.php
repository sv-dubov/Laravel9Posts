@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Posts</h1>
            <div class="mt-1 mb-4">
                <a class="btn btn-success" href="{{ route('posts.create') }}">{{ __('Add post') }}</a>
            </div>
            <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
                @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
                    </div>
                @endif
            </div>
            <div class="table-responsive-md">
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">
                            Id
                        </th>
                        <th scope="col">
                            Title
                        </th>
                        <th scope="col">
                            Category
                        </th>
                        <th scope="col">
                            Author
                        </th>
                        <th scope="col">
                            Show
                        </th>
                        <th scope="col">
                            Edit
                        </th>
                        <th scope="col">
                            Delete
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr class="text-center">
                            <th scope="row">
                                {{$post->id}}
                            </th>
                            <td class="text-start">
                                {{$post->title}}
                            </td>
                            <td>
                                {{$post->category->title}}
                            </td>
                            <td>
                                {{$post->user->name}}
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">Show</a>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                      onsubmit="return confirm('{{ trans('Are you sure?') }}');"
                                      style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
