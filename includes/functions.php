<?php
require_once('db.php');

function auth_login(){
    session_start();
    if (!isset($_SESSION['email']) && !isset($_SESSION['isLoggedIn'])) {
        header('Location:login.php');
    }
}

function logout(){
    session_start();
    if (isset($_POST['logout-btn'])) {
        session_destroy();
        header('Location:../index.php');
    }
}

function getMedicalRecords(){
    global $conn;
    $id = $_POST['id'];
    $query = "SELECT * FROM health_records WHERE patient_id = $id ORDER BY visit_date DESC";
    $html = '<ul class="timeline">';
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
          $visit_date = $row['visit_date'];
           $html.='<li>
           <a class="text-primary">Vital Signs</a>
           <a class="float-right text-primary">'.date("D, d M Y H:i A", strtotime($visit_date)).'</a>
           <table class="table table-bordered mt-2">
           <thead class="thead-light">
              <tr>
                <th scope="col">Weight(Kgs)</th>
                <th scope="col">Height(M)</th>
                <th scope="col">Temperature Reading<span>&#8451;</span></th>
              </tr>
            </thead>
            <tbody>
               <tr>
                 <td>'.$row['weight'].'</td>
                 <td>'.$row['height'].'</td>
                 <td>'.$row['temp_reading'].'</td>
               </tr>
            <tbody>
           </table>
            <div class="card mt-2">
                <div class="card-header bg-light">
                    <h6>Diagnosis used</h6>
                </div>
                <div class="card-body">
                    <ul>
                       <li>'.$row['code_description'].'</li>
                       <a class="btn btn-primary mt-3" href="https://www.icd10data.com/ICD10CM/Codes/'.$row['code'].'" target="_blank">View Diagnosis</a>
                    </ul>
                </div>
            </div>
       </li>'; 
        } 
    }
    else{
        $html.='<li><center>No data recorded for this patient</center></li>';
    }
    $html.='<ul>';
    echo json_encode(['status' => 'success', 'content' => $html]);
}

function createAccount()
{
    global $conn;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $username = checkData($username);
    $email = checkData($email);
    $password = checkData($password);
    $confirm_password = checkData($confirm_password);
    $response = array();
    $select_query = "SELECT * FROM providers WHERE email = ?";
    $select_pre = $conn->prepare($select_query);
    $select_pre->bind_param("s", $email);
    $select_pre->execute();
    $select_result = $select_pre->get_result();

    $select_username = "SELECT * FROM providers WHERE username = ?";
    $username_pre = $conn->prepare($select_username);
    $username_pre->bind_param("s", $username);
    $username_pre->execute();
    $select_username_result = $username_pre->get_result(); 
    if ($select_username_result->num_rows > 0) {
        $response[0] = "Warning";
        $response[1] = "This username is already taken";
        $response[2] = "warning";
        $response[3] = "Ok";
        echo json_encode($response);
    }else if ($select_result->num_rows > 0) {
        $response[0] = "Warning";
        $response[1] = "This email address is already connected to an account";
        $response[2] = "warning";
        $response[3] = "Ok";
        echo json_encode($response);
    } else{
        $password = sha1($password);
        $query = "INSERT INTO providers (username,email,password) VALUES (?,?,?)";
        $pre = $conn->prepare($query);
        $pre->bind_param("sss", $username, $email,$password);
        $result = $pre->execute();
        if ($result) {
            $response[0] = "Success";
            $response[1] = "Account successfully created";
            $response[2] = "success";
            $response[3] = "Ok";
            echo json_encode($response);
        } else {
            $response[0] = "Error";
            $response[1] = "Failed to create account";
            $response[2] = "error";
            $response[3] = "Ok";
            echo json_encode($response);
        } 
    }
}

function userLogin()
{
    global $conn;
    $email = $_POST['umail'];
    $password = $_POST['upass'];
    $email = checkData($email);
    $password = checkData($password);
    $password = sha1($password);
    $response = array();
    $select = "SELECT * FROM providers";
    $res = $conn->query($select);
    if ($res->num_rows == 0) {
        $response[0] = "Information";
        $response[1] = "No user account";
        $response[2] = "info";
        $response[3] = "Ok";
        echo json_encode($response);
    } else {
        $query = "SELECT * FROM providers WHERE email = ? AND password = ?";
        $pre = $conn->prepare($query);
        $pre->bind_param("ss", $email, $password);
        $pre->execute();
        $result = $pre->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['isLoggedIn'] = true;
            }
            $response[0] = "status";
            $response[1] = "success";
            echo json_encode($response);
        } else {
            $response[0] = "Error";
            $response[1] = "Email Address or Password is incorrect";
            $response[2] = "error";
            $response[3] = "Ok";
            echo json_encode($response);
        }
    }
}

