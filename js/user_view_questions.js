$(document).ready(function() {
    $("#all-questions-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#questions-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#questions-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitQuestionIdsForDeletion() {
    $("#questions-form").submit();
}