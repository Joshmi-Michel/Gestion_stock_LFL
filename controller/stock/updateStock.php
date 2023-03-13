<?php 
   require_once '../../config/db.php';

   function updateproduit($id_prod, $nom_prod, $qt_prod_detail, $prix_detail){
    global $db;
    $id_prod = htmlspecialchars(trim($id_prod));
    $nom_prod = htmlspecialchars(trim($nom_prod));
    $qt_prod_detail = htmlspecialchars(trim($qt_prod_detail));
    $prix_detail = htmlspecialchars(trim($prix_detail));

    $sql = "UPDATE produit SET nom_prod = ?, qt_prod_detail = ?, prix_detail = ? WHERE id_prod =? ";
		$req = $db->prepare($sql);
		$req->execute([$nom_prod, $qt_prod_detail, $prix_detail,	$id_prod]);
   }
   if (!empty($_POST['id_prod']) && !empty($_POST['nom_prod']) && !empty($_POST['qt_prod_detail']) && !empty($_POST['prix_detail'])){
    $errors = [];
    extract($_POST);	 
        updateproduit($id_prod, $nom_prod, $qt_prod_detail, $prix_detail);
        setFlash('Mise à jour avec success');
    ?>
    <script type="text/javascript">
       window.location.replace('../pages/reaprov.php');
    </script>
      <?php
    } else {
       $errors[] = "Veuillez remplir tous les champs";
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