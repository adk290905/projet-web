<?php
	function admission(){
		if(isset($_POST['btn'])){
			//$db->query('INSERT INTO inscription(date_admission, name_admission, id_degree, id_sector) VALUES ("'.$_POST['date'].'", "'.$_POST['nom'].'" ,"'.$_POST['degree'].'", "'.$_POST['sector'].'")');
		}
		$table='admission, degree, sector WHERE admission.id_degree = degree.id_degree AND admission.id_sector = sector.id_sector'; $field='*'; 
		$req =read($table, $field);
		$table='degree'; $field='*'; $rq1=read($table, $field);
		$table='sector'; $field='*'; $rq2=read($table, $field);
		require './view/admission.html';
	}
?>
