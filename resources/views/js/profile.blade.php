$(document).ready(function() {

$(document).on('submit', '.form-profile', function(e){
  e.preventDefault();
  alert(1);
});

  $.ajax({
            url: "{{ route('profile')}}",
            method: "GET",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success:function(data){
              console.log(data[0]);
              $('#fname').val(data[0].firstName);
              $('#mname').val(data[0].midName);
              $('#lname').val(data[0].lastName);
              $('#bday').val(data[0].birthDay);
              $('#email').val(data[0].email);
              $('#contact').val(data[0].mobileNum);
              $('#brgy').val(data[0].brgy);
              $('#houseNum').val(data[0].buldingNum);
              $('#province').val(data[0].province);
              $('#province').trigger('change');
              if($('#province').is(empty)){
                alert(1);
              }else{
                $('#city').val(data[0].city);

              }
            }
        });


});
window.onload = function() {
	var $ = new City();
	$.showProvinces("#province");
	$.showCities("#city");
}
