{{-- <script type="text/javascript"> --}}

$(document).ready(function() {
$('.cpass-error').hide();
$('.newPass-error').hide();

$.ajax({
  url: '{{route('admin.profile')}}',
  type: 'GET',
  success:function(data){
    $('#fname').val(data.fname);
    $('#lname').val(data.lname);
    $('#email').val(data.email);
  }
});

$(document).on('submit', '.form-info', function(e){
  e.preventDefault();

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
        url: "{{ route('admin.saveProfile')}}",
        method: 'PUT',
        data: $(this).serialize(),
        success:function(data){
          if(data.success){
            toastr.success(data.success, 'Success!');
          }else{
            toastr.error(data.errors, 'Error!');

          }
          {{-- console.log(data); --}}
        }
      });
    }
  });


});

$(document).on('blur', '#cpass', function(){

  let pass = $(this).val();
  if(pass != ''){
  $.ajax({
    url: "{{ route('admin.checkPass')}}",
    type: 'POST',
    data: {pass: pass},
    success:function(data){
      if(data == 1){
        $('.cpass-error').hide();
        $('.cpass-error').removeClass('error');


      }else if(data == 0){
        $('.cpass-error').show();
        $('.cpass-error').addClass('error', 'true');

      }
    }
  });
}else{
  $('.cpass-error').hide();
  $('.cpass-error').removeClass('error');
}
});

$(document).on('blur', '#npass', function(){
  let npass = $(this).val();
  let rpass = $('#rpass').val();
if(rpass != ''){
if(npass == rpass){
  $('.newPass-error').hide();
  $('.newPass-error').removeClass('error');
}else{
  $('.newPass-error').show();
  $('.newPass-error').addClass('error', 'true');
}
}else{

}
});

$(document).on('blur', '#rpass', function(){
  let rpass = $(this).val();
  let npass = $('#npass').val();

if(npass == rpass){
  $('.newPass-error').hide();
  $('.newPass-error').removeClass('error');
}else{
  $('.newPass-error').show();
  $('.newPass-error').addClass('error', 'true');
}
});

$(document).on('submit', '.form-pass', function(e){
  e.preventDefault();
  let newPass = $('#npass').val();

  if($('.cpass-error').hasClass('error')){
    $('#cpass').focus();
    return false;
  }else if($('.newPass-error').hasClass('error')){
    $('#rpass').focus();
    return false;
  }else{

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
          url: "{{ route('admin.changePass')}}",
          type: "PUT",
          data: {pass : newPass},
          success:function(data){
            if(data.success){
              toastr.success(data.success, 'Success!');
              $('.form-pass').trigger('reset');
            }else{
              toastr.error(data.errors, 'Error!');

            }
          }
        });
      }
    });
  }
});

});
