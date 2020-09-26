jQuery(document).ready(function ($) {
  $('#custom_color_background').wpColorPicker();
  $('#custom_color_color').wpColorPicker();

  $('.form-table__color input').on('change', function(){
    if($(this).val() == 'custom') {
      $('.form-table__custom-color').show();
    } else {      
      $('.form-table__custom-color').hide();
    }
  })
});