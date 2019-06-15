$(document).ready(function() {
  $('#registration').submit(function(){
    return checkRegistion();
  })
});
function checkRegistion(){
  var field_email = $('#email').val();
  var filter_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
  var field_name = $('#name').val();
  var filter_name = /^\w+$/;
  var field_phone = $('#phone').val();
  var filter_phone = /^\d+$/;
  var field_password = $('#password').val();
  var filter_password = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
  if(filter_email.test(field_email) == false)
  {
    $('#email').parent().addClass('has-error');
    return false;
  }
  else
  {
     $('#email').parent().removeClass('has-error');
  }
  if(filter_password.test(field_password) == false)
  {
     $('#password').parent().addClass('has-error');
    return false;
  }
  else
  {
     $('#password').parent().removeClass('has-error');
  }
  if(filter_name.test(field_name) == false)
  {
     $('#name').parent().addClass('has-error');
    return false;
  }
  else
  {
     $('#name').parent().removeClass('has-error');
  }
  if(filter_phone.test(field_phone) == false)
  {
     $('#phone').parent().addClass('has-error');
    return false;
  }
  else
  {
     $('#phone').parent().removeClass('has-error');
  }

  return true;
}



