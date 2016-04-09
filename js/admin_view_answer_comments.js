$(document).ready(function() {
    $("#all-answer-comments-checkbox").click(function() {
        if ($(this).prop("checked")) {
            $("#answer-comments-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", true);
            })
        } else {
            $("#answer-comments-table tbody input[type='checkbox']").each(function() {
                $(this).prop("checked", false);
            })
        }
    });
});

function submitAnswerCommentIdsForDeletion() {
    $("#answer-comments-form").submit();
}

