$(document).ready(function() {
    $("#all-question-comments-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#question-comments-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#question-comments-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitQuestionCommentIdsForDeletion() {
    $("#question-comments-form").submit();
}

