function search(){
    
var DATA = document.getElementById("search");    
var element = document.getElementsByClassName("city");

if(DATA.value){
for (i = 0; i < element.length; i++) {
    if(element[i].innerText==DATA.value){
    
    if(i>2){
    element[i-2].scrollIntoView();
    }
    else if(i==2){
    element[1].scrollIntoView();
    }
    else{   
    window.scrollTo(0, 0); 
    }
    break;
    }
       }
if(i==element.length){

alert("element do not exist");



}}}


$(document).ready(function(){
    $(".menu").click(function(){
    
    
        $(".sidebar").fadeToggle()
      
    
    
    
    })

    $($(".fav").get()).click(function(){
        $(this).data('clicked', true);
      
   
     var i=0;
     
     while(i<$(".favo").length)
    {   
     
     if ($($(".fav").get(i)).data('clicked')) {
         var d=$(".city").get(i).innerText;
         $($(".fav").get(i)).removeData('clicked');
         break;
     }
       
     i++; 
    }
    $('#sav').val(d);
    $('#sav').trigger('click');

    }) 
    })  
  
      
    
  
    
    
    