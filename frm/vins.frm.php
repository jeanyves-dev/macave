<?php

require '../index/header.php';

require '../classe/vins.class.php';
require '../classe/pays.class.php';
require '../classe/regi.class.php';
require '../classe/appe.class.php';
require '../classe/prod.class.php';
require '../classe/coul.class.php';
require '../classe/typv.class.php';
require '../classe/clas.class.php';
require '../classe/gaba.class.php';
require '../classe/tbsd.class.php';
require '../dao/vins.dao.php';
require '../dao/pays.dao.php';
require '../dao/regi.dao.php';
require '../dao/appe.dao.php';
require '../dao/prod.dao.php';
require '../dao/coul.dao.php';
require '../dao/typv.dao.php';
require '../dao/clas.dao.php';
require '../dao/gaba.dao.php';
require '../dao/tbsd.dao.php';

require '../index/conn_db.php';

$pays_dao = new pays_dao($db);
$mespays = $pays_dao->getList();
$regi_dao = new regi_dao($db);
$appe_dao = new appe_dao($db);
$prod_dao = new prod_dao($db);
$mesprod = $prod_dao->getList();
$coul_dao = new coul_dao($db);
$mescoul = $coul_dao->getList();
$typv_dao = new typv_dao($db);
$mestypv = $typv_dao->getList();
$clas_dao = new clas_dao($db);
$mesclas = $clas_dao->getList();

$revins = 0;
$devins = "";
$cuvins = "";
$devinb = "";
$repays = 0;
$reregi = 0;
$reappe = 0;
$reprod = 0;
$recoul = 0;
$retypv = 0;
$reclas = 0;
$favori = FALSE;

echo '<form action="../gest/vins.gest.php" method="post">';

echo '<table border=1>';

echo '<tr><td class="tdTitreCadreFrm">Identification</td><td class="tdTitreCadreFrm">Situation géographique</td></tr>';

echo '<tr><td>';

// Identification
echo '<table>';
IF ($_GET["revins"] <> 0)
{
	$vins_dao = new vins_dao($db);
	$vins = $vins_dao->get($_GET["revins"]);
	
	$revins = $vins->Revins();
	$devins = $vins->Devins();
	$cuvins = $vins->Cuvins();
	$devinb = $vins->Devinb();
	$repays = $vins->Repays();
	$reregi = $vins->Reregi();
	$reappe = $vins->Reappe();
	$reprod = $vins->Reprod();
	$recoul = $vins->Recoul();
	$retypv = $vins->Retypv();
	$reclas = $vins->Reclas();
	$favori = $vins->Favori();
	
	echo '<tr><td>Référence : </td><td><input type="text" name="revins" maxlength="50" value="'.$vins->revins().'" /></td></tr>';
}
echo '<tr><td>Nom : </td><td><input type="text" name="devins" value="'.$devins.'" maxlength="50" /></td></tr>';
echo '<tr><td>Cuvée : </td><td><input type="text" name="cuvins" value="'.$cuvins.'" maxlength="50" /></td></tr>';
echo '<tr><td>Autres libellé : </td><td><input type="text" name="devinb" value="'.$devinb.'" maxlength="50" /></td></tr>';
echo '</table>';
/* Fin identification */

echo '</td><td>';

/* Zone géographique */
echo '<table>';
echo '<tr><td>Pays</td><td><select id="repays"  name="repays" STYLE="width:100%">';
foreach ($mespays as $unpays)
{
	if ($unpays->repays() == $repays)
	{echo '<option value=',$unpays->repays(),' SELECTED>',$unpays->depays(),'</option>';}
	else
	{echo '<option value=',$unpays->repays(),'>',$unpays->depays(),'</option>';}
}
echo '</select></td><td><input type="text" name="depays" maxlength="50" /></td></tr>';

