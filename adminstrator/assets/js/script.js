$(document).ready(function(){
    var path = window.location.pathname;
    var pageName = path.split("/").pop();
    if (pageName == 'dashboard.php') {
    var sess= $(".sess").html()
    Swal.fire({
        position: 'top-top',
        icon: 'success',
        title: 'HELLO <span>'+sess+'</span><br><br>Login completed successfully',
        showConfirmButton: false,
        timer: 2000,
      })  
    }
   var hidden = $(".hidden").val()
     if(hidden==1){
        Swal.fire({
            position: 'top-top',
            icon: 'success',
            title: 'The record has updated successfully',
            showConfirmButton: false,
            timer: 2000,
          })
    }
    if(hidden==2){
       Swal.fire({
           position: 'top-top',
           icon: 'success',
           title: 'The record has deleted successfully',
           showConfirmButton: false,
           timer: 2000,
      
         })  
        }
    if(hidden==3){
        Swal.fire({
            position: 'top-top',
            icon: 'success',
            title: 'The record has added successfully',
            showConfirmButton: false,
            timer: 2000,
       
          })  
         }  
    $(".navbar-toggler").click(function(){
        $("#sidebarMenu").toggle()
    })
$('#example').DataTable();
$(".page-item").addClass("item")
$(".item").click(function(){

    $(this).addClass("active"); 
    $(".item").removeClass("active");


})
if (pageName == 'index.php' || pageName=='admin.php') {
  $(".eye-icon").click(function(){
    var eye = $(".pass").attr("type")
    if(eye=="password"){
$(".pass").attr("type","text")
    }
    if(eye=="text"){
        $(".pass").attr("type","password")
            }
 })
}

 if (pageName == 'message.php') {
$(".btn-del").click(function(){
  

  var id =  $(this).siblings(".delid").val()
   $.post('./sql/readmessage.php',{
    delid:id
   },function (data){
    var d =JSON.parse(data)
      $(".message").html(d.count)
    $("#m"+id+"").html(d.view)
    $("#z"+id+"").html(d.date)
    Swal.fire({
      position: 'top-top',
      icon: 'success',
      title: 'The message has been read successfully ',
      showConfirmButton: false,
      timer: 2000,
 
    })  
   })

})

 }
 if(pageName != 'message.php'){
  setInterval(function(){
    $(".message").load('./sql/countmessage.php #u')
  },5000)
 }
 if (pageName == 'admin.php') {
  
  $(".addadmin").click(function(){
   
   
      var admin =$(".admin").val()
      var passWord =$(".password").val()
      var priv =$("#priv").val()
      $.post('./sql/addnewadmin.php',{
          admin:admin,
          password:passWord,
          priv:priv,
         },function(data1){
         
      
          $("#example").load(location.href + "  .tt,.hh")
                    
            // rest of the code
        
          console.log(data1)
          if(data1==2){
            Swal.fire({
            position: 'top-top',
            icon: 'info',
            title: 'Empty Input Data',
            showConfirmButton: false,
            timer: 2000,
       
          }) 

          }
         else{
            Swal.fire({
              position: 'top-top',
              icon: 'success',
              title: 'The record has added successfully',
              showConfirmButton: false,
              timer: 2000,
          
            }) 
          }
         })
  })
   }
})


 