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
		<p><h3 class="soustitre">Candidate en pleine reconversion professionnelle: <a href="CVAurelie-maj15042020.pdf">CV en PDF</a></h3></p>
	</div>
    <br>
    
 <!-- La lettre de motivation 
 La fonction if permet d'afficher la lettre de motivation si le recruteur a cliqué sur oui. 
 La réponse oui ou non est trouvée grâce à un paramètre POST. 
 S'il a dit non, un message s'affiche, sinon la lettre de motivation est recherchée dans la base de donnée. -->
 
<?php if($_POST['reponse'] === 'oui') {?>
	<?php echo '<div class="lettre_de_motivation"><h3>' . 'Motivations' . '</h3>';
			
			if(!empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['sexe'])){?>
			
			<p><?php if($_POST['sexe'] === 'F'){
						echo 'Mme' . ' ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ',';
						$reponse = $bdd->query('SELECT * FROM lettredemotivation WHERE typelm = "generale"');
						while ($donnees = $reponse->fetch()){ 
						echo '<p align="justify">' . $donnees['paragraphe1'] . '</p><p align="justify">'. $donnees['paragraphe2'] . '</p><p align="justify">'. $donnees['paragraphe3'] . '</p><p align="justify">'. $donnees['paragraphe4'] . '</p><p align="justify">'. $donnees['paragraphe5'] . '</p><p>Aurélie</p>' ;}
		
						} else if($_POST['sexe'] === 'M'){
								echo 'M.' . ' ' . $_POST['prenom'] . ' ' . $_POST['nom'] . ',';
								$reponse = $bdd->query('SELECT * FROM lettredemotivation WHERE typelm = "generale"');
								while ($donnees = $reponse->fetch()){ 
								echo '<p align="justify">' . $donnees['paragraphe1'] . '</p><p align="justify">'. $donnees['paragraphe2'] . '</p><p align="justify">'. $donnees['paragraphe3'] . '</p><p align="justify">'. $donnees['paragraphe4'] . '</p><p align="justify">'. $donnees['paragraphe5'] . '</p><p>Aurélie</p>' ;}
			
			}} else {
				echo 'Madame, Monsieur,';
		?>			<?php $reponse = $bdd->query('SELECT * FROM lettredemotivation WHERE typelm = "generale"');
					while ($donnees = $reponse->fetch()){ 
					echo '<p align="justify">' . $donnees['paragraphe1'] . '</p><p align="justify">'. $donnees['paragraphe2'] . '</p><p align="justify">'. $donnees['paragraphe3'] . '</p><p align="justify">'. $donnees['paragraphe4'] . '</p><p align="justify">'. $donnees['paragraphe5'] . '</p><p>Aurélie</p>' ;
					}}?></p>
	
</div> <?php } else { echo '';}?> 
	<br>

 <!-- Les formations
 La fonction if permet d'afficher les formations sélectionnées par le recruteur. 
 Pour l'affichage, je sélectionne les formations requises dans la base de données et les retourne dans une variable $mescompetences.
Le paramètre POST retourne un tableau qui permet de savoir quelles formations sont demandées par le recruteur. 
J'utilise une requête SQL where pour trouver les formations correspondantes, puis j'utilise l'itération afin d'ajouter les formations au fur et à mesure.
La fontion strpos() me permet d'ajouter en plus du dernier domaine affiché, un autre domaine si le domaine en question est bel et bien dans le tableau.
Les formations doivent apparaitre dans un ordre chronologique décroissant. La fonction fetch() permet de parcourir la base de données jusqu'à ce que la valeur retournée soit FALSE. -->
 
	 <div class="formation"><h3>Formations</h3>
	
