<?php
  require_once '../../config/db.php';

	function deleteProduit($refProd){
		global $db;

		$refProd = htmlspecialchars(trim($refProd));
		$sql = "DELETE FROM produit WHERE id_prod = ?";
		$req = $db->prepare($sql);
		$req->execute([$refProd]);
	}


	if (!empty($_POST['id_prod'])) {
		 $errors = [];
		 extract($_POST);	 
		 	deleteProduit($id_prod);
		 	setFlash('Suppression avec success');
		?>
		<script type="text/javascript">
			window.location.replace('../pages/form_produit.php');
		</script>
		<?php
		 
	} else {
		$errors[] = "Probleme de suppression de produit";
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
