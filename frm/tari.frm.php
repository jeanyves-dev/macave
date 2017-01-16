
<?php

require '../index/header.php';

require '../dao/tari.dao.php';
require '../classe/tari.class.php';
require '../dao/tbsd.dao.php';
require '../classe/tbsd.class.php';

require '../index/conn_db.php';

IF (isset($_GET["retari"]) AND $_GET["retari"] <> 0)
{
	$tari_dao = new tari_dao($db);
	$tari = $tari_dao->get($_GET["retari"]);
}

$tbsd_dao = new tbsd_dao($db);
$mestbsd = $tbsd_dao->getList("tytari");

echo '<form action="../gest/tari.gest.php" method="post">';

echo '<table>';

$rebout = 0;
if (isset($_GET["rebout"]) AND $_GET["rebout"] <> 0)
	{$rebout = $_GET["rebout"];}

IF (isset($_GET["retari"]) AND $_GET["retari"] <> 0)
{
	echo '<tr><td>Référence : </td><td><input type="text" name="retari" maxlength="50" value="'.$tari->retari().'" /></td></tr>';
	echo '<tr><td>Bouteille : </td><td><input type="text" name="rebout" maxlength="50" value='.$rebout.' /></td></tr>';
	echo '<tr><td>Date : </td><td><input type="date" name="datari" maxlength="50" value='.$tari->datar2().' /></td></tr>';
	echo '<tr><td>Montant : </td><td><input type="text" name="mtbout" maxlength="50" value="'.$tari->mtbout().'" /></td></tr>';

	echo "<tr><td>Type tarif : </td><td><select id='tytari' name='tytari'>";
	foreach ($mestbsd as $untbsd)
	{
		if ($untbsd->retbsd() == $tari->tytari())
			{echo '<option value=',$untbsd->retbsd(),' SELECTED>',$untbsd->detbsd(),'</option>';}
		else
			{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
	}
	echo '</select></td></tr>';
}
else
{
	echo '<tr><td>Bouteille : </td><td><input type="text" name="rebout" maxlength="50"  value='.$rebout.' /></td></tr>';
	echo '<tr><td>Date : </td><td><input type="date" name="datari" maxlength="50" /></td></tr>';
	echo '<tr><td>Montant : </td><td><input type="text" name="mtbout" maxlength="50" /></td></tr>';
	
	echo "<tr><td>Type tarif : </td><td><select id='tytari' name='tytari'>";
	foreach ($mestbsd as $untbsd)
		{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
	echo '</select></td></tr>';
}

echo '<tr><td>&nbsp;</td><td><input type="submit" value="Valider" name="Valider" /></td></tr>';
echo '</table>';

echo '</form>';

require '../index/Footer.php';

?>
