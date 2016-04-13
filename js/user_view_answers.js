$(document).ready(function() {
    $("#all-answers-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#answers-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#answers-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitAnswerIdsForDeletion() {
    $("#answers-form").submit();
}