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
require '../classe/bout.class.php';
require '../classe/mvel.class.php';
require '../classe/mvsl.class.php';
require '../classe/gaba.class.php';
require '../classe/rang.class.php';
require '../classe/trie.class.php';
require '../classe/cepa.class.php';
require '../classe/cepv.class.php';
require '../classe/tari.class.php';
require '../dao/vins.dao.php';
require '../dao/pays.dao.php';
require '../dao/regi.dao.php';
require '../dao/appe.dao.php';
require '../dao/prod.dao.php';
require '../dao/coul.dao.php';
require '../dao/typv.dao.php';
require '../dao/clas.dao.php';
require '../dao/bout.dao.php';
require '../dao/mvel.dao.php';
require '../dao/mvsl.dao.php';
require '../dao/gaba.dao.php';
require '../dao/rang.dao.php';
require '../dao/trie.dao.php';
require '../dao/cepa.dao.php';
require '../dao/cepv.dao.php';
require '../dao/tari.dao.php';

require '../index/conn_db.php';

/* Gestion du tri et du sens de la liste des vins */
$order_champ = "";
$order_sens  = "";

/* Gestion du tri et du sens de la liste des vins */
$trie_dao = new trie_dao($db);
$untrie = $trie_dao->getTabl("vins");
$order_champ = $untrie->Champs();
$order_sens  = $untrie->Senstr();

/* Vins bouteille et cepages */
$vins_dao = new vins_dao($db);
$cepv_dao = new cepv_dao($db);
$coul_dao = new coul_dao($db);
$regi_dao = new regi_dao($db);
$pays_dao = new pays_dao($db);
$mesbout_dao = new bout_dao($db);
$ListeCepv = "";

echo '<p class="pTitreListe">Les vins<hr></p>';

echo '<table class="tableEnteteListe"><tr>';
echo '<td class="tdLienAjouter"><a class="LienMenuGauche" href="../frm/vins.frm.php?revins=0">Ajouter un vin</a></td>';
echo '</tr></table>';


// Liste des couleurs
$mescoul = $coul_dao->getList();
echo '<table>';
echo '<tr>';
foreach ($mescoul as $uncoul)
	{echo '<td><a href="vins.liste.php?refrec='.$uncoul->Recoul().'&type=coul">'.$uncoul->Decoul().'</td>';}
echo '</tr>';
echo '</table>';

// Liste des Regions
$mespays = $pays_dao->getList();
echo '<table>';
foreach ($mespays as $unpays)
{
	$mesregi = $regi_dao->getListPays($unpays->Repays());
	echo '<tr>';
	foreach ($mesregi as $unregi)
		{echo '<td><a href="vins.liste.php?refrec='.$unregi->Reregi().'&type=regi">'.$unregi->Deregi().'</td>';}
	echo '</tr>';

}
echo '</table>';

echo '<table width=100%>';
echo '<tr>';
echo '<td style="vertical-align:top;">';

$r = chr(13);
$compteur = 0;

$refrec = 1;
IF (isset($_GET['refrec']))
	{$refrec = $_GET['refrec'];}

// Récupération de la liste des vins selon critères
switch ($_GET['type'])
{
    case "coul":
		$mesvins = $vins_dao->getListCoul($order_champ,$order_sens,0,0,$refrec);
        break;
		
    case "regi":
		$mesvins = $vins_dao->getListRegi($order_champ,$order_sens,0,0,$refrec);
        break;
	
	default:
		$mesvins = $vins_dao->getList($order_champ,$order_sens,0,0);
		break;
}

/* Entète du tableau */
echo '<table cellspacing=10 class="tableListe">';
echo '<tr>';

$compteur = 0;

/* Lignes du tableau */
foreach ($mesvins as $unvins)
{
	/* Compteur pour nombre de vins par ligne */
	IF (($compteur % 2) == 0)
	{echo '</tr><tr>';}
	$compteur = $compteur + 1;
	
	/* Liste des cépages */
	$ListeCepv = "";
	$mescepv = $cepv_dao->getList($unvins->Revins());
	foreach ($mescepv as $uncepv)
		{$ListeCepv = $ListeCepv.$uncepv->Decepa($db).", ";}

	/* Une cellule de vins */
	echo '<td class="tdListeVins">';
	
	/* Libellé du vin */
	$libvin = $unvins->Devins();
	IF ($unvins->Cuvins() <> "")
		{$libvin = $libvin ." - ". $unvins->Cuvins();}
	IF ($unvins->Devinb() <> "")
		{$libvin = $libvin ." - ". $unvins->Devinb();}
	echo '<div width=100% align=center><b>'.$libvin.'</b></div><hr>';
	
	echo '<table width=100% border=1>';
	echo '<tr>';
	
	/* Image */
	/*echo '<td width=20%>';
	echo '<img src="../img/vins/'.$unvins->Imvins().'">';
	echo '</td>';*/
	
	/* Données géographique */
	echo '<td width=40%>';
	echo '<table><tr><td><img src="../img/globe.jpg"></td><td>'.$unvins->Depays($db).' - '.$unvins->Deregi($db).'<br>'. $unvins->Declas($db) .' '. $unvins->Deappe($db).'</td></tr>';
	echo '<tr><td><img src="../img/cepage.jpg"></td><td>'.$unvins->Detypv($db).' '.$unvins->Decoul($db).' <br>'. $ListeCepv.'</td></tr></table>';
	echo '</td>';

	/* Bouteilles et milésimes */
	$mesbout = $mesbout_dao->getListeVins($unvins->Revins());
	$StockTot = 0;
	foreach ($mesbout as $unbout)
	{
		$StockTot = $StockTot + $unbout->QtStock($db);
	}
	echo '<td style="vertical-align:top;" width=40%>';
	echo '<table>';
	echo '<tr><td colspan = 3>Bouteilles ('.$StockTot.') :</td></tr>';
	foreach ($mesbout as $unbout)
	{
		IF ($unbout->Anmile() == 0)
			{$Anmile = "nc";}
		ElSE
			{$Anmile = $unbout->Anmile();}
		echo '<tr>';
		echo '<td>'.$Anmile.'</td>';
		echo '<td>'.$unbout->QtStock($db).'</td>';
		echo '<td>'.$unbout->TarAvg($db).'€</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '</td>';
	
	echo '</tr>';
	echo '</table>';
	
	echo '<br><hr>';
	echo '<table width=100%><tr>';		
	echo '<td align=right>';
	echo '<a href=../fiche/vins.fiche.a.php?revins=',$unvins->Revins(),'&rebout=0><img src="../img/Info.png"></a>';
	echo '<a href=../frm/vins.frm.php?revins=',$unvins->Revins(),'><img src="../img/Edit.png"></a>';
	echo '<a href=../gest/vins.gest.php?revins=',$unvins->Revins(),'&mode=del><img src="../img/Delete.png"></a>';
	echo '</td>';
	echo '</tr></table>';
	echo '</td>';
	
}

echo '</tr>';
echo '</table>';

echo '</td>';
echo '</tr>';
echo '</table>';

require '../index/footer.php';

?>
