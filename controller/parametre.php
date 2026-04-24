<?php
	function parametre(){
		$lib=''; $id='';
		if(isset($_POST['btn']) && $_POST['btn'] == 'add'){
			$table = $_POST['parametre']; $field='lib_'.$_POST['parametre']; $value = '"'.$_POST['lib'].'"';
			insert($table, $field, $value);
		}elseif(isset($_POST['btn']) && $_POST['btn']== 'update'){
			$table = $_POST['parametre']; $field = 'lib_'.$_POST['parametre'].'="'.$_POST['lib'].'"'; $condition = 'id_'.$_POST['parametre'].'="'.$_POST['key'].'"';
			update($table, $field, $condition);
		}
	
		if(isset($_GET['task']) && $_GET['task'] == 'Modif'){
			$tab = json_decode(urldecode($_GET['data']), true);
			$lib = $tab['lib_'.$_GET['table']]; $id = $tab['id_'.$_GET['table']];
 
		}elseif(isset($_GET['task']) && $_GET['task'] =='supp'){
			$table = $_GET['table']; $condition='id_'.$_GET['table'].'="'.$_GET['id'].'"';
			delete($table, $condition);
		}
		require './view/parametre.html';
	}	
?>
	