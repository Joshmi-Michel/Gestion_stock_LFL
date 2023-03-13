<?php 
   require_once '../../config/db.php';

    function reaprov($id_prod ,$qtAp){
       global $db;

       $id_prod     = htmlspecialchars(trim($id_prod));
	   $qtAp        = htmlspecialchars(trim($qtAp));
  

       $sql ="UPDATE produit SET qt_prod_detail =(qt_prod_detail + ?) WHERE id_prod = ?";
       $req = $db->prepare($sql);
       $req->execute([$qtAp, $id_prod]);

       $db->exec("INSERT INTO aprov (qtAp , dateAp , prodAp) VALUES('$qtAp',NOW(),'$id_prod')");
    }
    if (!empty($_POST['id_prod']) && !empty($_POST['qtAp'])) {
        $errors = [];
        extract($_POST);	 
            reaprov($id_prod ,$qtAp);
            setFlash('Réaprovisionnement faite avec success');
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