function checkData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function viewUsers()
{
    global $conn;
    $html = "";
    $html = '<table class="table table-sm table-bordered table-hover" id="usertable">
    <thead class="thead-light">
        <th>ID</th>
        <th>Username</th>
        <th>Email Adress</th>
        <th>Date Registered</th>
    </thead>';
    $sql = "SELECT * FROM providers";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>
            <td>' . $row['provider_id'] . '</td>
            <td>' . $row['username'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['registered_date']. '</td>
        </tr>';
        }
    } else {
        $html .= ' <tr><td colspan="4" align="center">No data found</td></tr>';
    }
    $html .= '</table> ';

    echo json_encode(['status' => 'success', 'content' => $html]);
}

function viewPatients()
{
    global $conn;
    $html = "";
    $html = '<table class="table table-sm table-bordered table-hover" id="patientstable">
    <thead class="thead-light">
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Date of birth</th>
        <th>Current Address</th>
        <th>Occupation</th>
        <th>Medical Record</th>
    </thead>';
    $sql = "SELECT * FROM patients";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>
            <td>' . $row['patient_id'] . '</td>
            <td>' . $row['first_name'] . '</td>
            <td>' . $row['last_name'] . '</td>
            <td>' . $row['gender']. '</td>
            <td>' . $row['date_of_birth']. '</td>
            <td>' . $row['current_address'].'</td>
            <td>' . $row['occupation']. '</td>
            <td colspan="2">
            <Button class="btn btn-primary" id="add-medical-record" data-id="' . $row['patient_id'] . '"><i class="fa fa-plus-circle"></i></Button>
            <Button class="btn btn-secondary" id="view-medical-record" data-id1="' . $row['patient_id'] . '"><i class="fa fa-eye"></i></Button>
            </td>
        </tr>';
        }
    } else {
        $html .= ' <tr><td colspan="8" align="center">No data found</td></tr>';
    }
    $html .= '</table> ';

    echo json_encode(['status' => 'success', 'content' => $html]);
}

function addPatient()
{
    global $conn;
    $firstName = $_POST['username'];
    $lastName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $current_address = $_POST['current_address'];
    $occupation = $_POST['occupation'];
    $response = array();
    $firstName = checkData($firstName);
    $lastName = checkData($lastName);
    $gender = checkData($gender);
    $dob = checkData($dob);
    $current_address = checkData($current_address);
    $occupation = checkData($occupation);
    $query = "INSERT INTO patients (first_name ,last_name,gender ,date_of_birth,current_address,occupation) VALUES(?,?,?,?,?,?)";
    $pre = $conn->prepare($query);
    $pre->bind_param("ssssss", $firstName, $lastName, $gender, $dob, $current_address, $occupation);
    $result = $pre->execute();
    if ($result) {
        $response[0] = "Information";
        $response[1] = "Patient successfully added";
        $response[2] = "info";
        $response[3] = "Ok";
        echo json_encode($response);
    } else {
        $response[0] = "Error";
        $response[1] = "Failed to add the patient";
        $response[2] = "error";
        $response[3] = "Ok";
        echo json_encode($response);
    }
}

function addPatientHealthRecord()
{
    global $conn;
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $temp_reading = $_POST['temp_reading'];
    $diagnosis = explode('|',$_POST['diagnosis']);
    $code = $diagnosis[0];
    $code_description = $diagnosis[1];
    $patient_id = $_POST['patient_id'];
    $provider_username = $_POST['username'];
    $response = array();
    $query = "INSERT INTO health_records (patient_id,weight ,height ,temp_reading ,code,code_description,provider_username) VALUES(?,?,?,?,?,?,?)";
    $pre = $conn->prepare($query);
    $pre->bind_param("idddsss", $patient_id, $weight, $height, $temp_reading, $code, $code_description,$provider_username);
    $result = $pre->execute();
    if ($result) {
        $response[0] = "Information";
        $response[1] = "Patient's health record successfully added";
        $response[2] = "info";
        $response[3] = "Ok";
        echo json_encode($response);
    } else {
        $response[0] = "Error";
        $response[1] = "Failed to add the record";
        $response[2] = "error";
        $response[3] = "Ok";
        echo json_encode($response);
    }
}