$(document).ready(function() {
    $("#question-tags").tagit({
         showAutocompleteOnFocus: true,
         tagSource: function(search, showChoices) {
             if (search.term.length >= 2) {
                 $.ajax({
                   url: "/api/tag/search/",
                   data: search,
                   success: function(choices) {
                     showChoices(choices);
                   }
                 });
             } else {
                 showChoices([]);
             }

         }
    });
});
