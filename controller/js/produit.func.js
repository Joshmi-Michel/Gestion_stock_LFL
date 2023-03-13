$(document).ready(function(){
    //ajout produit
    $("#form01").submit(function(e){
        e.preventDefault();
        var nom_prod = $("#nom_prod").val();
        var qt_prod_detail    = $("#qt_prod_detail").val();
        var prix_detail = $("#prix_detail").val();
        var url = '../controller/produits/setProduits.php ';
        $.post(url,{nom_prod:nom_prod, qt_prod_detail:qt_prod_detail, prix_detail:prix_detail},function(data){
			$('.notifAdd').html(data);
		})
    });
    //editer Produit
    $(".editPr").click(function(e){
        e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');
		var url = '../controller/produits/getProduits.php';
		$.post(url,{id_prod:id},function(data){
			$('.notifEdit').html(data);
		})
    });
    $("#editForm").submit(function(e){
        e.preventDefault();
		var id_prod = $("#id_p").val();
		var nom_prod = $("#nom_p").val();
		var qt_prod_detail = $("#qt_pd").val();
		var prix_detail = $("#prix_d").val();
		var url = '../controller/produits/updateProd.php';
		$.post(url,{id_prod:id_prod, nom_prod:nom_prod, qt_prod_detail:qt_prod_detail, prix_detail:prix_detail},function(data){
			$('.notifUpdate').html(data);
		})
    });
    //DELETE PRODUIT
    $(".delete").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var id = btn.attr('id');
		$("#deleteConfirm").click(function(e){
			e.preventDefault();
			var id_prod = id;
		    var url = '../controller/produits/deleteProduits.php';
		    $.post(url,{id_prod:id_prod},function(data){
			   $('.notifDel').html(data);
		   })
		})
	});
});