<?php 
	if(empty($_POST['reponse_formation'])) {
    	echo "Vous n'avez sélectionné aucun domaine, mais j'ai tout de même un bagage.<br>Vous devriez tenter de nouveau en sélectionnant au moins un domaine!";?>

	<br>
	<p><h3>Cliquez sur le logo pour voir mon profil :</h3>
		<a href="https://www.codecademy.com/profiles/Welyweloo"><img src="codecademy.svg" width="170px" height="40px" alt="Logo Codecademy" /></a></p>
		<a href="https://github.com/Welyweloo"><img src="github.svg" width="170px" height="30px" alt="Logo GitHub" /></a></p>

<?php }

	else {
        $mescompetences = 'SELECT * FROM formations WHERE ';

		if(in_array('general',$_POST['reponse_formation'])){
		$mescompetences =  $mescompetences . 'domaine="Général" ';}
	
		if(in_array('commerce',$_POST['reponse_formation'])){
			if(strpos($mescompetences,"domaine")) { 
			$mescompetences =  $mescompetences . ' OR ';
			}
		$mescompetences =  $mescompetences . 'domaine="commerce" ';
			
		}
	
		if(in_array('back_end',$_POST['reponse_formation'])){
			if(strpos($mescompetences,"domaine")) { 
			$mescompetences =  $mescompetences . ' OR ';
			}
		$mescompetences =  $mescompetences . 'domaine="Dev Back-end" ';
		}
			
		if(in_array('front_end',$_POST['reponse_formation'])){
			if(strpos($mescompetences,"domaine")) { 
			$mescompetences =  $mescompetences . ' OR ';
			}
		$mescompetences =  $mescompetences . 'domaine="Dev Front-end"';
		}
	
	$mescompetences = $mescompetences . 'ORDER BY start_date DESC';

		$reponse = $bdd->query($mescompetences);

		while ($donnees = $reponse->fetch()){ 
		?>
			<p> 
			<?php 
				echo 'Du ' . date('d/m/Y', strtotime($donnees['start_date'])) . ' au ' . date('d/m/Y', strtotime($donnees['end_date']));
			?>
			<br>
			<?php echo '<strong> [' . $donnees['organisme'] . '] </strong>' . $donnees['formation'];?> </p>

		<?php } ?>
		
<!-- Mes profils GITHUB et CodeCademy -->
					
	<br><p><h3>Cliquez sur le logo pour voir mon profil :</h3>
		<a href="https://www.codecademy.com/profiles/Welyweloo"><img src="codecademy.svg" width="170px" height="30px" alt="Logo Codecademy" /></a></p>

	<br>
	
		<a href="https://github.com/Welyweloo"><img src="github.svg" width="170px" height="40px" alt="Logo GitHub" /></a></p>
<?php }?>
	</div>

<br>
<br>

<!-- Le parcours
Pour les formations j'ai utilisé SWITCH afin d'afficher le choix sélectionné par le recruteur pour mon expérience professionnelle. 
Comme pour l'exemple précédent j'utilise la requête query pour sélectionner les bonnes informations dans la base de donnée, 
puis utilise la fonction fetch() pour retourner les bonnes valeurs. 
-->

	 <div class="xppro"><h3>Parcours</h3>
	<?php 
		$_POST['xppro'];

		switch($_POST['xppro']){
    		case in_array('last', $_POST['xppro']) :
    			
			$reponse = $bdd->query('SELECT * FROM xppro ORDER BY start_date DESC LIMIT 1');
				while ($donnees = $reponse->fetch()){?>
				
					<p> <?php echo 'Du ' . date('d/m/Y', strtotime($donnees['start_date'])) . ' au ' . date('d/m/Y', strtotime($donnees['end_date']));?><br>
						<?php echo '<strong> [' . $donnees['entreprise'] . ', ' . $donnees['lieu'] . '] </strong>' . $donnees['poste'];} ?></p>
			<?php break;
			
			case in_array('2last', $_POST['xppro']) :
				
 			$reponse = $bdd->query('SELECT * FROM xppro ORDER BY start_date DESC LIMIT 2');
				while ($donnees = $reponse->fetch()){?>
				
					<p> <?php echo 'Du ' . date('d/m/Y', strtotime($donnees['start_date'])) . ' au ' . date('d/m/Y', strtotime($donnees['end_date']));?><br>
						<?php echo '<strong> [' . $donnees['entreprise'] . ', ' . $donnees['lieu'] . '] </strong>' . $donnees['poste'];} ?></p>
			<?php break;
			
    		case in_array('toutes', $_POST['xppro']) :
 			
 			$reponse = $bdd->query('SELECT * FROM xppro');
				while ($donnees = $reponse->fetch()){?>
				
					<p> <?php echo 'Du ' . date('d/m/Y', strtotime($donnees['start_date'])) . ' au ' . date('d/m/Y', strtotime($donnees['end_date']));?><br>
					<?php echo '<strong> [' . $donnees['entreprise'] . ', ' . $donnees['lieu'] . '] </strong>' . $donnees['poste'];} ?></p>
			<?php break;
			default:
				
        		echo "Dommage... Vous n'avez pas souhaité voir mes expériences professionnelles passées.<br>Peut-être pourrons-nous faire le futur ensemble!";
    		 break;
	}?>
	 </div>
	 <br>
	 
	 
