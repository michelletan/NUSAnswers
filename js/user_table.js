$(document).ready(function () {
    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });
 });