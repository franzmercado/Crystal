{{-- <script> --}}
$(document).ready(function() {
  $('#error-pass').hide();

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
let cncat = setLimitDate();
$('#Birthday').attr('max', cncat);

$(document).on('blur', '#Password', function(){
  let pass = $(this).val();
  let rpass = $('#rpass').val();

if(rpass == ''){

}else if(pass == rpass){
  $('#error-pass').hide();
  $('#error-pass').removeClass('error');
}else{
  $('#error-pass').show();
  $('#error-pass').addClass('error');
}
});

$(document).on('blur', '#rpass', function(){
  let rpass = $(this).val();
  let pass = $('#Password').val();

  if(pass == rpass){
    $('#error-pass').hide();
    $('#error-pass').removeClass('error');
  }else{
    $('#error-pass').show();
    $('#error-pass').addClass('error');
  }
});



$(document).on('submit', '.form-register', function(e){
  e.preventDefault();
  $('.btn-reg').focus();
  setTimeout(function() {

    if($('#error-pass').hasClass('error')){
      return false;
    }else{
      Swal.fire({
        title: 'Are you sure?',
        text: "This form will be submitted.",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#B0AEAE',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "{{ route('register') }}",
            type: "POST",
            data: $('.form-register').serialize(),
            success:function(data){
              if(data == 1){
                toastr.success('Registered successfully', 'Success!');
                setTimeout(function() {
                  window.location.reload();
                }, 800);

              }else{
                for(var i = 0; i < data.errors.length; i++){
                toastr.error(data.errors[i], 'Error!');
                }
              }
            }
          });
        }
      });
    }
  }, 300);
});


});

function setLimitDate(){
  let dte = new Date();
  let yr = dte.getFullYear();
  let mm = dte.getMonth()+1;
  let dy = dte.getDate();
  if(mm < 10){
    mm = '0'+mm;
  }
  if(dy < 10){
    dy = '0'+dy;
  }
  let limit = yr -18;
  return limit+'-'+mm+'-'+dy;

}
