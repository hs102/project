<!-- passwordModal code -->

<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            </div>

            <div class="modal-body">
                <div class="mb-3 d-flex justify-content-center">
                    <form method="POST" name="updateForm" class="my-1 w-md-50"  action= "components/userUpdate.php" >
                        <label for="password" class="form-label">Enter New Password</label>
                        <input required type="password" class="custom-input" id="password" name="password" placeholder="Minimum 8 characters">
                        <button name="submitPassword" class="mt-3 custom-btn mb-0">Update Password</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







<style>
    #passwordModal .modal-content {
    border-radius: 10px;
}

/* Modal Header */
#passwordModal .modal-header {
    background: linear-gradient(135deg, #004aad, #cb6ce6);
    color: #fff;
    border-bottom: 2px solid #dee2e6;
    border-radius: 10px 10px 0 0;
    text-align: center; 
}

/* Modal Title */
#passwordModal .modal-title {
    font-weight: bold; 
    margin: 10px;
}


/* Modal Body */
#passwordModal .modal-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Form Label */
#passwordModal .form-label {
    font-weight: bold;
}

/* Form Input */
#passwordModal .custom-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

/* Submit Button */
#passwordModal .custom-btn {
    background: linear-gradient(135deg, #004aad, #cb6ce6);
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect on the button */
#passwordModal .custom-btn:hover {
    background-color: #0056b3;
}
</style>
