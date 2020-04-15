$(document).ready(function() {
  $('#usersTbl').DataTable({
    processing: true,
    serverSide: true,
    rowId: 'userID',
    ajax:{
        url: "{{ route('admin.users')}}",
      },
        columns: [
      {
        data: 'userID',
        name: 'userID',
        orderable: false,
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'email',
        name: 'email'
      },
      {
        data: 'age',
        name: 'age',
        className: "text-center",
      },
      {
        data: 'dateJoined',
        name: 'DateJoined'
      },
      {
        data: 'status',
        name: 'status',
        orderable: false,
        className: "text-center",
      },

    ]
  });

  $(document).on('dblclick', '#usersTbl tbody tr', function(){
    var uId = $(this).attr('id');

    $.ajax({
    url: "users/"+uId,
    dataType: "json",
    success:function(data){
      $('#actTitle').text(data.user.userID);
      if(data.user.isActive != 1){
        $('.actBtn').attr('style', 'display:block;');
        $('.actBtn').attr('id', uId);
      }else{
        $('.deactBtn').attr('style', 'display:block;');
        $('.deactBtn').attr('id', uId);
      }
      $('#actModal').modal('show');
    }
    });
 });

$(document).on('click','.actBtn', function(){
  var id = $(this).attr('id');
  Swal.fire({
    title: 'Are you sure?',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#B0AEAE',
    confirmButtonText: 'Confirm'
  }).then((result) => {
    if (result.value) {
      $.ajax({
         url: "users/act/"+id,
         type: "PATCH",
         data:{
           id : id,
           _token : '{{ csrf_token()}}',
         },
         success:function(data){
           if(data.errors){
             for(var i = 0; i < data.errors.length; i++){
             toastr.error(data.errors[i], 'Error!');
             }
           }
           if(data.success){
             toastr.success(data.success, 'Success!');
           }
           $('#usersTbl').DataTable().ajax.reload();
           $('#actModal').modal('hide');
         }
     });
    }
  });
  });

  $(document).on('click','.deactBtn', function(){
    var id = $(this).attr('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#B0AEAE',
      confirmButtonText: 'Confirm'
    }).then((result) => {
      if (result.value) {
        $.ajax({
           url: "users/deact/"+id,
           type: "PATCH",
           data:{
             id : id,
             _token : '{{ csrf_token()}}',
           },
           success:function(data){
             if(data.errors){
               for(var i = 0; i < data.errors.length; i++){
               toastr.error(data.errors[i], 'Error!');
               }
             }
             if(data.success){
               toastr.success(data.success, 'Success!');
             }
             $('#usersTbl').DataTable().ajax.reload();
             $('#actModal').modal('hide');
           }
       });
      }
    });
    });

});


$(document).ready(function(){
	$('#actModal').on('hidden.bs.modal', function(e) {
    $('.deactBtn').attr('style', 'display:none;');
    $('.actBtn').attr('style', 'display:none;');
    $('#stats').val(null);

	});
});
