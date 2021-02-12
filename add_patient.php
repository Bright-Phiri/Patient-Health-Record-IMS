<?php
require_once('includes/functions.php');
auth_login();
include('includes/header.php');
include('includes/sidebar.php');
?>

<!-- Page Content-->
<div class="main-content">
    <div class="main-content-header">
        <h5> <i class="fa fa-user-plus ml-2"></i> Create Patient</h5>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3 mb-4">
                    <div class="card-header">
                        <h6>Enter Patient Details</h6>
                    </div>
                    <div class="card-body">

                        <form action="">
                            <div class="form-group row">
                                <div class="form-group col-5">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" class="form-control" placeholder="First Name">
                                </div>
                                <div class="form-group col-5">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" id="lastname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-5">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label for="birthdate">Date Of Birth</label>
                                    <input type="date" class="form-control" id="birthdate">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-5">
                                    <label for="district">District</label>

                                    <input type="text" id="district" class="form-control" placeholder="District">
                                </div>
                                <div class="form-group col-5">
                                    <label for="village">Village</label>
                                    <input type="text" id="village" class="form-control" placeholder="Home Village">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-5">
                                    <label for="district">Occupation</label>
                                    <select class="form-control" id="occupation">
                                        <option value="Accountant">Accountant</option>
                                        <option value="Software Developer">Software Developer</option>
                                        <option value="Business Owner">Business Owner</option>
                                        <option value="Mechanic">Mechanic</option>
                                        <option value="Driver">Driver</option>
                                        <option value="Welder">Welder</option>
                                        <option value="Construction worker">Construction worker</option>
                                        <option value="Painter">Painter</option>
                                        <option value="Radiologist">Radiologist</option>
                                        <option value="Student">Student</option>
                                        <option value="Farmer">Farmer</option>
                                        <option value="Coal miner">Coal miner</option>
                                        <option value="Coal miner">Other</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer ">
                        <button class="btn btn-secondary " id="cancel-add-user-btn">Cancel</button>
                        <button class="btn btn-primary" id="add-user-btn">Add Patient</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Content-->
    <?php include('includes/footer.php');?>