<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="updatemodal" aria-hidden="true">
    <form action="" method="post" id="category_form">
        @csrf
        <input type="hidden" name="id" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatemodal">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Category name" name="name"
                            id="up_name">
                        <span id="nameError" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="up_status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                        <span id="statusError" class="text-danger"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_category">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
