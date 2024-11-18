import swal from 'sweetalert2';
window.Swal = swal;

$().ready(function() {
    // Check Correct Admin Password
    $("#curr_password").on("change", function() {
        var currPasswd = $("#curr_password").val();

        $.ajax({
            type: "post",
            url: "/admin/check-curr-password",
            headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
            data: {
                curr_passwd: currPasswd,
            },
            success: function(res) {
                if(res == "wrong") {
                    $("#verifyCurrPassword").html("<font color='red'>Current password is incorrect!</font>");
                } else if(res == "valid") {
                    $("#verifyCurrPassword").html("<font color='green'>Current password is correct.</font>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    // Update CMS Page Status
    $(".update_cms_page_status").on("click", function() {
        var status = $(this).children("i").attr("status");
        var pageId = $(this).attr("page_id");

        $.ajax({
            type: "post",
            url: "/admin/update-cms-page-status",
            headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
            data: {
                status: status,
                page_id: pageId,
            },
            success: function(res) {
                if(res["status"] == 0) {
                    $("#page-" + pageId).html("<i class='fas fa-toggle-off' style='color:grey' aria-hidden='true' status='Inactive'></i>");
                } else if(res["status"] == 1) {
                    $("#page-" + pageId).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    // Confirmation Delete CMS Page
    $(".confirm_cms_page_delete").on("click", function() {
        var record = $(this).attr("record");
        var recordId = $(this).attr("record_id");

        Swal.fire({
            title: "Are You Sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then(result => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your data has been deleted.", "success").then(() => window.location.href = `/admin/delete-${record}/${recordId}`);
            }
        });
    });

    // Update Subadmin Status
    $(".update_subadmin_status").on("click", function() {
        var status = $(this).children("i").attr("status");
        var subadminId = $(this).attr("subadmin_id");

        $.ajax({
            type: "post",
            url: "/admin/update-subadmin-status",
            headers: {"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")},
            data: {
                status: status,
                subadmin_id: subadminId,
            },
            success: function(res) {
                if(res["status"] == 0) {
                    $("#subadmin-" + subadminId).html("<i class='fas fa-toggle-off' style='color:grey' aria-hidden='true' status='Inactive'></i>");
                } else if(res["status"] == 1) {
                    $("#subadmin-" + subadminId).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    });

    // Confirmation Delete Subadmin
    $(".confirm_subadmin_delete").on("click", function() {
        var record = $(this).attr("record");
        var recordId = $(this).attr("record_id");

        Swal.fire({
            title: "Are You Sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then(result => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your data has been deleted.", "success").then(() => window.location.href = `/admin/delete-${record}/${recordId}`);
            }
        });
    });
});
