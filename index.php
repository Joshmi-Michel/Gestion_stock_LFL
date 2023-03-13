<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion vente provande</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/w3.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
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
            <a class="nav-link" href="#home"><i class="ion-ios-home-outline"></i> Acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/form_produit.php "><i class="ion-bag"></i> Produits</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/form_commande.php"><i class="ion-android-cart"></i> Commande</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/reaprov.php"><i class="ion-plus"></i> Reaprovisionnement</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/factures.php"><i class="ion-android-attach"></i> Facture</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Se déconnecter" href=" ">
                <span class="ion-log-out" aria-hidden="true"></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="controller/js/produit.func.js"></script>
  <script src="../controller/js/stock.func.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="assets/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="assets/pdfmake/pdfmake.min.js"></script>
  <script src="assets/pdfmake/vfs_fonts.js"></script>
  <script src="assets/jszip/jszip.min.js"></script>
  <script src="assets/pdfmake/vfs_fonts.js"></script>

</body>
</html>