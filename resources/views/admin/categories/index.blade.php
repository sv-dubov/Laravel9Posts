@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Categories</h1>
            <div class="mt-1 mb-4">
                <a class="btn btn-success" href="{{ route('categories.create') }}">{{ __('Add category') }}</a>
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
                            Created at
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
                    @foreach ($categories as $category)
                        <tr class="text-center">
                            <th scope="row">
                                {{$category->id}}
                            </th>
                            <td class="text-start">
                                {{$category->title}}
                            </td>
                            <td>
                                {{$category->created_at->format('d M Y H:i')}}
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
