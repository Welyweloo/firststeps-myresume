<!DOCTYPE HTML>
<html>
	
 <head>
      <title>Aurélie ANGLIO</title>
      <link href="./cv_alternance2019.css" type="text/css" rel="stylesheet">
	 
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Playfair+Display&display=swap" rel="stylesheet">
    </head>
    
  <body>
  	
    <div class="titre"><h1>Aurélie ANGLIO, développeuse en devenir !</h1>
    <h3 class="soustitre">Candidate en pleine reconversion professionnelle: <a href="CVAurelie-maj15042020.pdf">CV en PDF</a></h3></div>
    <br>
    
 <!-- Paragraphe de présentation avec une requête GET permettant d'indiquer le prénom, le nom et le sexe du recruteur pour afficher "Bonjour M. ou Mme XXX XXX" -->
<div class="presentation"><p class="bonjour">Bonjour <?php 
	if($_GET['sexe'] === F){
		echo 'Mme' . ' ' . $_GET['prenom'] . ' ' . $_GET['nom'] . ',';

		
	} else if($_GET['sexe'] === M){
		echo 'M.' . ' ' . $_GET['prenom'] . ' ' . $_GET['nom'] . ',';

} else {
	echo ',';} ?>
    
    <p class="accueil">Afin de vous démontrer ma motivation, j'ai décidé de présenter ma lettre de motivation ainsi que mon CV différement, en faisant appel à mes diverses connaissances dans l'univers du développement.  Je souhaite vivement intégrer votre équipe  alors j'espère que vous apprécierez l'expérience, et/ou me ferez un retour sur les points perfectibles.</p>
	<p class="signature">Aurélie</p></div>
	<br>
	
<!-- Une formulaire permettant à l'utilisateur de choisir les parties du CV qu'il souhaite afficher. 
Les informations seront disponibles sur la page _POST. Les noms permettant de recueillir les informations dans des variables POST.
Toutes les valeurs sont précochées/présélectionnés pour diminuer la tâche du recruteur. -->
	<div class="form">
		<h4 class="consigne">Modifiez les informations selon vos attentes :</h4>
		
	<ol>
		<form action="cv_alternance2019_post.php" method="POST">
		 <input type="hidden" id="nom" name="nom" value= "<?php echo $_GET['nom'] ?>">
		 <input type="hidden" id="prenom" name="prenom" value= "<?php echo $_GET['prenom'] ?>">
		 <input type="hidden" id="sexe" name="sexe" value= "<?php echo $_GET['sexe'] ?>">
		 
		<li><p class="question">Souhaitez-vous lire la lettre de motivation que j'ai rédigée à votre attention?</p></li>
		<label for="oui">Oui</label>
		<input type="radio" name="reponse" value="oui" checked="checked">
		<label for="oui">Non</label>
		<input type="radio" name="reponse" value="non">
		<br><br>
		
		<li><p class="question">Choisissez le ou les domaine(s) de formations qui vous intéresse(nt) dans mon parcours:</p></li>
		<label for="general">Général</label>
		<input type="checkbox" name="reponse_formation[]" id="general" value="general" checked="checked" >
		<label for="commerce">Commerce</label>
		<input type="checkbox" name="reponse_formation[]" id="commerce" value="commerce" checked="checked" >
		<label for="back_end">Développement Back-End</label>
		<input type="checkbox" name="reponse_formation[]" id="back_end" value="back_end" checked="checked" >
		<label for="front_end">Développement Front-End</label>
		<input type="checkbox" name="reponse_formation[]" id="front_end" value="front_end" checked="checked" >
		<br><br>
		
		<li><p class="question">Souhaitez-vous voir mes expériences professionnelles?</p></li>
		<select name="xppro[]">
			<option name="xppro[]" id="last" value="last">Oui, la dernière</option>
			<option name="xppro[]" id="2last" value="2last">Oui, les deux dernières</option>
			<option name="xppro[]" id="toutes" value="toutes" selected>Oui, toutes</option>
			<option name="xppro[]" id="aucune" value="aucune">Non, aucune</option>
			</option>
		</select>
		
		<br><br>
		<li><p class="question">Parmi mes compétences, lesquelles vous intéressent?</p></li>
		<label for="linguistiques">Linguistiques</label>
		<input type="checkbox" name="reponse_competence[]" id="linguistiques" value="linguistiques" checked="checked">
		<label for="soft-Skills">Soft-Skills</label>
		<input type="checkbox" name="reponse_competence[]" id="soft_skills" value="soft_skills" checked="checked">
		<label for="hard-Skills">Hard-Skills</label>
		<input type="checkbox" name="reponse_competence[]" id="hard_skills" value="hard_skills" checked="checked">
		<br><br><br>
		
		<li><input type="submit" value="Cliquez ici pour valider vos choix et visionner mon parcours."></input></li>
		
	</ol></div>
		<br>	
		<div class="footer"><p>Cette page web est privée.</p>
		<p>Les informations diffusées visent à présenter les ambitions et le parcours professionnel d'Aurélie ANGLIO à ses futurs employeurs, par le biais de ses acquis en HTML, PHP, CSS et MySQL.</p></div>
	
	
 </body>
</html>