echo '<tr><td>Région</td><td><select id="reregi" name="reregi" STYLE="width:100%">';
foreach ($mespays as $unpays)
{	
	{echo '<option value=0>---',$unpays->depays(),'---</option>';}
	$mesregi = $regi_dao->getListPays($unpays->repays());
	foreach ($mesregi as $unregi)
	{
		if ($unregi->reregi() == $reregi)
		{echo '<option value=',$unregi->reregi(),' SELECTED>&nbsp;&nbsp;&nbsp;&nbsp;',$unregi->deregi(),'</option>';}
		else
		{echo '<option value=',$unregi->reregi(),'>&nbsp;&nbsp;&nbsp;&nbsp;',$unregi->deregi(),'</option>';}
	}
}
echo '</select></td><td><input type="text" name="deregi" maxlength="50" /></td></tr>';

echo '<tr><td>Appellation</td><td><select id="reappe" name="reappe" STYLE="width:100%">';
foreach ($mespays as $unpays)
{	
	{echo '<option value=0>---',$unpays->depays(),'---</option>';}
	$mesregi = $regi_dao->getListPays($unpays->repays());
	foreach ($mesregi as $unregi)
	{
		echo '<option value=0>&nbsp;&nbsp;&nbsp;&nbsp;--',$unregi->deregi(),'--</option>';
		$mesappe = $appe_dao->getListRegi($unregi->reregi());
		foreach ($mesappe as $unappe)
		{
			if ($unappe->reappe() == $reappe)
			{echo '<option value=',$unappe->reappe(),' SELECTED>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$unappe->deappe(),'</option>';}
			else
			{echo '<option value=',$unappe->reappe(),'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$unappe->deappe(),'</option>';}
		}
	}
}
echo '</select></td><td><input type="text" name="deappe" maxlength="50" /></td></tr>';
echo '</table>';
/* Fin zone géographique */

echo '</td></tr>';

echo '<tr><td class="tdTitreCadreFrm">&nbsp;</td><td class="tdTitreCadreFrm">&nbsp;</td></tr>';
echo '<tr><td class="tdTitreCadreFrm">Autres informations</td><td class="tdTitreCadreFrm">Producteur</td></tr>';

echo '<tr><td>';

/* Autres informations */
echo '<table>';
echo '<tr><td colspan=2>&nbsp;</td></tr>';
echo '<tr><td>Couleur</td><td><select id="recoul" name="recoul" STYLE="width:100%">';
foreach ($mescoul as $uncoul)
{
	if ($uncoul->recoul() == $recoul)
	{echo '<option value=',$uncoul->recoul(),' SELECTED>',$uncoul->decoul(),'</option>';}
	else
	{echo '<option value=',$uncoul->recoul(),'>',$uncoul->decoul(),'</option>';}
}
echo '</select></td><td><input type="text" name="decoul" maxlength="50" /></td></tr>';

echo '<tr><td>type de vin</td><td><select id="retypv" name="retypv" STYLE="width:100%">';
foreach ($mestypv as $untypv)
{
	if ($untypv->retypv() == $retypv)
	{echo '<option value=',$untypv->retypv(),' SELECTED>',$untypv->Detypv(),'</option>';}
	else
	{echo '<option value=',$untypv->retypv(),'>',$untypv->Detypv(),'</option>';}
}
echo '</select></td><td><input type="text" name="detypv" maxlength="50" /></td></tr>';

echo '<tr><td>Classement</td><td><select id="reclas" name="reclas" STYLE="width:100%">';
foreach ($mesclas as $unclas)
{
	if ($unclas->reclas() == $reclas)
		{echo '<option value=',$unclas->reclas(),' SELECTED>',$unclas->Declas(),'</option>';}
	else
		{echo '<option value=',$unclas->reclas(),'>',$unclas->Declas(),'</option>';}
}
echo '</select></td><td><input type="text" name="declas" maxlength="50" /></td></tr>';

if ($favori == 0)
	{echo '<tr><td>Favoris</td><td><input type="checkbox" name="favori" value=0></td></tr>';}
else
	{echo '<tr><td>Favoris</td><td><input type="checkbox" name="favori" value=1 CHECKED></td></tr>';}

echo '</table>';

echo '</td>';
/* Fin autres informations */

echo '<td>';

/* Producteur */
echo '<table>';
echo '<tr><td colspan=2>&nbsp;</td></tr>';
echo '<tr><td>&nbsp;</td><td><select id="reprod" name="reprod" STYLE="width:100%">';
foreach ($mesprod as $unprod)
{
	if ($unprod->reprod() == $reprod)
	{echo '<option value=',$unprod->reprod(),' SELECTED>',$unprod->deprod(),'</option>';}
	else
	{echo '<option value=',$unprod->reprod(),'>',$unprod->deprod(),'</option>';}
}
echo '</select></td></tr>';

IF ($_GET["revins"] == 0)
{
	$tbsd_dao = new tbsd_dao($db);
	$mestbsd = $tbsd_dao->getList("typrop");
	echo "<tr><td>Propriété : </td><td><select id='typrop' name='typrop'>";
	foreach ($mestbsd as $untbsd)
		{echo '<option value=',$untbsd->retbsd(),'>',$untbsd->detbsd(),'</option>';}
	echo '</select></td></tr>';

	echo '<tr><td>Nom : </td><td><input type="text" name="deprod" maxlength="50" /></td></tr>';
	echo '<tr><td>Adresse 1 : </td><td><input type="text" name="adresa" maxlength="100" /></td></tr>';
	echo '<tr><td>Adresse 2 : </td><td><input type="text" name="adresb" maxlength="100" /></td></tr>';
	echo '<tr><td>Code postal : </td><td><input type="text" name="codpos" maxlength="10" /></td></tr>';
	echo '<tr><td>Ville : </td><td><input type="text" name="villep" maxlength="50" /></td></tr>';
	echo '<tr><td>Mail : </td><td><input type="text" name="admail" maxlength="50" /></td></tr>';
	echo '<tr><td>Web : </td><td><input type="text" name="adrweb" maxlength="50" /></td></tr>';
}

echo '</table>';

echo '</td></tr>';
/* Fin producteur */

echo '<tr><td class="tdTitreCadreFrm">&nbsp;</td><td class="tdTitreCadreFrm">&nbsp;</td></tr>';
echo '<tr><td class="tdTitreCadreFrm">Bouteilles</td><td class="tdTitreCadreFrm">Image</td></tr>';


/* Bouteilles */
echo '<tr><td>';

IF ($_GET["revins"] == 0)
{
	$gaba_dao = new gaba_dao($db);
	$mesgaba = $gaba_dao->getList();
	echo '<table>';
	echo '<tr><td colspan=2>&nbsp;</td></tr>';
	echo '<tr><td>Gabarit</td><td><select id="regaba" name="regaba">';
	foreach ($mesgaba as $ungaba)
	{
		echo '<option value=',$ungaba->regaba(),'>',$ungaba->degaba(),'</option>';
	}
	echo '</select></td></tr>';
	echo '<tr><td>Millésime : </td><td><input type="text" name="anmile" value=0 maxlength="10" /></td></tr>';
	echo '<tr><td>Apogé : </td><td><input type="text" name="anapog" value=0 maxlength="10" /></td></tr>';
	echo '<tr><td>A boire avant : </td><td><input type="text" name="anaboi" value=0 maxlength="10" /></td></tr>';
	echo '<tr><td>Note (/20) : </td><td><input type="text" name="bonote" value=0 maxlength="10" /></td></tr>';
	echo '<tr><td>Degrès alcool : </td><td><input type="text" name="degres" value=0 maxlength="10" /></td></tr>';
	echo '</table>';
}

echo '</td>';
/* Fin bouteille */

/* Image */
echo '<td>';

echo 'Image : <input name="imvins" type="file" />';

echo '</td></tr>';
/* Fin Image */

/* Validation */
echo '<tr><td>';
echo '<input type="submit" value="Valider" name="Valider" /><input type="reset" value="Annuler" name="Annuler" />';
echo '</td></tr>';
/* Fin Validation */


echo '</tr></table>';

echo '</form>';

require '../index/footer.php';
?>

