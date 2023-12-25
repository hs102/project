<!-- editUserModal.php -->

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            
            </div>
            <div class="modal-body">
                <form method="POST" name="editUserForm" class="mt-2" action="components/userUpdate.php">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input value="<?php echo $curr_fname ?>" required type="text" class="custom-input" id="editFirstName" name="editFirstName" placeholder="Enter your first name">
                    </div>


                    <button name="submitEditUser" class="custom-btn mt-4">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Edit User Modal Styles */

    /* Modal Content */
    #editUserModal .modal-content {
        border-radius: 10px;
    }

    /* Modal Header */
    #editUserModal .modal-header {
        background: linear-gradient(135deg, #004aad, #cb6ce6);
    color: #fff;
    border-bottom: 2px solid #dee2e6;
    border-radius: 10px 10px 0 0;
    text-align: center; 
    }

    /* Modal Title */
    #editUserModal .modal-title {
    font-weight: bold; 
    margin: 10px;
    }

    

    /* Modal Body */
    #editUserModal .modal-body {
        padding: 20px;
    }

    /* Form Label */
    #editUserModal .form-label {
        font-weight: bold;
    }

    /* Form Input */
    #editUserModal .custom-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    /* Submit Button */
    #editUserModal .custom-btn {
        background: linear-gradient(135deg, #004aad, #cb6ce6);
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Hover effect on the button */
    #editUserModal .custom-btn:hover {
        background-color: #0056b3;
    }
</style>
