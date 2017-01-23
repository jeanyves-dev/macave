
<?php

require '../index/header.php';

require '../dao/degl.dao.php';
require '../classe/degl.class.php';
require '../dao/degu.dao.php';
require '../classe/degu.class.php';
require '../dao/bout.dao.php';
require '../classe/bout.class.php';
require '../dao/vins.dao.php';
require '../classe/vins.class.php';
require '../dao/coul.dao.php';
require '../classe/coul.class.php';
require '../dao/pays.dao.php';
require '../classe/pays.class.php';
require '../dao/regi.dao.php';
require '../classe/regi.class.php';
require '../dao/appe.dao.php';
require '../classe/appe.class.php';


require '../index/conn_db.php';

$redegl = 0;
$redegu = 0;
$rebout = 0;
$nodegl = "";
$qtdegl = 0;

$bout_dao = new bout_dao($db);
$mesbout = $bout_dao->getList();

echo '<form action="../frm/degl_1.frm.php?redegu='.$_GET["redegu"].'" method="post">';

echo '<table>';
echo '<tr>';
echo '<td>Recherche une bouteille : </td><td><input type="text" name="devins" maxlength="50"/><input type="submit" value="Valider" name="Valider" /></td>';
echo '</tr>';
echo '</table>';

echo '</form>';


if (isset($_POST["devins"]) AND $_POST["devins"] <> '')
{
	$bout_dao = new bout_dao($db);
	$mesbout = $bout_dao->getRech("devins",$_POST["devins"]);
	
	echo '<p>Résultat de la recherche : </p>';
	echo '<form action="../frm/degl_2.frm.php?redegu='.$_GET["redegu"].'" method="post">';
	echo '<input type="submit" value="Valider" name="Valider" />';
	echo '<table cellspacing=0 class="tableListe">';
	echo '<tr>';
	echo '<th class="thListe"></th>';
	echo '<th class="thListe">No</a></th>';
	echo '<th class="thListe">Désignation</a></th>';
	echo '<th class="thListe">Millésime</a></th>';
	echo '<th class="thListe">Pays</a></th>';
	echo '<th class="thListe">Région</a></th>';
	echo '<th class="thListe">Appellation</a></th>';
	echo '<th class="thListe">Couleur</a></th>';
	echo '</tr>';
	if (empty($mesbout))
	{ echo 'pas de vins trouvé !';}
	else
	{
		foreach ($mesbout as $unbout)
		{
			$vins_dao = new vins_dao($db);
			$unvins = $vins_dao->get($unbout->Revins());

			echo '<tr>';
			echo '<td class="tdliste"><input type= "radio" name="rebout" value=',$unbout->Rebout(),'></td>';
			echo '<td class="tdListe">', $unbout->Rebout(), '</td>';
			echo '<td class="tdListe">', $unvins->Devins(), '</td>';
			echo '<td class="tdListe">', $unbout->Anmile(), '</td>';
			echo '<td class="tdListe">', $unvins->Depays($db), '</td>';
			echo '<td class="tdListe">', $unvins->Deregi($db), '</td>';
			echo '<td class="tdListe">', $unvins->Deappe($db), '</td>';
			echo '<td class="tdListe">', $unvins->Decoul($db), '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	echo '</form>';
}

require '../index/footer.php';

?>
