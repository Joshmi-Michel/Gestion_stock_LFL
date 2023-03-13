<?php   
    require_once '../../config/db.php';

    //insertion produit
    function setProd($nom_prod, $qt_prod_detail, $prix_detail){
        global $db;
        $nom_prod       = htmlspecialchars(trim($nom_prod));
        $qt_prod_detail = htmlspecialchars(trim($qt_prod_detail));
        $prix_detail    = htmlspecialchars(trim($prix_detail));
      
        
        $sql = "INSERT INTO produit(nom_prod, qt_prod_detail, prix_detail) VALUE(?,?,?)";
        $req = $db->prepare($sql);
        $req->execute([$nom_prod, $qt_prod_detail ,$prix_detail]);
    }

    if(!empty($_POST['nom_prod']) && !empty($_POST['qt_prod_detail'])  && !empty(['prix_detail'])){
        $errors = [];
        extract($_POST);
          setProd($nom_prod, $qt_prod_detail ,$prix_detail);
		  setFlash('Ajout avec success');
        ?>
            <script type="text/javascript">
                window.location.replace('../pages/form_produit.php');
            </script>
        <?php
    }else{
        $errors[]="Veuillez remplir tous les champs svp!";
    }
?>
<?php 
   if (!empty($errors)) {
        foreach ($errors as $error) {
        ?>
             <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $error ?>
            </div>
        <?php
        }
    } 
?>