$(document).ready(function () {


    // $('.login-form').hide();
    $('.register-form').hide();
    $('form').submit((e) => {
        e.preventDefault();
    });
    $('#gotocreate').click(() => {
        // alert('create');
        $('.login-form').hide();
        $('.register-form').show();
    });
    $('#gotologin').click(() => {
        // alert('create');
        $('.login-form').show();
        $('.register-form').hide();
    });

    $('input').on('input', function () {
        $(this).val($(this).val().replace(/\s+/g, ''));
    });


    // Login
    $('#btnlogin').click(() => {
        let myinputs = {
            username: document.getElementById('myusername').value,
            password: document.getElementById('mypassword').value,
        };
        $.ajax({
            type: "POST",
            url: "controllers/login.php",
            data: myinputs,
            success: (response) => {
                console.log(response);
                let response_json = JSON.parse(response);
                if (response_json.status_response !== 0) {
                    alert(response_json.msg);
                } else {
                    alert(response_json.msg);
                }
            }
        });
    })

    // Register
    $('#btnregister').click(() => {
        let myinputs = {
            username: document.getElementById('createusername').value,
            password: document.getElementById('createpassword').value,
        };
        $.ajax({
            type: "POST",
            url: "controllers/register.php",
            data: myinputs,
            success: (response) => {
                console.log(response);
                let response_json = JSON.parse(response);
                if (response_json.status_response !== 0) {
                    alert(response_json.msg);
                } else {
                    alert(response_json.msg);
                }
            }
        });
    })

});