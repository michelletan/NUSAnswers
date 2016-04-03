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

    $('.glyphicon').on('click', function() { 
      var className = $(this).attr("class");
      if(className.indexOf("glyphicon-pencil") != -1) {
        $("#edit-modal").modal("show");
      } else if(className.indexOf("glyphicon-trash") != -1) {
        $("#delete-modal").modal("show");
      } else if(className.indexOf("glyphicon-option-horizontal") != -1){
        $("#expand-modal").modal("show");
      } else {

      }
    });
});