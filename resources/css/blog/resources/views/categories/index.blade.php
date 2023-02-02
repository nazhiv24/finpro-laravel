@extends('layouts.master')

@section('header', 'Category Dashboard')

@section('breadcrumb', 'Category')

@section('content')

<div class="box">
    @include('flash_message')
    <div class="box-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#category-add">
            Add Category
        </button>
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
                                <th >Status</th>
                                <th >Created At</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr role="row" class="odd">
                                <td class="sorting_1">#{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    @if($category->status == true)
                                        <span class="label label-success">Active</span>
                                    @elseif($category->status == false)
                                        <span class="label label-danger">Block</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" onclick="editCategory({{ $category->id }})">Edit</button>
                                        <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger">Del</a>
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



{{-- Create Category Modal --}}
<div class="modal fade" id="category-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Category</h4>
            </div>
            @include('flash_message')
            <div class="modal-body">
                <form role="form" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputCategory">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="inputCategory" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- End create category modal --}}

{{--Edit Modal--}}
@include('categories.edit')

@endsection

@push('extra_script')

<script type="text/javascript">
    @if (count($errors) > 0)
        $('#category-add').modal('show');
    @endif
</script>

{{-- For Edit category --}}
<script>
    function editCategory(id){
        var category_id = id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'{{ route("category.update") }}',
            data:{
                id:category_id
            },
            success:function(data) {
                $("#category_id").val(data.id);
                $("#category_edit").val(data.category_name);
                $("#status").val(data.status);
                $('#category-edit').modal('show');
            }
        });
    }
</script>

@endpush
