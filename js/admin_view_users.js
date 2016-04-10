$(document).ready(function() {
    $("#all-users-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#users-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#users-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitUserIdsForDeletion() {
    $("#users-form").submit();
}

