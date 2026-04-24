<?php
	$lib=''; $id='';
	$db= new PDO('mysql:host=127.0.0.1;dbname=parametre','root','');
	if(isset($_POST['btn']) && $_POST['btn'] == 'add'){
		$db->query('insert into '.$_POST['parametre'].'(lib_'.$_POST['parametre'].') values("'.$_POST['lib'].'")');
	}elseif(isset($_POST['btn']) && $_POST['btn']== 'update')
	{
		$db -> query('update '.$_POST['parametre'].' set lib_'.$_POST['parametre'].' = "'.$_POST['lib'].'" where id_'.$_POST['parametre'].' = "'.$_POST['key'].'" ');
	}
	

	if(isset($_GET['task']) && $_GET['task'] == 'Modif')
	{
		$tab = json_decode(urldecode($_GET['data']), true);
		$lib = $tab['lib_'.$_GET['table']]; $id = $tab['id_'.$_GET['table']];
 
	}elseif(isset($_GET['task']) && $_GET['task'] =='supp')
	{
		$db -> query('delete from '.$_GET['table'].' where id_'.$_GET['table'].' = "'.$_GET['id'].'" ');
	}
	$menu='<ul>';
	$menu.='<li>scolarité</li>';
	$menu.='<li>examen</li>';
	$menu.='<li>admission</li>';
	$menu.='<li id="current">parametres</li>';
	$menu.='<li>deconnexion</li>';
	$menu.='</ul>';
	ob_start();
?>
<h2>Paramètres</h2>
<ul>
	<li>lien1</li>
	<li>lien2</li>
	<li>lien3</li>
</ul>
<form method="POST" action="parametre.php" >
	<input type = "hidden" name = "key" value = "<?=$id ?>" /> 
	<input type="text" name="lib" placeholder="libellé" value="<?=$lib?>" />
	<select name="parametre">
		<?php
			$op = (isset($_GET['task']) && $_GET['task'] =='Modif')? '<option selected>'.$_GET['table'].'</option>' : '<option value="" selected disabled>Parametres</option>';
			echo $op;
		?>
		<option>degree</option>
		<option>course</option>
		<option>profil</option>
	</select><br/>
	<input type="submit" name="btn" value="add"/> 
	<input type="submit" name="btn" value="update"/> 
 </form>

<?php
	$list = ['degree', 'course', 'profil'];
	for($i = 0; $i<sizeof($list); $i++){
		$req = $db -> query('select * from '.$list[$i].'');
		echo '<h2>'.$list[$i].'</h2>';
		if($req -> rowCount() != 0)
		{
			echo '<table border="1" width="1000" cellpadding="10">';
			while($dt = $req -> fetch())
			{
				echo'<tr>';
				echo '<td width="32" align="center"><a href="parametre.php?task=supp&id='.$dt['id_'.$list[$i]].'&table='.$list[$i].'">&cross;</a></td>';
				echo '<td width="32" align="center"><a href="parametre.php?task=Modif&table='.$list[$i].'&data='.urlencode(json_encode($dt)).'">Modifier</a></td>';
				echo '<td>'.$dt['lib_'.$list[$i]].'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	}
	$content=ob_get_clean();
	require "template.html";
?> 




