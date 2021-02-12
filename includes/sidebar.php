<!-- Sidebar-->
<div class="sidebar">
    <div class="sidebar-header d-flex">
        <img src="images/patient_diagnosis.png" alt="" width="40px">
        <h5>Health Care MIS</h5>
    </div>
    <hr>
    <ul>
        <li><a class="active" href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="add_patient.php"><i class="fa fa-user-plus"></i> Create patient</a></li>
        <li><a href="view_users.php"><i class="fa fa-list"></i> View users / providers</a></li>
        <li><a href="view_patients.php"><i class="fa fa-list"></i> View patients</a></li>
        <li><a data-toggle="modal" data-target="#logoutModal" href="#"> <i class="fa fa-sign-out-alt"></i>
                Logout</a></li>
    </ul>
</div>
<!-- End ofSidebar-->

<!-- Logout modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="controller/logoutController.php" method="POST">
                    <button type="submit" name="logout-btn" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Logout modal -->

<!-- Medical Record modal -->
<div class="modal fade" id="medicalRecord" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="patient-id">
                    <input type="hidden" id="username" value="<?php echo $_SESSION['username']?>">
                    <div class="form-group">
                        <label for="weight">Weight (Kgs)</label>
                        <input type="text" class="form-control" id="weight" placeholder="Weight">
                    </div>
                    <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" class="form-control" id="height" placeholder="Height">
                    </div>
                    <div class="form-group">
                        <label for="temp_reading">Temperature reading <span>&#8451;</span> </label>
                        <input type="text" class="form-control" id="temp_reading" placeholder="Temp reading">
                    </div>
                    <div class="form-group">
                        <label for="diagnosis"><Code></Code></label>
                        <select class="form-control" id="diagnosis">
                            <option value="A00-B99|Certain infectious and parasitic diseases">Certain infectious and
                                parasitic diseases</option>
                            <option value="C00-D49|Neoplasms">Neoplasms</option>
                            <option value="D50-D89|Diseases of the blood and blood-forming organs and certain
                                disorders
                                involving the immune mechanism">Diseases of the blood and blood-forming organs and
                                certain
                                disorders
                                involving the immune mechanism</option>
                            <option value="E00-E89|Endocrine, nutritional and metabolic diseases">Endocrine, nutritional
                                and metabolic diseases</option>
                            <option value="F01-F99|Mental, Behavioral and Neurodevelopmental disorders">Mental,
                                Behavioral and Neurodevelopmental disorders</option>
                            <option value="G00-G99|Diseases of the nervous system">Diseases of the nervous system
                            </option>
                            <option value="H00-H59|Diseases of the eye and adnexa">Diseases of the eye and adnexa
                            </option>
                            <option value="H60-H95|Diseases of the ear and mastoid process">Diseases of the ear and
                                mastoid process</option>
                            <option value="I00-I99|Diseases of the circulatory system">Diseases of the circulatory
                                system</option>
                            <option value="J00-J99|Diseases of the respiratory system">Diseases of the respiratory
                                system</option>
                            <option value="K00-K95|Diseases of the digestive system">Diseases of the digestive system
                            </option>
                            <option value="L00-L99|Diseases of the skin and subcutaneous tissue">Diseases of the skin
                                and subcutaneous tissue</option>
                            <option value="M00-M99|Diseases of the musculoskeletal system and connective tissue">
                                Diseases of the musculoskeletal system and connective tissue
                            </option>
                            <option value="N00-N99|Diseases of the genitourinary system">Diseases of the genitourinary
                                system</option>
                            <option value="O00-O9A|Pregnancy, childbirth and the puerperium">Pregnancy, childbirth and
                                the puerperium</option>
                            <option value="P00-P96|Certain conditions originating in the perinatal period">Certain
                                conditions originating in the perinatal period
                            </option>
                            <option value="Q00-Q99|Congenital malformations, deformations and chromosomal
                                abnormalities">Congenital malformations, deformations and chromosomal
                                abnormalities
                            </option>
                            <option value="R00-R99|Symptoms, signs and abnormal clinical and laboratory
                                findings, not
                                elsewhere
                                classified">Symptoms, signs and abnormal clinical and laboratory
                                findings, not
                                elsewhere
                                classified</option>
                            <option value="S00-T88|Injury, poisoning and certain other consequences of external
                                causes">Injury, poisoning and certain other consequences of external
                                causes
                            </option>
                            <option value="U00-U85|Codes for special purposes">Codes for special purposes</option>
                            <option value="V00-Y99|External causes of morbidity">External causes of morbidity</option>
                            <option value="Z00-Z99 Factors influencing health status and contact with health
                                services">Factors influencing health status and contact with health
                                services
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form>
                    <button type="button" id="health-record-btn" class="btn btn-primary">Add medical
                        record</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Medical Record modal -->

<!-- View Medical Record modal -->
<div class="modal fade" id="viewMedicalRecord" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient's health history</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="id">
                </form>
                <div id="patient_data">
                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- End of View Medical Record modal -->