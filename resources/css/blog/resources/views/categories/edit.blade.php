{{-- Edit Category Modal --}}
<div class="modal fade" id="category-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Category</h4>
            </div>
            @include('flash_message')
            <div class="modal-body">
                <form role="form" action="{{ route('category.update') }}" method="POST">
                    <input type="hidden" id="category_id" name="category_id">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="category_edit">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="category_edit" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
