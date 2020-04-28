{{-- <script type="text/javascript"> --}}

$(document).ready(function(){
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  $(document).on('click','.login_btn', function(e){
    e.preventDefault();

    $.ajax({
      url: '{{route('login')}}',
      type: 'POST',
      data: $('.form-login').serialize(),
      success:function(response){
        if(response == 1){
          window.location.reload();
        }else if(response == 2){
          toastr.error('Your account is deactivated', 'Error!');
          $('.card-body').load(window.location.href+" .card-body");
        }else{
          toastr.error(response, 'Error!');
        }
      }
    });
  });

});
