$(document).ready(function() {
    createAccount();
    userLogin();
    viewUsers();
})

function createAccount() {
    $("#createAccountBtn").click(function() {
        var username = $("#username").val();
        var emailAddress = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirm-password").val();
        var formData = new FormData();
        if (username == '' || emailAddress == '' || password == '' || confirmPassword == '') { //Fields validation
            showAlert("Fields Validation", "Please enter in all fields", "warning", "Ok");
        } else {
            var pattern = /^[a-zA-Z ]+$/;
            var email_pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!username.match(pattern)) {
                showAlert("Fields Validation", "Username is invalid", "warning", "Ok");
            } else if (!emailAddress.match(email_pattern)) {
                showAlert("Fields Validation", "Email is invalid", "warning", "Ok");
            } else if (password != confirmPassword) {
                showAlert("Password validation", "Passwords dont match", "error", "Ok");
            } else if (password.trim().length < 8) {
                showAlert("Password validation", "Password must contain atleast 8 characters.", "error", "Ok");
                $("#password").focus();
                $("#confirm-password").focus();
            } else {
                formData.append('username', username);
                formData.append('email', emailAddress);
                formData.append('password', password);
                formData.append('confirm-password', confirmPassword);
                $.ajax({
                    url: './Controller/createAccountController.php',
                    method: 'post',
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        showAlert1(response[0], response[1], response[2], response[3]);
                    },
                    error: function(response) {
                        showAlert(response[0], response[1], response[2], response[3]);
                    }
                })
            }
        }
    })
}

function userLogin() {
    $("#loginBtn").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        if (email == '' || password == '') {
            showAlert("Fields Validation", "Please enter in all fields", "warning", "Ok");
        } else {
            $.ajax({
                url: './Controller/userLoginController.php',
                method: 'post',
                dataType: 'JSON',
                data: {
                    umail: email,
                    upass: password
                },
                success: function(response) {
                    if (response[1] === 'success') {
                        window.location.href = './index.php';
                    } else {
                        showAlert(response[0], response[1], response[2], response[3])
                    }
                },
            })
        }
    })

    $("#cancel-add-user-btn").click(function() {
        $("form").trigger("reset");
    })
}

function viewUsers() {
    $.ajax({
        url: "./Controller/viewUsersController.php",
        method: "post",
        success: function(data) {
            data = $.parseJSON(data);
            $("#table").html(data.content);
            $('#usertable').DataTable();
        },
    });
}

function showAlert1(title, message, iconName, buttonText) {
    swal({
        title: title,
        text: message,
        icon: iconName,
        button: buttonText,
    }).then(function() {
        if (title == 'Warning') {} else {
            window.location.href = 'index.php';
        }
    })

}

function showAlert(title, message, iconName, buttonText) {
    swal({
        title: title,
        text: message,
        icon: iconName,
        button: buttonText,
    })
}