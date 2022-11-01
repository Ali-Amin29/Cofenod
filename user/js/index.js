$(document).ready(function(){




$(".scroll a").click(function(){
  // targt a id
$ids= $(this).attr('href');
event.preventDefault();


$('html, body').animate({
  scrollTop: $($ids).offset().top
}, 1500);


});




$(window).scroll(function(){
  var scroll = $(window).scrollTop();
  if (scroll > 600) {
    $("nav").css("background" , "black");
    $("nav li a").css("color","#FFF");
    $("nav li img").css("background","black");
    $(".scroll").css("display","block");
    }
    
  else{
      $("nav").css("background" , "");  
      $("nav li a").css("color","#FFFFF7");
      $(".scroll").css("display","none");
    
  }
})

    $(".ali").hover(function(){

      $(this).children('a').first().toggle();
      // $(this).siblings('.desc').toggle();

    });
    var xx=[];


    $(".Add_to_cart").on('click',function(e){
        e.preventDefault();
        $(this).css("display","inline-block");
        $(this).css('left','30px');
        $(this).css('background-color','black');
        $(this).css('color','#fff');
        $(this).next().css("display","inline-block");
        $(this).next().css("background-color","#286090");
        $(this).children('i').css("display","inline-block");
        var x=$(this).attr('value')
   
       xx.push(x);
      //  window.localStorage.setItem('user', JSON.stringify(xx));
      
       var json_str = JSON.stringify(xx);
      
       $.cookie('bookableDates', json_str);

    });


    $("#id").on('click',function(){
 
console.log($(this));
      // $(".show_cart").css("display","inline-block");

  });
    $(".Add_to_cart").on('dblclick',function(e){
      e.preventDefault();
      $(this).next().css("display","none");
      $(this).css('left','90px');
      $(this).css('background-color','black');

      $(this).css('color','#FFF');

       $(this).children('i').css("display","none");



      // $(".show_cart").css("display","inline-block");

      var v=$(this).attr('value');
   
 
      

      
const result = xx.filter(checkAdult);

// function checkAdult(v) {
//   return v ;
//  }
 
 
//  var newArray = xx.filter((value)=>value!=x);
 

  });

  //  ///////////////////////////////////////////////////////////////////////

  // $(".myAnchor").on('click',function(e){
  //   e.preventDefault();
     
  //   alert($(this).attr('value'));

  //   $('#jwt').html($(this).attr('value'));

  // });

 console.log(xx);

});

