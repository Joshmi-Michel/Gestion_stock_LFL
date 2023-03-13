$(document).ready(function(){
    $("#stockForm").submit(function(e){
        e.preventDefault();

        var id_prod = $("#id_prod").val();
        var qtAp    = $("#qtAp").val();
      
        var url = '../controller/stock/reaprov.php';
        $.post(url,{id_prod:id_prod,qtAp:qtAp},function(data){
            $('.notifAdd').html(data);
        });
    });


})