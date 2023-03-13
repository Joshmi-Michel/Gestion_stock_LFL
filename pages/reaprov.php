<?php include ('../config/db.php');?>
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
  <link rel="stylesheet" href="../assets/css/w3.css">
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
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
        <div class="row mb-2">
            <div class="col-sm-6">
              <div  id="tags" class="w3-tag w3-round w3-dark-gray" style="padding:3px">
                <div class="w3-tag w3-round w3-dark-gray w3-border w3-border-white">
                  <h3>REAPROVISIONNEMENT</h3>
                </div>
              </div> 
            </div><!-- /.col -->
        </div><!-- /.row -->
     <div class="col-12">
     <?php if (!empty($_SESSION['flash'])):?>
            <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?= $_SESSION['flash']['message'] ?>
            </div>
            <?php unset($_SESSION['flash']) ?>
            <?php endif; ?>
     </div>
<br>
    <div class="row">
        <div class="col-md-12 col-sm-12">
           <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Faire un Réaprovisionnement</button>
        </div>
    </div>
<br>

<!-- card tableau  -->
<div class="container">
<div class="w3-card " id="card">
    <header class="w3-container w3-amber">
      <h4>Réaprovisionnement</h4>
    </header>
    <div class="card-body">
        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>Désignation</th>
                
                    <th>Quantité ajouté</th>
                    <th>Prix Unitaire /kg</th>
                    <th>Date d'approvisionement</th>
                </tr>
            </thead>
            <tbody>
            <?php  
                try{
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',$pdo_options);
                  $reponse = $bdd->query('SELECT 
                        produit.id_prod, 
                        produit.nom_prod, 
                        produit.prix_detail,
                        aprov.qtAp,
                        aprov.dateAp
                  FROM produit
                  JOIN aprov
                  ON produit.id_prod =aprov.prodAp');
                  $i=0;
                  while ($produits=$reponse->fetch()){
                  $i++;
            ?>
                 <tr align="center">
                    <td><?php echo $produits['nom_prod'] ?></td>
                    <td><?php echo  $produits['qtAp']?> Kg</td>
                    <td><?php echo  $produits['prix_detail'] ?> Ar</td>
                    <td><span class="badge badge-pill badge-dark"> <?php echo  $produits['dateAp'] ?></span></td>
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
</div>
</div>
</div>
<!-- MODAL AJOUT PRODUIT -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header w3-amber">
        <h4 class="modal-title" id="myModalLabel">Ajout d'un nouveau produit</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="notifAdd"></div>
        <form id="stockForm" method="post">
          <div class="form-group">
           <select id="id_prod" class="form-control">
           <option selected disabled>--- Séléctioner le produit ---</option>
           <?php 
              try{
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',$pdo_options);
                $reponse = $bdd->query('SELECT * FROM produit ORDER BY nom_prod ASC');
                $i=0;
                while ($produits=$reponse->fetch()){
                $i++;
           ?>
            <option value="<?php echo $produits['id_prod'] ?>"><?php echo $produits['nom_prod'] ?></option>
            <?php
              }
                }catch(Exception $e){
                  die('Erreur : '.$e->getMessage());
                }
			    	?>
           </select>
          </div>
          <div class="form-group">
            <input type="text" name="qtAp" class="form-control" id="qtAp" placeholder="Quantité ajouté">
          </div>
          <div class="form-group">
            <input type="hidden" name="date_aprov" class="form-control" id="date_aprov" placeholder="date aprovisionnement">
          </div>         
          </div>
          <div class="modal-footer">
            <div class="row">
                <div class="col-6">
                    <button type="submit" id="btn" class="btn btn-warning "><i class="fa fa-save"></i> Enregistrer</button>
                </div>
                <div class="col-6">
                    <button id="close" type="button" class="btn btn-danger"><i class="fa fa-times" data-dismiss="modal"></i> Annuler</button>
                </div>
          </form>
            </div>
            </div>
          </div>
    </div>
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
  <script src="../assets/pdfmake/pdfmake.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
  <script src="../assets/jszip/jszip.min.js"></script>
  <script src="../assets/pdfmake/vfs_fonts.js"></script>
  <script>
   $(document).ready(function(){
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
      });
        //   close modal ajouter
        $("#close").click(function(e){
          e.preventDefault();
          $("#addNew").modal('hide');
        })
</script>
</body>
</html>