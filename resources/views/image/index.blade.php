// index
@extends('layouts.app')

@section('title', 'Images')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('Image', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_posts')
                <a href="{{ route('images.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Create</a>
            @endcan
        </div>
    </div>

    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>URL</th>
                <th>Tags</th>
                <th>Created At</th>
                @can('edit_images', 'delete_images')
                    <th class="text-center">Actions</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->tags }}</td>
                    <td>{{ $item->created_at->toFormattedDateString() }}</td>
                    @can('edit_images', 'delete_images')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'images',
                            'id' => $item->id
                        ])
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-center">
            {{ $result->links() }}
        </div>
    </div>

@endsection