<?php
require_once('includes/functions.php');
auth_login();
include('includes/header.php');
include('includes/sidebar.php');
?>

<!-- Page Content -->
<div class="main-content">
    <div class="main-content-header">
        <h5> <i class="fa fa-list ml-2"></i> View Users / Providers</h5>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this user?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" id="confirm-del-user-btn" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3 mb-4">
                    <div class="card-header">
                        <h6>View Users</h6>
                    </div>
                    <div class="card-body">
                        <div id="table" class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
    <?php include('includes/footer.php');?>