<?php

require '../index/header.php';

require '../classe/util.class.php';
require '../dao/util.dao.php';


require '../index/conn_db.php';

$util_dao = new util_dao($db);
$mesutil = $util_dao->getList();

echo '<p><a href="../frm/util.frm.php?inutil=0">Ajouter un utilisateur</a></p>';

echo '<table border = 1>';
echo '<tr><td class="TitreListe">Initiales</td><td class="TitreListe">Nom</td><td class="TitreListe">Prénom</td><td colspan=2 class="TitreListe">Options</td></tr>';

if (empty($mesutil))
{
  echo "pas d'utilisateur !";
}
else
{
	foreach ($mesutil as $unutil)
	{
		echo '<tr>';
		echo '<td class="CelluleListe">', $unutil->inutil(), '</td>';
		echo '<td class="CelluleListe">', $unutil->noutil(), '</td>';
		echo '<td class="CelluleListe">', $unutil->prutil(), '</td>';
		echo '<td class="CelluleListe"><a href=../frm/util.frm.php?inutil=',$unutil->inutil(),'>Modifier</a></td>';
		echo '<td class="CelluleListe"><a href=../gest/util.gest.php?inutil=',$unutil->inutil(),'&mode=del>Supprimer</a></td>';
		echo '</tr>';
	}
}
echo '</table>';

require '../index/footer.php';

?>
