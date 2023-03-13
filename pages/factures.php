<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion vente provande</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/css/w3.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<style type="text/css">
  #tbl{
    background:white;
  }
</style>
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
            <a class="nav-link" href="factures.php"><i class="ion-android-attach"></i> Facture</a>
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
<!-- page content -->
   <div id="headerPrint" style="display: none">
    <h4>liste transaction</h4>
  </div>
  <div class="right_col" role="main">
    <div class="">           
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <?php if (!empty($_SESSION['flash'])):?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $_SESSION['flash']['message'] ?>
            </div>
            <?php unset($_SESSION['flash']) ?>
          <?php endif; ?>
<br>
          <div class="x_panel">
            <div class="x_title">
                  <h3>FACTURE</h3>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">        
               <table id ="tbl" width="98%" border="1px" class="table table-hover table-bordered dt-responsive nowrap">
                  <thead  text-align="center">
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <td>Qté Acheté en Kg</td>
                      <td>Désignation</td>                    
                      <td>PU</td>
                      <td>montant</td>    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT * FROM commande');
                         $i=0;
                         $somme=0;
                          while ($donnees=$reponse->fetch()){
                            $i++;
                            $qte=$donnees['qtAchete'];
                            $somme=$somme+$qte;
                            ?>
                                 <tr>
                                  <td><?php echo $donnees['qtAchete'] ?> </td>
                                  <td><?php echo $donnees['design'] ?></td>
                                  <td><?php echo $donnees['pu'] ?></td>
                                  <td><?php echo $donnees['montant'] ?> 
                                  </td>
                               </tr>
                            <?php
                          }   
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                  ?>  
                  </tbody>                    
                  <tfoot> <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM commande');
                          $donnees=$reponse->fetch();
                          if(empty($donnees['sum(montant)'])){
                          echo'<div class="toto"><strong color="black">TOTAL : <span class="ch"> 0 Ariary</span> </strong></div>';

                          }else{
                          echo'<div class="toto"><strong color="black">TOTAL : <span class="ch">'.$donnees['sum(montant)'].' Ariary</span> </strong></div>';
                          }
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                        ?>
                  </tfoot>
                </table><br>
                <div class="col-md-12 col-sm-12">
                    <a href="../imprimer.php"><button  type="button" class="btn btn-warning" data-toggle="modal" ><span class="ion-ios-printer-outline"></span> IMPRIMER FACTURE</button>
                    </a>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="../assets/jquery/jquery.min.js"></script>
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
  <script src="../assets/pdfmake/pdfmake.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
  <script src="../assets/jszip/jszip.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
</body>
</html>

            

