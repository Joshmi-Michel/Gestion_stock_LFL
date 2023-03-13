<?php
  require_once '../../config/db.php';
   
  function getProduit($id_prod){
    global $db;

    $id_prod =  htmlspecialchars(trim($id_prod));
   
    $sql="SELECT * FROM produit WHERE id_prod= ?";
    $req=$db->prepare($sql);
    $req->execute([$id_prod]);
    $results =[];
    while ($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
  }
?>