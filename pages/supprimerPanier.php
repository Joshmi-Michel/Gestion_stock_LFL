<?php
   

    if(isset($_GET['qte']) AND isset($_GET['idProPan'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bdd21= new PDO('mysql: host=localhost ; dbname=vente_provande','root','',$pdo_options);
        $req2 = $bdd21->prepare('UPDATE produit set qt_prod_detail=(qt_prod_detail+?) WHERE id_prod=? ');
        $req2->execute(array($_GET['qte'],$_GET['idProPan'] ) );
      }catch(Exception $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>
<?php
    if(isset($_GET['id'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $bd= new PDO('mysql: host=localhost ; dbname=vente_provande','root','',$pdo_options);
        $del = $bd->prepare('DELETE  from commande WHERE id_com=? ');
        $del->execute(array($_GET['id'] ) );
      }catch(Exception $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
?>

<?php
    if(isset($_GET['date'])){
       try{
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $db= new PDO('mysql: host=localhost ; dbname=vente_provande','root','',$pdo_options);
        $drop = $db->prepare('DELETE  from commande WHERE dateAchat=? ');
        $drop->execute(array($_GET['date'] ) );
      }catch(Exception $e){
          die('ERREUR : '.$e->getMessage());
      }
    }
    header("Location:../pages/form_commande.php");
?>


