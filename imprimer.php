<!DOCTYPE html>
<htlm>
  <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="cachet.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/facture.css">
    <link rel="stylesheet" href="assets/css/w3.css">
    <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
    <script type="text/javascript">
    function validation(frm){
      var txt = document.frm.val.value;
      if(txt!="OK"){
        alert("vous pouvez pas continuer l'inscription");
      }
    }
    function printContent(el){
      var restorepage=document.body.innerHTML;
      var printContent=document.getElementById(el).innerHTML;
      document.body.innerHTML=printContent;
      window.print();
      document.body.innerHTML=restorepage;
    }
    </script>
  </head>
<style>
  table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  font-family:'Courier New', Courier, monospace; 
}
h6{
  font-family:"monoscape";
}

.lettre{
  font-size:18px;
  color:blue;
}
</style>
  <body>
    <div class="bordure"> 
        <div id="div1">
            <h6 align="left">
              Tranombarotra NRJ</br>
              <i>Vente de Produits Locaux et de Provande</i></br>
              NIF:2000 474 129 </br>
              Stat:472.9211000000049 </br>
              Talatamaty FIANARANTSOA 
            </h6>
            <h6 align="right">FACTURE N° : ....................................</h6>
            <h6 align="right">Fianarantsoa le ..................................</h6>
            <h6 align="right">Doit à Mr, Mme :..................................</h6>
                  <table class="table table-bordered table-hover"  border="1px"  width="95%">
                  <thead>
                    <tr>
                      <!-- <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th> -->
                      <th>D&eacute;signation</t>   
                      <th>Quantit&eacute; </th>                 
                      <th>PU</th>
                      <th>Montant</th>                          
                    </tr>
                  </thead>
                  <tbody>                  
                  <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT * FROM commande');
                          while ($donnees=$reponse->fetch())
                          {
                            ?>
                              <tr>
                                  <th><?php echo $donnees['design'] ?></th>
                                  <th><?php echo $donnees['qtAchete'] ?></th>
                                  <th><?php echo $donnees['pu'] ?></th>
                                  <th><?php echo $donnees['montant'] ?></th>
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
                </table>
                <br>
                 <?php
                      try{
                          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                          $bdd = new PDO('mysql:host=localhost;dbname=vente_provande', 'root', '',
                          $pdo_options);
                          $reponse = $bdd->query('SELECT sum(montant) FROM commande');
                          $donnees=$reponse->fetch();
                          echo'<div  class="tot">TOTAL: <strong>'.$donnees['sum(montant)'].' Ariary</strong></div>';
                      }
                          catch(Exception $e)
                          {
                           die('Erreur : '.$e->getMessage());
                      }
                        ?>
                         <?php 
                            require_once 'pages/chiffreEnLettre.php'; 
                            $conversion  = new ChiffreEnLettre();
                            $data = $donnees['sum(montant)'];
                         ?>
            <h6>Arret&eacute; cette pr&eacute;sence facture &agrave; la somme de: &nbsp; <?php echo  '<i class="lettre badge badge-light">'.$conversion->conversion($data).'</i>';?>Ariary</h6>
          <div class="container">
            <div class="row">
              <div class="col-6">
              <p align="left">
                <i>Client</i>
              </p>
            </div>
            <p align="right">
             <i>Responsable</i>
            </p>
            </div>
          </div>
      </div>
        <br><br>
      <button onclick="printContent('div1')" class="imprim w3-amber ion-ios-printer-outline"> Imprimer</button> <a href="javascript:history.back()"><button class="retour ion-ios-close-outline" > Annuler</button></a><br><br>
    </div>
  </body>




    
   
