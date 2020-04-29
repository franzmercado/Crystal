{{-- <script> --}}
$(document).ready(function() {
  $('#error-pass').hide();

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


$(document).on('submit', '.form-register', function(e){
  e.preventDefault();
{{-- console.log($(this).serialize()); --}}
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
      data: $(this).serialize(),
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



});


});
