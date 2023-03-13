<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion vente provande</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/css/w3.css">
  <link rel="stylesheet" href="../assets/css/sweetalert.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
</head>
<body>
<div id="header" class="header">
  <nav id=" " class="navbar navbar-expand-lg navbar-dark text-capitalize">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#show-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="show-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../index.php"><i class="ion-ios-home-outline"></i> Acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_produit.php "><i class="ion-bag"></i> Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_commande.php"><i class="ion-android-cart"></i> Commande</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reaprov.php"><i class="ion-plus"></i> Reaprovisionnement</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="factures.php"><i class="ion-android-attach "></i> Facture</a>
          </li>
          <li class="nav-item pull-right">
          <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Se déconnecter" href=" ">
            <span class="ion-log-out" aria-hidden="true"></span>
          </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
              <div  id="tags" class="w3-tag w3-round w3-dark-gray " style="padding:3px;">
                <div class="w3-tag w3-round w3-dark-gray w3-border w3-border-white">
                  <h4>COMMANDES</h4>
                </div>
              </div> 
            </div><!-- /.col -->
        </div><!-- /.row -->
<!-- card formulaire  -->
<div class="w3-card" id="card">
    <header class="w3-container w3-amber">
      <h4 align="left">
        <span class="ion ion-ios-cart"></span> Panier pour le commande 
      </h4>
     </header>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg"></span>
                <span></span>
            </p>
            <p class="ml-auto d-flex flex-column text-right">
                <span class="text-success"></span>
                <span class="text-muted"></span>
            </p>
        </div>
        <!-- /.d-flex -->
            <table class="table table-bordered dt-responsive nowrap bulk_action">
            <thead>
                <tr>
                    <td>Désignation</td>
                    <td>Quantité acheté</td>
                    <td>Prix Unitaire  (Ar)</td>
                    <td>Montant (Ar)</td>
                    <td>Date d'achat</td>
                    <td>Annuler l'achat</td> 
                </tr>
            </thead>
            <tbody>
            <?php
             try{
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',$pdo_options);
                $reponse = $bdd->query('SELECT * FROM commande');
                $i=0;
                $somme=0;
                while ($donnees=$reponse->fetch()){
                     $i++;
                     $qte=$donnees['qtAchete'];
                     $somme=$somme+$qte;
                       ?>
                    <tr align="center">
                      <td><?php echo $donnees['design'] ?></td>
                      <td><?php echo $donnees['qtAchete']?> </td>
                      <td><?php echo $donnees['pu'] ?></td>
                      <td><?php echo $donnees['montant'] ?></td>
                      <td><span class="badge badge-pill badge-dark"><?=date('d-m-Y à H:i:s',strtotime($donnees['dateAchat'])) ?></span></td>
                      <td> 
<a onclick="return  confirm('Annuler ce Achat?')" href="supprimerPanier.php?$id=<?php echo $donnees['id'] ?>&qte=<?php echo $donnees['qtAchete']  ?>&idProPan=<?php echo $donnees['idProP'] ?>&date=<?php echo $donnees['dateAchat'] ?>" 
         class="btn btn-danger"><i class="ion-ios-close-outline"></i></a>
                      </td>
                   </tr>
                   <?php
                     }
                      }catch(Exception $e){
                         die('Erreur : '.$e->getMessage());
                      }
                    ?>  
            </tbody>
        </table>
        <br>
        <?php echo '<span class="select"><strong><span class="ch">'.$somme.'</span> Kg des produits sont ajoutés | </strong></span>'?>
                  <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM commande');
                         
                          $donnees=$reponse->fetch();
                          if(empty($donnees['sum(montant)'])){
                          echo'<div class="tot"><strong >TOTAL : <span class="ch"> 0 Ariary</span> </strong></div><br>';
                          }else{
                          echo'<div class="tot"><strong >TOTAL : <span class="ch">'.$donnees['sum(montant)'].' Ariary</span> </strong></div>';
                          }
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                  ?>
        <hr>
        <form name="frm" class="frm" action="rupture.php" method="post" onsubmit="return ControlStock()">
            <div class="row">
                    <div class="col-3">
                       <input type="text" id="nomProd" name="design" placeholder="Produit" 
                       value="<?php if(isset($_GET['nom'])){echo $_GET['nom'] ; } ?>" class="form-control" />
                    </div>
                    <div class="col-2">
                       <input type="text" id="pu1" name="prixU" placeholder="Prix" 
                       value="<?php if(isset($_GET['prix'])){echo $_GET['prix'] ; } ?>" class="form-control"/>
                    </div>
                    <div class="col-2">
                       <input type="txt" id="qt1" name="qteAchete" placeholder="Saisir Quantité" class="form-control" onclick="calculmontant()" onkeyup="calculmontant()"   required/>
                    </div>
                    <div class="col-2">
                        <input type="text" id="montant" name="montant1" placeholder="Montant (Ariary)" class="form-control" />
                    </div>
                      <input type="hidden" placeholder="qte produit" id="stock" value="<?php if(isset($_GET['qte'])){echo $_GET['qte'] ; } ?>"/>
                      <input type="hidden" placeholder="id produit" name="idp" id="idProd" value="<?php if(isset($_GET['idPro'])){echo $_GET['idPro'] ; } ?>"/>
                    <div class="col-2">
                      <button type="submit" class="btn btn-warning btn-block"><i class="ion-cash"></i> Acheter</button>
                    </div>
                    <div class="col-1">
                      <button id="vider" type="reset" class="btn btn-danger btn-block"><i class="ion-ios-close-outline"></i></button>
                    </div>
                </div>
            </div><br>
        </form>
    </div>
