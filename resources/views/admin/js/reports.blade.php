{{-- <script> --}}
$(document).ready(function(){

  let yy = new Date();
  let currYear = yy.getFullYear();
  for (var i = currYear; i > currYear-8; i--) {
    $('#repYear').append("<option value='"+i+"'>"+i+"</option>");
  }

$(document).on('submit', '.form-report', function(e){
  e.preventDefault();
  let info = $(this).serializeArray();
  window.open('reports/generateReport/'+info[0].value+'_'+info[1].value+'_'+info[2].value, '_blank');

            setTimeout(function(){
              window.location.reload();
            }, 1000);
});


  $(document).on('change', '#repType', function(){
    let typ = $(this).val();
    if(typ == 1){
      checkOpen();
      $('#repDay').removeAttr('disabled');
      $('#repDay').attr('required', 'true');
      $('#repDay').removeClass('repDate');
    }else if(typ == 2){
      checkOpen();
      $('#repWeek').removeAttr('disabled');
      $('#repWeek').attr('required', 'true');
      $('#repWeek').removeClass('repDate');
    }else if(typ == 3){
      checkOpen();
      $('#repMonth').removeAttr('disabled');
      $('#repMonth').attr('required', 'true');
      $('#repMonth').removeClass('repDate');
    }else if(typ == 4){
      checkOpen();
      $('#repYear').removeAttr('disabled');
      $('#repYear').attr('required', 'true');
      $('#repYear').removeClass('repDate');
    }
  });

  function checkOpen(){
    if(!$('#repDay').hasClass('repDate')){
      $('#repDay').removeAttr('required');
      $('#repDay').attr('disabled', 'true');
      $('#repDay').addClass('repDate');
    }else if(!$('#repWeek').hasClass('repDate')){
      $('#repWeek').removeAttr('required');
      $('#repWeek').attr('disabled', 'true');
      $('#repWeek').addClass('repDate');
    }
    else if(!$('#repMonth').hasClass('repDate')){
      $('#repMonth').removeAttr('required');
      $('#repMonth').attr('disabled', 'true');
      $('#repMonth').addClass('repDate');
    }else if(!$('#repYear').hasClass('repDate')){
      $('#repYear').removeAttr('required');
      $('#repYear').attr('disabled', 'true');
      $('#repYear').addClass('repDate');
    }
  }
});
