$(document).ready(function() {
$.ajax({
          url: "{{ route('home')}}",
          method: "GET",
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          success:function(data){
    $.each(data['latest'],function(key, value){
    var cat = value.categoryID;
    var shows = value.prodID;
    var showRef = '/category='+cat+'/show='+shows;
    var srcImg = "{{ URL::to('/') }}/productImg/"+value.thumbnail;

      $('#latestProducts').append(
        $('<li>').attr('class', 'spanProd').append(
          $('<a>').attr('href', showRef).append(
            $('<div>').attr('class', 'thumbnail').append(
              $('<div>').attr('class', 'disImgHome').append(
                $('<img>').attr({'src': srcImg, 'class': 'cimg'})
                )).append(
                $('<div>').attr('class', 'caption').append(
                  $('<p>').text(value.brandName+' - '+value.size))
                ).append(
                $('<div>').attr('class', 'price').append(
                  $('<h5>').text(value.price.toFixed(2)).prepend(
                    $('<span>').text('₱')
                    ))
                ))));
    });

    $.each(data['popular'],function(key, value){
      var cat = value.categoryID;
      var shows = value.prodID;
      var showRef = '/category='+cat+'/show='+shows;
      var srcImg = "{{ URL::to('/') }}/productImg/"+value.thumbnail;

        $('#popularProducts').append(
          $('<li>').attr('class', 'spanProd').append(
            $('<a>').attr('href', showRef).append(
              $('<div>').attr('class', 'thumbnail').append(
                $('<div>').attr('class', 'disImgHome').append(
                  $('<img>').attr({'src': srcImg, 'class': 'cimg'})
                  )).append(
                  $('<div>').attr('class', 'caption').append(
                    $('<p>').text(value.brandName+' - '+value.size))
                  ).append(
                  $('<div>').attr('class', 'price').append(
                    $('<h5>').text(value.price.toFixed(2)).prepend(
                      $('<span>').text('₱')
                      ))
                  ))));
      });
      $.each(data['category'],function(key, value){
        var catID = 'category='+value.id;
        var desc = value.description;


          $('#categoryList').append(
              $('<a>').attr('href', catID).append(
                $('<li>').attr('class', 'catlist').append(
                desc
                )));
        });

          }
      });

$('#cathead').hover(function(){
  $('.catlist').attr('style','display: block;')
});
$('.categorySection').hover(function(){
  $('.catlist').attr('style','display: none;')
});

});
