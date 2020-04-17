$(document).ready(function() {

$(document).on('submit', '.form-profile', function(e){
  e.preventDefault();
  var data = new Array();
  data = $(this).serializeArray();
  Swal.fire({
    title: 'Are you sure?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#B0AEAE',
    confirmButtonColor: '#d33',
    confirmButtonText: 'Confirm'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "{{route('saveInfo')}}",
        type: "PUT",
        data: data,
        success:function(data){
          if(data.success){
          toastr.success(data.success, 'Success!');
        }else{
          toastr.error(data.error, 'Error!');
        }
        }
      });
    }
  });


});
$(document).on('submit', '.form-address', function(e){
  e.preventDefault();
  var data = new Array();
  data = $(this).serializeArray();
  Swal.fire({
    title: 'Are you sure?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#B0AEAE',
    confirmButtonColor: '#d33',
    confirmButtonText: 'Confirm'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "{{route('saveAddress')}}",
        type: "PUT",
        data: data,
        success:function(data){
          if(data.success){
          toastr.success(data.success, 'Success!');
        }else{
          toastr.error(data.error, 'Error!');
        }
        }
      });
    }
  });
});

$(document).on('submit', '.form-password', function(e){
  e.preventDefault();
  var pass = $('#newpass').val();
  if($('#errorRep').hasClass('error') || $('#errorPass').hasClass('error')){

  }else{

    $.ajax({
      url : "{{route('changePass')}}",
      method: "PATCH",
      data: {
        pass : pass
      },
      success:function(data){
        if(data.success){
        toastr.success(data.success, 'Success!');
        $('#newpass').val('');
        $('#repass').val('');
        $('#pass').val('');
        }else{
        toastr.error(data.error, 'Error!');
      }
      }
    });

  }
});

$(document).on('blur', '#repass', function(){
  var repass = $(this).val();
  var newpass = $('#newpass').val();

  if(newpass != repass){
    $('#errorRep').show();
    $('#errorRep').addClass('error');
  }else{
    $('#errorRep').hide();
    $('#errorRep').removeClass('error');
  }
});

$(document).on('blur', '#newpass', function(){
  var newpass = $(this).val();
  var repass = $('#repass').val();

if(repass == ''){

}else{
  if(newpass != repass){
    $('#errorRep').show();
    $('#errorRep').addClass('error');

  }else{
    $('#errorRep').hide();
    $('#errorRep').removeClass('error');

  }
}

});

$(document).on('blur', '#pass', function(){
  var pass = $(this).val();
  $.ajax({
    url : "{{route('checkPass')}}",
    method: "PATCH",
    data: {
      pass : pass
    },
    success:function(data){
      if(data == 0){
        $('#errorPass').show();
        $('#errorPass').addClass('error');
      }else{
        $('#errorPass').hide();
        $('#errorPass').removeClass('error');
      }
    }
  });
});

$('#errorRep').hide();
$('#errorPass').hide();

  $.ajax({
            url: "{{ route('profile')}}",
            method: "GET",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data){
              $('#fname').val(data[0].firstName);
              $('#mname').val(data[0].midName);
              $('#lname').val(data[0].lastName);
              $('#bday').val(data[0].birthDay);
              $('#gender').val(data[0].gender);
              $('#email').val(data[0].email);
              $('#contact').val(data[0].mobileNum);
              $('#brgy').val(data[0].brgy);
              $('#houseNum').val(data[0].buldingNum);
              $('#province').val(data[0].province);
              $('#zip').val(data[0].zip);

              $('#province').trigger('change',['change', $('#tag').val(data[0].city)]);
            }
        });
        setTimeout(function() {
          var cit = $('#tag').val();
          $('#city').val(cit);
        }, 500);


});
window.onload = function() {
	var $ = new City();
	$.showProvinces("#province");
	$.showCities("#city");
}
