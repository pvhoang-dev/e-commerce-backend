$(document).ready(function(){
    $(".nav-sidebar .nav-item").click(function(){
          var src = ($(this).children().children().children(".right").attr('src')=='images/image.png')
          ?'images/Vector1.png'
          : 'images/image.png';
          console.log(src);
          $(this).children().children().children(".right").attr("src",src);
        var target = $(this).children(".sub-menu");
        $(target).slideToggle();
    });
    $(".user-panel .arrow-right").click(function(e){
        e.preventDefault();
        var navContact = $(this).parent().children('.nav-contact');
        if (navContact.css("display") == 'none') {
            navContact.css("display", "block");
        } else {
            navContact.css("display", "none");
        }
    });
    $(".pic-more").click(function(e){
        e.preventDefault();
        var action = $(this).parent().children('.list-action');
        if (action.css("display") == 'none') {
            action.css("display", "block");
        } else {
            action.css("display", "none");
        }
    });
   
    $('.filter-group .nav-item').click(function() {
        $('.filter-group .nav-item').removeClass('active');
        $(this).addClass('active');
      });
});