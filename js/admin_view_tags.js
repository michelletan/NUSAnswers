$(document).ready(function() {
    $("#all-tags-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#tags-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#tags-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitTagIdsForDeletion() {
    $("#tags-form").submit();
}

