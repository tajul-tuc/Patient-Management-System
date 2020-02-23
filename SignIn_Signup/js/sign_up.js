function checkAvailability() {

    $("#loaderIcon").show();
    jQuery.ajax({

        data: 'patients_email=' + $("#patients_email").val(),
        type: "POST",
        success: function (data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function () {}
    });
}

function checkform() {
    if (document.form1.patients_email.value === "") {
        alert("Please enter email");
        return false;
    }
    else if(document.form1.patients_password.length < 6){
        alert("Bad Password!");
        return false;
    }

    else {
        document.form1.submit();
    }
}