<!-- Les compétences
Pour les compétences j'ai utilisé SWITCH afin d'afficher le choix sélectionné par le recruteur pour mes compétences professionnelles. 
Comme pour l'exemple précédent j'utilise la requête query pour sélectionner les bonnes informations dans la base de donnée, 
puis utilise la fonction fetch() pour retourner les bonnes valeurs. 
Afin d'afficher mon niveau dans les différents domaines, j'ai utilisé la progress bar HTML/CSS créée par Pankaj Parashar : https://css-tricks.com/html5-progress-element/
-->
	
	 <div class="competences">
		<?php 
		$_POST['reponse_competence'];

		switch($_POST['reponse_competence']) {
	
	 case in_array('hard_skills', $_POST['reponse_competence']) :
		echo '<h3>Savoir-faire</h3>';
		
	$reponse = $bdd->query('SELECT * FROM competences WHERE type ="Hard Skills"');
		while ($donnees = $reponse->fetch()) {?>
		
			<div id="progress"> <?php echo $donnees['competences'];?>
    		<progress value="<?php echo $donnees['niveau'];?>" min="0" max="100">0%</progress>
			</div><br>
		<?php }

	case in_array('soft_skills', $_POST['reponse_competence']) :
		echo '<h3>Savoir-être</h3>';
		
	$reponse = $bdd->query('SELECT * FROM competences WHERE type ="Soft Skills"');
		while ($donnees = $reponse->fetch()) {?>
		
			<div id="progress"> <?php echo $donnees['competences'];?>
    		<progress value="<?php echo $donnees['niveau'];?>" min="0" max="100">0%</progress>
			</div><br>
		<?php }

       	case in_array('linguistiques', $_POST['reponse_competence']) :
    		echo '<h3>Langues</h3>';
		
		$reponse = $bdd->query('SELECT * FROM competences WHERE type ="Linguistisque"');
			while ($donnees = $reponse->fetch()) {?>
			
			<div id="progress"> <?php echo $donnees['competences'];?>
    		<progress value="<?php echo $donnees['niveau'];?>" min="0" max="100">0%</progress>
			</div><br>
		<?php }
		
		
	break;
    default:
        
        echo "Vous n'avez sélectionné aucune compétence, pourtant j'en ai quelques unes...";
        break;}?>
	</div>
	
	<br>
	
<!--L'avis du recruteur
Dans le but de m'améliorer, je demande au recruteur de saisir son avis. 
Si celui-ci était déjà identifié grâce au paramètre GET en page 1, il n'a qu'à saisir son avis car un input hidden me permet de récupérer les données. 
Sinon ses informations (prénom, nom, sexe) lui seront demandées (obligatoires) dans le but de lui créer une entrée dans la base de donnée, table utilisateurs.
Les valeurs des paramètres POST du formulaire seront retournées grâce à une requête SQL sur la page _AVIS.-->
	<div class="avis"><h3>Votre retour sur l'expérience:</h3>
		<form action="cv_alternance2019_avis.php" method="POST">
			<textarea id="avis" name="avis" rows="5"cols="105" required></textarea><br>

			<?php if(!empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['sexe'])){?>
						<input type="hidden" id="nom" name="nom" value= "<?php echo $_POST['nom'] ?>">
						<input type="hidden" id="prenom" name="prenom" value= "<?php echo $_POST['prenom'] ?>">
						<input type="hidden" id="sexe" name="sexe" value= "<?php echo $_POST['sexe'] ?>"><br>
		 
			<?php } else {?>
		
						<p>Vous êtes :
							<select name="sexe">
								<option name="sexe" id="sexe" value="F">Une Femme</option>
								<option name="sexe" id="sexe" value="M">Un Homme</option></p></select><br>
		 
						<p><label for="prenom" id="prenom">Votre prénom:</label>
							<input type="text" id="prenom" name="prenom" required></p>
		 
						<p></p><label for="nom" id="nom">Votre nom:</label>	
							<input type="text" id="nom" name="nom" required></p>
		
						 <p></p><label for="email" id="email">Votre e-mail:</label>	
							<input type="text" id="email" name="email" required></p>

					<?php } ?>
					
     		<input type="submit" value="Cliquez ici pour envoyer votre avis."></input><br><br></div>
		</form>
		
	<br>	
	
		<div class="footer"><p>Cette page web est privée.</p>
		<p>Les informations diffusées visent à présenter les ambitions et le parcours professionnel d'Aurélie ANGLIO à ses futurs employeurs, par le biais de ses acquis en HTML, PHP, CSS et MySQL.</p></div>
		
		
		

	
 </body>
</html>