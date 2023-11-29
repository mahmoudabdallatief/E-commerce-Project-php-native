$(document).ready(function(){
//  $("html").niceScroll();
var path = window.location.pathname;
    var pageName = path.split("/").pop();
    if (pageName == 'products.php') {
        
    $(window).scroll(function(){
        if($(window).scrollTop() > 80){
            $(".navbar").css({"background-color":"crimson"});   
        }
        else{
            $(".navbar").css({"background-color":"transparent"});
        }

    })
    //   $(".cat").click(function(){

//       $(".cat").removeClass("active");

// $(this).addClass("active"); 
// })
var swiper1 = new Swiper('.slide-con', {
    // Optional parameters
    loop: true,
    // Navigation arrows
    navigation: {
        nextEl: '.sli-next',
        prevEl: '.sli-prev',
    },
  
    autoplay: {
        delay: 5000,
    },
    scrollbar: {
        el: '.swiper-scrollbar',
      },
  
  });

  var session= $(".session").val()
  if(session){
      Swal.fire({
          position: 'top-top',
          icon: 'success',
          title: 'HELLO <span>'+session+'</span><br><br>Login completed successfully',
          
          showConfirmButton: false,
          timer: 2000,
      
        })
  }
}
    
// function typewriter(element, text, delay = 300) {
//   for (let i = 0; i < text.length; i++) {
//     setTimeout(() => {
//       element.innerHTML += text[i];
//     }, delay * i);
//   }
// }

// const el = document.getElementById("typewriter");
// typewriter(el, "E-commerce Website");
if (pageName == 'single.php'){
  
var date= $(".date").val();
if(date){
    var timer = setInterval(function(){
        var countdate = new Date(date).getTime();
        var currentdate = new Date().getTime();
        var counter = countdate - currentdate
        var days = Math.floor(counter/(1000*60*60*24));
        var hours = Math.floor(counter%(1000*60*60*24)/(1000*60*60))
        var minutes =Math.floor(counter%(1000*60*60)/(1000*60))
        var seconds = Math.floor(counter%(1000*60)/(1000))
        
    document.getElementById("days").innerHTML=(days) < 10 ? `0${days}`:days;
    document.getElementById("hours").innerHTML=(hours)< 10 ? `0${hours}`:hours;
    document.getElementById("minutes").innerHTML=(minutes)< 10 ? `0${minutes}`:minutes;
    document.getElementById("seconds").innerHTML=(seconds)<10 ?`0${seconds}` :seconds;
    
    // the end of count down
    if(seconds<0){
        clearInterval(timer);
        // document.getElementById("count").style.display="none";
        document.getElementById("finish").innerHTML=("<p class=' text-center' style='font-size:24px'>The offer is finished</p>");
    
      }
    }
    ,1000)
}
$(".comm").click(function(){
   var pro= $(".pro").val()
   var message= $(".message").val()
    $.ajax({
        url : 'addcomment.php',
        method : 'POST',
        data :{
           pro:pro,
           message:message
        },
        success: function(data){
            if(data==1){
                Swal.fire({
                    position: 'top-top',
                    icon: 'info',
                    title: 'Empty Input Data',
                    showConfirmButton: false,
                    timer: 2000,
                
                  })
            }
            else{
                $(".comment-con").load(location.href + "  .comment")
                // $(".num-row").hide()
                Swal.fire({
                    position: 'top-top',
                    icon: 'success',
                    title: 'The comment has been added successfully',
                    
                    showConfirmButton: false,
                    timer: 2000,
                
                  })
            }
            
        }
        })
        
})
$(document).on("click", ".update", function() {
    var update= $(this).siblings(".inp-update").val()
 
     var message= $("#m"+update+"").val()
      $.ajax({
          url : 'updatecomment.php',
          method : 'POST',
          data :{
            update:update,
             message:message
          },
          success: function(data){
             
             if(data==2){
 
                 Swal.fire({
                     position: 'top-top',
                     icon: 'info',
                     title: 'Empty Input Data',
                     showConfirmButton: false,
                     timer: 2000,
                 
                   })
             }
             else{
                var d =JSON.parse(data)
                 $("#p"+update).html(d.comment)
                 $("#i"+update).html(d.comment)
                 $("#m"+update).html(d.comment);
                var date_update = d.date
                var date1 = new Date(date_update);
var options = {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
  hour: '2-digit',
  minute: 'numeric',
  second: 'numeric'
};
var textWithDayName = date1.toLocaleString('en-US', options);
$("#s"+update+"").html("( "+textWithDayName+" )");
                 Swal.fire({
                     position: 'top-top',
                     icon: 'success',
                     title: 'The comment has been updated successfully',
                     
                     showConfirmButton: false,
                     timer: 2000,
                 
                   })
             }
             
          }
          })
  })
  $(document).on("click", ".delete", function() {
    var deleterow = $(this).attr("data-delete")
    var pro= $(this).siblings(".pro").val()
    console.log(pro)
    
    $.ajax({
        url : 'deletecomment.php',
        method : 'POST',
        data :{
          delete:deleterow,
          pro:pro,
        },
        success: function(data){
            $(".comment-con").load(location.href + "  .comment");
            var d = JSON.parse(data)
            console.log(data)
$("#c"+deleterow+"").fadeOut()
               Swal.fire({
                   position: 'top-top',
                   icon: 'success',
                   title: 'The comment has been deleted successfully',
                   showConfirmButton: false,
                   timer: 2000,
               
                 })
           if( d.num ==0){
            $(".comment").html('<p class="text-center mb-5 h5 num-row" style="color:crimson; ">There is No Comment For This Product</p>')
           }
          
           
        }
        })
  })
$(".star").hover(function(){
    $(this).attr("style","color:gold;")
    $(this).prevAll(".star").attr("style","color:gold;")
    $(this).nextAll(".star").attr("style","color:#fff;")
})


  $(".star").click(function(){
    var pro= $(".product_id").val()
    var index = $(this).attr("data-index");
    $(this).attr("style","color:gold;")
    $(this).prevAll(".star").attr("style","color:gold;")
    $(this).nextAll(".star").attr("style","color:#fff;")
    $.ajax({
        url : 'update_rating.php',
        method : 'POST',
        data :{
            pro_id:pro,
           index:index
        },
        success: function(data){ 
            $(".rate").load(location.href + "  .rate-display")
        }

        })
  })
  $(".small_img").click(function(){
    $(".small_img").removeClass("gallery");

$(this).addClass("gallery")

})
$(".small_img").hover(function(){
    $(".small_img").removeClass("gallery");

$(this).addClass("gallery")

})
$(".small_img").hover(function(){
    $(".big_img").attr('src', $(this).attr('src'
    ))
 })

 $(".small_img").click(function(){
    $(".big_img").attr('src', $(this).attr('src'
    ))

 })
// $(".star").mouseleave(function(){
//     $(this).attr("style","color:#fff;")
//     $(this).prevAll(".star").attr("style","color:#fff;")
//     $(this).nextAll(".star").attr("style","color:#fff;")
// })

}
// Get the button:
let mybutton = document.querySelector(".myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 25 || document.documentElement.scrollTop > 25) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

}
topFunction();

        
        if (pageName == 'single.php' || 'chart.php'){
            $('.dec-btn').click(function () {
            
                var siblings = $(this).siblings('.num');
                if (parseInt(siblings.val(), 10) > 1) {
                    siblings.val(parseInt(siblings.val(), 10) - 1);
                }
            });
      
            $('.inc-btn').click(function () {
             
                    var siblings = $(this).siblings('.num');
                    var num =$(this).siblings('.num').val();
                    var max = $(this).siblings('.max').val();
                    if(+max>+num){
                       
                siblings.val(parseInt(siblings.val())+1);
                
                
                }
          
            });
        }
        
        if (pageName == 'chart.php'  ){

            $(".send").click(function() {

                var quantity = $(this).siblings(".num").val();
                var price = $(this).siblings(".price").val();
                var id1 = $(this).siblings(".id").val();
            
                var send = $(this).siblings(".send").html();
            
                try {
                    $.ajax({
                        url: 'updatachart.php',
                        method: 'POST',
                        data: {
                            quantity: quantity,
                            price: price,
                            id: id1,
                            action: send
                        },
                        success: function(data) {
                            console.log(data);
                            var d = JSON.parse(data);
                            console.log(d);
                            $("#a" + id1 + "").html("<b class='text-light'>Total :</b> " + d.total + " $.");
                            $(".tot").html(d.sum + " $.");
            
                        }
                    });
                } catch (e) {
                    console.log(e);
                }
            });
            
            $(".btn-del").click(function(){
                var delid = $(this).siblings(".delid").val()
                console.log(delid)
                $.post('deletefromcart.php',{
                    delid :delid
                },function(dt){
                    console.log(dt)
                   $("#h"+delid+"").fadeOut()
                   var dis = JSON.parse(dt)
                   $(".tot").html(dis.sum+" $.")
                   if(dis.sum== null){
                    $(".tot").html("0 $.")
                   }
                   $("#co").html(dis.count+ ' <i class="fa-solid fa-cart-shopping   d-inline-block"></i>')
                   if(dis.count==0){
                    $(".cart-con").html('<p class="text-center w-100 p-3" style="background-color:crimson; color:gold;border-radius:25px;box-shadow: 1px 1px 5px #969191fa, -1px -1px 5px #969191fa;border:1px solid gold;">No Products Added To Cart</p>')
                    $(".delall").hide()
                    $(".coupon-item").html(" <br><br><br>")
                   }
            })
        })
     
   
  
        
        $('#checkout-Form').submit(function(event) {
            event.preventDefault(); // Prevent form submission
            var billing_name =$("#billing_name").val()
            var billing_address =$("#billing_address").val()
            var billing_city =$("#billing_city").val()
            var billing_state =$("#billing_state").val()
            var billing_zip =$("#billing_zip").val()
            var shipping_name =$("#shipping_name").val()
            var shipping_address =$("#shipping_address").val()
            var shipping_city =$("#shipping_city").val()
            var shipping_state =$("#shipping_state").val()
            var shipping_zip =$("#shipping_zip").val()
            // Serialize form data
         
            var formData = $(this).serialize();
           
           
            // Submit the form using AJAX
            $.ajax({
              url: "checkout.php",
              type: 'POST',
              data: formData,
              success: function(response) {
                console.log(response)
                if(response==1){
                  window.location.href = 'orders.php';
                }
                if(response==2){
                    if(billing_name ==''){
                        
                        $(".name_err").html('<br><div class="alert alert-danger text-danger p-2">The billing name is required</div>')
                    }
                    else {
         
                        $(".name_err").html('');
                      }
                   
                  if(billing_address== ''){
                  $(".address_err").html('<br><div class="alert alert-danger text-danger p-2">The billing address is required</div>')
              }
              else{
                  $(".address_err").html('')
              }if(billing_city== ''){
                $(".city_err").html('<br><div class="alert alert-danger text-danger p-2">The billing city is required</div>')
            }
            else{
                $(".city_err").html('')
            }if(billing_state== ''){
              $(".state_err").html('<br><div class="alert alert-danger text-danger p-2">The billing state is required</div>')
          }
          else{
              $(".state_err").html('')
          }
          if(billing_zip == '') {
            $(".zip_err").html('<br><div class="alert alert-danger text-danger p-2">The billing zip is required</div>')
          } else if (isNaN(parseInt(billing_zip))) {
            $(".zip_err").html('<br><div class="alert alert-danger text-danger p-2">The billing zip must be integer</div>')
          } else {
            $(".zip_err").html('')  
          }
        if(shipping_name== ''){
          $(".shipping_name_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping name is required</div>')
      }
      else{
          $(".shipping_name_err").html('')
      }
      if(shipping_address== ''){
        $(".shipping_address_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping address is required</div>')
    }
    else{
        $(".shipping_address_err").html('')
    }
    if(shipping_city== ''){
      $(".shipping_city_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping city is required</div>')
  }
  else{
      $(".shipping_city_err").html('')
  }
  if(shipping_state== ''){
    $(".shipping_state_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping state is required</div>')
}
else{
    $(".shipping_state_err").html('')
}
if(shipping_zip== ''){
  $(".shipping_zip_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping zip is required</div>')
}
else if (isNaN(parseInt(shipping_zip))) {
    $(".shipping_zip_err").html('<br><div class="alert alert-danger text-danger p-2">The shipping zip must be integer</div>')
  }
else{
  $(".shipping_zip_err").html('')
}
          
                }
            
              }
            });
          });
          
          
        
          
        
        }
        if (pageName == 'contact.php'){
            $(".contact-form").submit(function(e){
                e.preventDefault()
                var name =$(".name").val()
                var number =$(".number").val()
                var email =$(".email").val()
                var message =$(".message").val()
                $.post("addmessage.php",{
                    name : name,
                    number : number,
                    email : email,
                    message : message,
                },function(data){
                    console.log(data)
                    if(data==1 ){
                        Swal.fire({
                            position: 'top-top',
                            icon: 'success',
                            title: 'The message has been sent successfully',
                            
                            showConfirmButton: false,
                            timer: 2000,
                        
                          })
                    }
                    if(name==""){
                        $(".name-err").html('<div class="alert alert-danger text-danger p-2">The Name is Empty</div>')
                    }
                    else{
                        $(".name-err").html('')
                    }
                    if(number==""){
                        $(".number-err").html('<div class="alert alert-danger text-danger p-2">The Number is Empty</div>')
                    }
                    else if( data == '<input type = "hidden" value ="2">'|| data=='<input type = "hidden" value ="1"><input type = "hidden" value ="2">'){
                        $(".number-err").html('<div class="alert alert-danger text-danger p-2">The Number is Not Valid</div>')
                    }
                    else{
                        $(".number-err").html('')
                    }
                    
                    if(message==""){
                        $(".message-err").html('<div class="alert alert-danger text-danger p-2">The Message is Empty</div>')
                    }
                    else{
                        $(".message-err").html('')
                    }
                    if(email==""){
                        $(".email-err").html('<div class="alert alert-danger text-danger p-2">The Email is Empty</div>')
                    }
                    
                  
                     else if( data == '<input type = "hidden" value ="1">'|| data=='<input type = "hidden" value ="1"><input type = "hidden" value ="2">'){
                        $(".email-err").html('<div class="alert alert-danger text-danger p-2">The Email is Not Valid</div>')
                    }
                    
                    else{
                        $(".email-err").html('')
                    }
                    if(data == 1 ){
                        $(".name").val("")
                        $(".email").val("")
                        $(".number").val("")
                        $(".message").val("")
                     }
                })
            })
        }
        $('#search-query').keyup(function() {
            var search_query = $(this).val();
            $('#search-results').attr("style", "display:block; ")
            var z = 1;
            $.ajax({
              type: 'POST',
              url: 'search.php',
              data: {search_query: search_query},
              dataType: 'JSON',
              success: function(data) {
                console.error()
                $('#search-results').empty();
                if (data.length > 0) {
                  $.each(data, function(i, result) {
                    var text = result.name;
                    var length = 35;
                    if(text){
                        var truncatedText = text.slice(0, length);
                        $('#search-results').append('<li class="list-search w-100"><a href="single.php?id=' + result.id + '" class="text-decoration-none search-link" style="color:#fff;"><span> - </span>' + truncatedText + '<span> (' + result.cat + ')</span></a></li>');
                    }
                   
                    
                  });
                } if(data.length == 0) {
                  $('#search-results').html('<li class="list-search text-center w-100">No Results Found</li>');
                }
              },
            //   error: function(xhr, status, error) {
            //     alert(xhr.responseText);
            //   }
            });
          
            if (search_query == '') {
                $('#search-results').attr("style", "display:none;")
            }
          });
      
 })

 