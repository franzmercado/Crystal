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
      if(data.user.info.isActive != 1){
        Swal.fire({
          title: 'Are you sure?',
          text: "This user account will be activated.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#B0AEAE',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.value) {
            $.ajax({
               url: "users/act/"+uId,
               type: "PATCH",
               data:{
                 id : uId,
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
      }else{
        Swal.fire({
          title: 'Are you sure?',
          text: "This user account will be deactivated.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#B0AEAE',
          confirmButtonText: 'Confirm'
        }).then((result) => {
          if (result.value) {
            $.ajax({
               url: "users/deact/"+uId,
               type: "PATCH",
               data:{
                 id : uId,
                 _token : '{{ csrf_token()}}',
               },
               success:function(data){
                 if(data.error){
                   toastr.error(data.error, 'Error!');
                 }else{
                   toastr.success(data.success, 'Success!');
                 }
                 $('#usersTbl').DataTable().ajax.reload();
               }
           });
          }
        });
      }
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
