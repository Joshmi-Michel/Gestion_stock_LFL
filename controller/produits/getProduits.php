<?php 
  require_once '../../config/db.php';
  function getProduit($id_prod){
    global $db;
    $id_prod =htmlspecialchars(trim($id_prod));
    $sql="SELECT * FROM produit WHERE id_prod= ?";
    $req=$db->prepare($sql);
    $req->execute([$id_prod]);
    $results =[];
    while ($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
  }
  if (!empty($_POST['id_prod'])) {
		$errors = [];
		extract($_POST);	 
		$donnees = getProduit($id_prod);
    foreach ($donnees as $donnee) {}
	?>
     <div class="form-group">
            <input type="hidden" name="refProd" class="form-control" id="id_p" value="<?= $donnee->id_prod ?>">
          </div>
          <div class="form-group">
          	<label for="designEd">Désignation</label>          
            <input type="text" name="nom_prod" class="form-control" id="nom_p" value="<?= $donnee->nom_prod ?>">
          </div>
          <div class="form-group">
          	<label for="qteEd">Quantité en détail</label>          
            <input type="txt" name="qt_prod_d" class="form-control" id="qt_pd" value="<?= $donnee->qt_prod_detail ?>">
          </div>
          <div class="form-group">
          	<label for="puEd">Prix de détail (Ariary)</label>          
            <input type="text" name="pu_det" class="form-control" id="prix_d" value="<?= $donnee->prix_detail ?>">
          </div>          
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
