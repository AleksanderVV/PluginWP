jQuery(document).ready(function($){

  $('#aleproperty_booking_submit').on('click',function(e){
    e.preventDefault();

    $.ajax({
      url: aleproperty_bookingform_var.ajaxurl,
      type: 'post',
      data: {
        action: 'booking_form',
        nonce: aleproperty_bookingform_var.nonce,
        name: $('#aleproperty-name').val(),
        email: $('#aleproperty-email').val(),
        phone: $('#aleproperty-phone').val(),
        price: $('#aleproperty-price').val(),
        location: $('#aleproperty-location').val(),
        title: $('#aleproperty-title').val(),
      },
      success: function(data){
        $('#aleproperty-result').html(data);
      },
      error: function(errorThrown){
        console.log(errorThrown);
      }
    });
  });
});