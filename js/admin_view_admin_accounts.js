$(document).ready(function() {
    $("#all-accounts-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#admin-accounts-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#admin-accounts-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitAdminIdsForDeletion() {
    $("#admin-accounts-form").submit();
}

