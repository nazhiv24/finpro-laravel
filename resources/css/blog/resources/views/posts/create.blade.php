@extends('layouts.master')

@section('header', 'Create Post')

@section('breadcrumb', 'Create')

@section('content')


<div class="col-md-12">
    @include('flash_message')
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ route('post.index') }}" class="btn btn-primary pull-right">
                Back
            </a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="post">Category</label>
                    <select class="form-control" name="category_id">
                        <option value="" selected>Select Category</option>
                        @forelse(cache()->get('categories') as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="post">Title</label>
                    <input type="text" class="form-control" name="title" id="post" placeholder="Enter Post Title">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" cols="40" rows="10" name="description" id="description">
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="post">Status</label>
                    <select class="form-control" name="status">
                        <option value="1" selected>Active</option>
                        <option value="0">Block</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.box -->
</div>
@endsection
