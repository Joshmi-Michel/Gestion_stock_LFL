<?php
   if(isset($_POST['design']) AND isset($_POST['qteAchete']) AND isset($_POST['prixU']) AND isset($_POST['montant1']) AND isset($_POST['idp'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd= new PDO('mysql: host=localhost ; dbname=vente_provande','root','',$pdo_options);
        $req = $bdd->prepare('INSERT INTO commande(design ,qtAchete,pu, montant, dateAchat , idProP) VALUES(?,?,?,?,NOW(),?)');
        $req->execute(array($_POST['design'] ,$_POST['qteAchete'], $_POST['prixU'] , $_POST['montant1'], $_POST['idp'] ) );
      }catch(Exception $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>
<?php
    if(isset($_POST['qteAchete']) AND isset($_POST['idp'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd2= new PDO('mysql: host=localhost ; dbname=vente_provande','root','',$pdo_options);
        $req2 = $bdd2->prepare('UPDATE produit set qt_prod_detail=(qt_prod_detail-?) WHERE id_prod=? ');
        $req2->execute(array($_POST['qteAchete'],$_POST['idp'] ) );
      }catch(Exception $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
   header("Location:../pages/form_commande.php")
?>
