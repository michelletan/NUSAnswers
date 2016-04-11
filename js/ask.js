$(document).ready(function() {
    $("#question-tags").tagit({
         showAutocompleteOnFocus: true,
         autocomplete: {
             source: "/tag/search",
             minLength: 2
         }
    });
});
