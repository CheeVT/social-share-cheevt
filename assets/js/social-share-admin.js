jQuery(document).ready(function ($) {

  $('.form-table__social-networks td').sortable();

  $('.form-table__social-networks input').on('change', function() {
    console.log($(this));
    if($(this).is(':checked')) {
      $("label[for='" + $(this).attr('id') + "']").addClass('checked');
    } else {
      $("label[for='" + $(this).attr('id') + "']").removeClass('checked');
    }
  });

  $('#custom_color_background').wpColorPicker();
  $('#custom_color_color').wpColorPicker();

  $('.form-table__color input').on('change', function(){
    if($(this).val() == 'custom') {
      $('.form-table__custom-color').show();
    } else {      
      $('.form-table__custom-color').hide();
    }
  });
});