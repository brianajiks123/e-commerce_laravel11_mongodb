$().ready(function() {
    // Check Correct Admin Password
    $("#curr_password").on("change", function() {
        var curr_passwd = $("#curr_password").val();

        $.ajax({
            type: "post",
            url: "/admin/check-curr-password",
            headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
            data: {
                curr_passwd: curr_passwd,
            },
            success: function(res) {
                if(res == "wrong") {
                    $("#verifyCurrPassword").html("<font color='red'>Current password is incorrect!</font>");
                }

                if(res == "valid") {
                    $("#verifyCurrPassword").html("<font color='green'>Current password is correct.</font>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });
});