</div>
<br>
<!-- card tableau  -->
<div class="container">
<div class="w3-card" id="card">
    <header class="w3-container w3-amber">
      <h4><span class="ion ion-ios-cart"></span> Commande produit en Kg</h4>
     </header>
    <div class="card-body">
        <table id="example1" class="table table-bordered dt-responsive nowrap bulk_action">
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th>Quantité en Kg</th>
                    <th>Prix en détail</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php  
                try{
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',$pdo_options);
                  $reponse = $bdd->query('SELECT id_prod,nom_prod,qt_prod_detail,prix_detail FROM produit');
                  $i=0;
                  while ($produits=$reponse->fetch()){
                  $i++;
            ?>
                 <tr align="center">
                    <td><?php echo $produits['nom_prod'] ?></td>
                    <td class=" "><?php echo $produits['qt_prod_detail'] ?>&nbsp;&nbsp;Kg</td>
                    <td><?php echo  $produits['prix_detail'] ?>&nbsp;&nbsp;Ar</td>
                    <td>
  <a href="../pages/form_commande.php?&nom=<?php echo $produits['nom_prod'] ?>&prix=<?php echo $produits['prix_detail'] ?>&qte=<?php echo $produits['qt_prod_detail'] ?>&idPro=<?php echo $produits['id_prod'] ?> ">
                    <button class="btn btn-warning" > <span class="ion ion-ios-cart"></span> Ajouter</button></a>
                    </td>
                 </tr>
            <?php
              }
                }catch(Exception $e){
                  die('Erreur : '.$e->getMessage());
                }
			    	?>
            </tbody>
        </table>
    </div>
</div><br>

</div>
</div>
  <script src="../assets/jquery/jquery.min.js"></script>
  <script src="../controller/js/produit.func.js"></script>
  <script src="../controller/js/stock.func.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../assets/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../assets/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../assets/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="../assets/jquery/sweetalert.js"></script>
  <script src="../assets/pdfmake/pdfmake.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
  <script src="../assets/jszip/jszip.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
        //commande produit Atsinjarany isa-kilao
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //commande produit de gros
        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
  });
  
        function calculmontant(frm){
          var a=parseInt(document.getElementById("pu1").value);
          var b=(document.getElementById("qt1").value);
          var c = a*b;
          document.getElementById("montant").value=c;
        }
        function ControlStock(frm){
          var a=parseInt(document.getElementById("stock").value);
          var b=parseInt(document.getElementById("qt1").value);
          if(a<b){
            swal({title:'Insuffisance du stock !',
                showLoaderOnConfirm:true,
                closeOnConfirm: false,
                type:'warning'
            })
            return false;
          }
        }
        $("#vider").click(function(e){
          e.preventDefault();
            $("#nomProd").val("");
            $("#pu1").val("");
            $("#qt1").val("");
            $("#montant").val("");
        });
</script>
</body>
</html>