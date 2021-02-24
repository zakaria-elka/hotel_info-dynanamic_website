$(document).ready(function () {
    $("tbody td button").click(function () {
     
        var $td = $(this).closest("button"); 
       
        var val = $td.text();
        

        $('#sav').val(val);
        $('#sav').trigger('click');
       
    });

    $($("tbody td .fav").get()).click(function () {
      $(this).data('clicked', true);
     
      var i=0;
     while(i<$("tbody td .fav").length)
    {   
     
     if ($($(".fav").get(i)).data('clicked')) {
         $($(".fav").get(i)).removeData('clicked');
         break;
     }
     i++;
    }
    var d=$("button").get(i).innerText;
    $('#sav1').val(d);
    $('#sav1').trigger('click');

    
    
  
  });

  




});