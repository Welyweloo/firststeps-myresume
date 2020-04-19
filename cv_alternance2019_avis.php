<!-- Cette requête permet d'appeler la base de données contenant toutes les informations de mon CV.
La fonction die vérifie s'il y a une erreur sur la page et doit renvoyer un message expliquant cette dernière. -->  

<?php
	try
	{
		$bdd = new PDO('mysql:host=**********;dbname=**********;charset=utf8', '**********', '**********');
	}
	catch (Exception $e)
	{
        die('Erreur : ' . $e->getMessage());
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
      <title>Le parcous d'Aurélie</title>
	  <link href="./cv_alternance2019_post.css" type="text/css" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Playfair+Display&display=swap" rel="stylesheet">
    </head>
    
	<body>
    	<div class="titre"><h1>Aurélie ANGLIO, développeuse en devenir !</h1>
			
<!--Dans de paragraphe je remercie le recruteur en l'identifiant grâce aux 
informations recueillies sur la page précédente à l'aide du paramètre POST.
Avec la requête sql UPDATE, je mets à jour l'avis du recruteur sur l'entrée qui le concerne dans la table utilisateur.
Avec la requête sql INSERT INTO, je crée une entrée pour le recruteur. La fonction addslashes me permet d'ajouter un anti slash
à chaque fois que l'utilisateur utilise une quote, sinon cela pertuberait mon code SQL et PHP, et j'utilise la fonction
htmlspecialchars pour éviter la faille XSS qui me préserve des caractères saisies par l'utilisateur qui pertuberaient mon code HTML.-->
			<p><h3 class="soustitre">Merci <?php 
  
		if($_POST['sexe'] === 'F'){
			
			$sexe = addslashes($_POST['sexe']);
			$prenom = addslashes($_POST['prenom']);
			$nom = addslashes($_POST['nom']);

			echo 'Mme' . ' ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ',';

				
		} else if($_POST['sexe'] === 'M'){
			echo 'M.' . ' ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ',';
			
		} else {
			echo ',';} ?> d'avoir pris le temps d'aller jusqu'au bout.</h3><a href="moncv2019.pdf">CV en PDF</a></p></div>
   
    <br>

<?php 

		if(isset($_POST['nom']) & isset($_POST['prenom']) & isset($_POST['sexe']) & isset($_POST['avis'])){
			if(isset($_POST['email'])) {
	
				$email = addslashes($_POST['email']);
				$avis = addslashes($_POST['avis']);
				$query = 'INSERT INTO utilisateurs(sexe, prenom, nom, email, avis) VALUES(\'' . $sexe . '\', \''. $prenom . '\', \'' . $nom . '\', \'' . $email . '\', \'' . $avis . '\')';
	
				$bdd->exec(htmlspecialchars($query));

				
			} else {	
	
	$query = 'UPDATE utilisateurs SET avis = \'' . $avis . '\' WHERE upper(nom) = upper( \'' . $nom . '\') and upper(prenom) = upper(\'' . $prenom . '\')';
	$bdd->exec(htmlspecialchars($query));
			} 
		}?>    

	
	</body>
</html>