{{-- <script> --}}
$(document).ready(function() {
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('submit', '.login-form', function(e){
  e.preventDefault();
  $.ajax({
    url: '{{ route('admin.login') }}',
    type: 'POST',
    data: $('.login-form').serialize(),
    success:function(response){
      if(response == 1){
        window.location.reload();
      }else{
        toastr.error(response, 'Error!');
      }
    }
  }).fail(function(data) {
    let res = JSON.parse(data.responseText);
    if(res.errors['email']){
      toastr.error(res.errors['email'], 'Error!');

    }else{
      toastr.error('Something went wrong.', 'Error!');

    }
  });



  });
});
