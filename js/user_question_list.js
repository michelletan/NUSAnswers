$(document).ready(function() {
    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

    $('.edit').on('click', function() {
      $('#edit-modal').modal('show'); 
      var questionId = $(this).attr("id");
    });

    $('.delete').on('click', function() { 
       $('#delete-modal').modal('show', function () {
      });
      var questionId = $(this).attr("id");

    });
});