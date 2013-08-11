function openLoginDialog(url, callback) {
    setCookie("ref", location.href, 1000);
    $.oauthpopup({
        path:url,
        windowName:'SignInWithTwitter',
        callback:function () {
            if (callback == null) {
                window.location.reload();
            } else {
                window.location = callback;
            }

        }
    });
}

function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    c_value = c_value + "; path=/";
    document.cookie = c_name + "=" + c_value;
}

function loginUser() {
    var username = $("#username");
    var email = $("#email");
    var password = $("#password");
    var passwordRepeat = $("#password-repeat");
    var networkType = $("#network-type");
    var ref = $("#ref");

    //Patterns
    var usernamePattern = /^[a-z0-9]+$/i;

    var emailPattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

    //Username check
    if (!usernamePattern.test(username.val())) {
        username.parents(".control-group").addClass("error");
        username.parent().append('<span class="help-inline">Alphanumeric only!</span>');
        return false;
    }
    //Email check
    if (!emailPattern.test(email.val())) {
        email.parents(".control-group").addClass("error");
        email.parent().append('<span class="help-inline">Invalid email!</span>');
        return false;
    }

    if (password.val().length < 1) {
        password.parents(".control-group").addClass("error");
        password.parent().append('<span class="help-inline">Password cannot be empty!</span>');
    }

    if (passwordRepeat.val().length < 1) {
        passwordRepeat.parents(".control-group").addClass("error");
        passwordRepeat.parent().append('<span class="help-inline">Password cannot be empty!</span>');
    }

    //Password check
    if (password.val() != passwordRepeat.val()) {
        password.parents(".control-group").addClass("error");
        passwordRepeat.parents(".control-group").addClass("error");
        password.parent().append('<span class="help-inline">Mismatch password!</span>');
        passwordRepeat.parent().append('<span class="help-inline">Mismatch password!</span>');
        return false;
    }

    $.ajax({
        type: 'POST',
        url: 'loginuser.php',
        data: 'username=' + username.val() + '&email=' + email.val() + '&password=' + password.val() + '&networktype=' + networkType.val(),
        dataType: 'json',
        success: function(JSON) {
            if (JSON.data.resultType == 3) {
                email.parents(".control-group").addClass("error");
                email.parent().append('<span class="help-inline">Email already exists!</span>');
            }

            if (JSON.data.resultType == 4) {
                username.parents(".control-group").addClass("error");
                username.parent().append('<span class="help-inline">Username already exists!</span>');
            }

            if (JSON.data.resultType == 5) {
                $('#myModal').modal('hide');
                window.location.href = ref.val();
            }


        }
    });
}