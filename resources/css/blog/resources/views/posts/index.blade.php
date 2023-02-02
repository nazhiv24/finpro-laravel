@extends('layouts.master')

@section('header', 'Post Dashboard')

@section('breadcrumb', 'Post')

@section('content')

<div class="box">
    @include('flash_message')
    <div class="box-header">
        <a href="{{ route('post.create') }}" class="btn btn-primary">
            Add Post
        </a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th >SR.No</th>
                                <th >Category Name</th>
                                <th >Title</th>
                                <th >Description</th>
                                <th >Image</th>
                                <th >Status</th>
                                <th >Created At</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                            <tr role="row" class="odd">
                                <td class="sorting_1">#{{ $post->id }}</td>
                                <td>{{ $post->category_name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <textarea cols="40" rows="8" readonly>
                                        {{ $post->description }}</td>
                                    </textarea>
                                </td>
                                <td>
                                    @if($post->image)
                                        <img src="{{ asset('storage/'.$post->image) }}" width="50px" height="50px">
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    @if($post->status == 1)
                                        <span class="label label-success">Active</span>
                                    @elseif($post->status == 0)
                                        <span class="label label-danger">Block</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger">Del</a>
                                    </div>
                                </td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@endsection
