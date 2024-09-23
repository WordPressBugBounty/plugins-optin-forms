jQuery(document).ready(function($){

  $('input[name="OF_NAME"][id*="optinforms"]').each(function(){
    if ( ! $(this).is(':visible') ) {
      $(this).prop( 'required', false );
    }
  })

  $('input[name="name"][id*="optinforms"]').each(function(){
    if ( ! $(this).is(':visible') ) {
      $(this).prop( 'required', false );
    }
  })

  $('input[name="fields[name]"][id*="optinforms"]').each(function(){
    if ( ! $(this).is(':visible') ) {
      $(this).prop( 'required', false );
    }
  })

  $(document).on( 'keyup change', 'input[name="OF_NAME"]', function(){

    var fullName = '',
    firstName = '',
    lastName = '',
    wrapper = $(this).closest('.optinforms-form-container');

    fullName = $(this).val();
    fullName = fullName.split(' ');
    console.log( fullName );
    $.each( fullName, function( key, value ) {
      if ( key == 0 ) {
        firstName += value;
      } else if ( key == 1 ) {
        lastName += value;
      } else {
        lastName += ' ' + value;
      }
    });
    $('input[name="FNAME"].optinforms-mailchimp-field', wrapper).val( firstName );
    $('input[name="LNAME"].optinforms-mailchimp-field', wrapper).val( lastName );
  });

});

document.addEventListener('DOMContentLoaded', function() {
  let element = document.querySelector('.optinforms-solution-mailerlite');
  if ( element ) {
    element.addEventListener('submit', function (event) {
      event.preventDefault();
      let form = this;
      form.querySelector('.optinforms-status-success-message').style.display = 'none';
      form.querySelector('.optinforms-status-error-message').style.display = 'none';
      fetch(form.getAttribute('action'), {
        method: form.getAttribute('method'),
        body: new FormData(form)
      }).then(res=>res.text()).then(function (data) {
        let result = JSON.parse(data);
        if ( result.success ) {
          form.querySelector('.optinforms-status-success-message').style.display = 'block';
        } else {
          form.querySelector('.optinforms-status-error-message').style.display = 'block';
        }
      });					
    });
  }
});