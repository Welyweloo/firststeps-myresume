<?php

$mescompetences = 'SELECT * FROM formations WHERE ';

if(in_array('general',$_POST['reponse_formation'])){
	$mescompetences =  $mescompetences . 'domaine="Général" OR ';}
	
if(in_array('commerce',$_POST['reponse_formation'])){
	$mescompetences =  $mescompetences . 'domaine="commerce" OR ';}
	
if(in_array('back_end',$_POST['reponse_formation'])){
	$mescompetences =  $mescompetences . 'domaine="Dev Back-end" OR ';}
			
if(in_array('back_end',$_POST['reponse_formation'])){
	$mescompetences =  $mescompetences . 'domaine="Dev Front-end"';}
	
echo $mescompetences . 'ORDER BY start_date DESC';

?>