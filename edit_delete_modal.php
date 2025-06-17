<!-- Edit Modal -->
<div class="modal fade" id="edit_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel_<?php echo $row['ID']; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="edit.php">
                <div class="modal-header">
                    <h4 class="modal-title" id="editLabel_<?php echo $row['ID']; ?>">Edit Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                    
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstName" class="form-control" value="<?php echo $row['firstName']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastName" class="form-control" value="<?php echo $row['lastName']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $row['Address']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel_<?php echo $row['ID']; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="delete.php">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteLabel_<?php echo $row['ID']; ?>">Delete Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                    <p>Are you sure you want to delete this member?</p>
                    <h4 class="text-danger"><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="delete" class="btn btn-danger">Yes, Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
