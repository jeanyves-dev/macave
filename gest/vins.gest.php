<?php

require '../classe/vins.class.php';
require '../classe/pays.class.php';
require '../classe/regi.class.php';
require '../classe/appe.class.php';
require '../classe/prod.class.php';
require '../classe/coul.class.php';
require '../classe/typv.class.php';
require '../classe/clas.class.php';
require '../classe/bout.class.php';
require '../dao/vins.dao.php';
require '../dao/pays.dao.php';
require '../dao/regi.dao.php';
require '../dao/appe.dao.php';
require '../dao/prod.dao.php';
require '../dao/coul.dao.php';
require '../dao/typv.dao.php';
require '../dao/clas.dao.php';
require '../dao/bout.dao.php';

require '../index/conn_db.php';

$vins_dao = new vins_dao($db);
$bout_dao = new bout_dao($db);

$revins = 0;

if ($_GET['mode'] == "del")
{
	$vins_dao->delete($_GET['revins']);
}
else
{
	if (isset($_POST['devins']))
	{
		
		$repays = $_POST['repays'];
		$reregi = $_POST['reregi'];
		$reappe = $_POST['reappe'];
		$reprod = $_POST['reprod'];
		$recoul = $_POST['recoul'];
		$retypv = $_POST['retypv'];
		$reclas = $_POST['reclas'];
		
		IF (isset($_POST['imvins']))
			{$imvins = $_POST['imvins'];}
		else
			{$imvins = "";}
		
		if (isset($_POST['favori']))
			{$favori = 1;}
		else
			{$favori = 0;}
		
		if (isset($_POST['depays']) AND $_POST['depays'] <> "")
		{
			$pays_dao = new pays_dao($db);
			$donnees  = array('depays'=>$_POST['depays']);
			$pays     = new pays($donnees);
			$pays_dao->add($pays);
			$pays     = $pays_dao->getLast();
			$repays   = $pays->Repays();
		}
		
		if (isset($_POST['deregi']) AND $_POST['deregi'] <> "")
		{
			$regi_dao = new regi_dao($db);
			$donnees  = array('deregi'=>$_POST['deregi'],'repays'=>$repays);
			$regi     = new regi($donnees);
			$regi_dao->add($regi);
			$regi     = $regi_dao->getLast();
			$reregi   = $regi->Reregi();
		}
		
		if (isset($_POST['deappe']) AND $_POST['deappe'] <> "")
		{
			$appe_dao = new appe_dao($db);
			$donnees  = array('deappe'=>$_POST['deappe'],'reregi'=>$reregi);
			$appe     = new appe($donnees);
			$appe_dao->add($appe);
			$appe     = $appe_dao->getLast();
			$reappe   = $appe->Reappe();
		}
		
		if (isset($_POST['deprod']) AND $_POST['deprod'] <> "")
		{
			$prod_dao = new prod_dao($db);
			$donnees  = array('deprod' =>$_POST['deprod'],'adresa' =>$_POST['adresa'],'adresb' =>$_POST['adresb'],'codpos' =>$_POST['codpos'],'villep' =>$_POST['villep'],'typrop' =>$_POST['typrop'],'admail' =>$_POST['admail'],'adrweb' =>$_POST['adrweb']);
			$prod     = new prod($donnees);
			$prod_dao->add($prod);
			$prod     = $prod_dao->getLast();
			$reprod   = $prod->Reprod();
		}
		
		if (isset($_POST['decoul']) AND $_POST['decoul'] <> "")
		{
			$coul_dao = new coul_dao($db);
			$donnees  = array('decoul'=>$_POST['decoul']);
			$coul     = new coul($donnees);
			$coul_dao->add($coul);
			$coul     = $coul_dao->getLast();
			$recoul   = $coul->Recoul();
		}
		
		if (isset($_POST['detypv']) AND $_POST['detypv'] <> "")
		{
			$typv_dao = new typv_dao($db);
			$donnees  = array('detypv'=>$_POST['detypv']);
			$typv     = new typv($donnees);
			$typv_dao->add($typv);
			$typv     = $typv_dao->getLast();
			$retypv   = $typv->Retypv();
		}
		
		if (isset($_POST['declas']) AND $_POST['declas'] <> "")
		{
			$clas_dao = new clas_dao($db);
			$donnees  = array('declas'=>$_POST['declas']);
			$clas     = new clas($donnees);
			$clas_dao->add($clas);
			$clas     = $clas_dao->getLast();
			$reclas   = $clas->Reclas();
		}
		
		/* Vins */
		if (isset($_POST["revins"]) AND $_POST["revins"] <> 0)
		{
			$donnees  = array('revins'=>$_POST['revins'],
							  'devins'=>$_POST['devins'],
							  'repays'=>$repays,
							  'reregi'=>$reregi,
							  'reappe'=>$reappe,
							  'reprod'=>$reprod,
							  'recoul'=>$recoul,
							  'favori'=>$favori,
							  'retypv'=>$retypv,
							  'reclas'=>$reclas,
							  'cuvins'=>$_POST['cuvins'],
							  'devinb'=>$_POST['devinb'],
							  'imvins'=>$imvins);
							  
			$vins     = new vins($donnees);
			$vins_dao->update($vins);
			$revins = $_POST['revins'];
		}
		else
		{
			$donnees  = array('devins'=>$_POST['devins'],
							  'repays'=>$repays,
							  'reregi'=>$reregi,
							  'reappe'=>$reappe,
							  'reprod'=>$reprod,
							  'recoul'=>$recoul,
							  'favori'=>$favori,
							  'retypv'=>$retypv,
							  'reclas'=>$reclas,
							  'cuvins'=>$_POST['cuvins'],
							  'devinb'=>$_POST['devinb'],
							  'imvins'=>$imvins);
							  
			$vins     = new vins($donnees);
			$vins_dao->add($vins);
			$vins     = $vins_dao->getLast();
			$revins   = $vins->Revins();
			
			/* Bouteille */
			$donnees  = array('revins'=>$revins,
							  'regaba'=>$_POST['regaba'],
							  'anmile'=>$_POST['anmile'],
							  'anapog'=>$_POST['anapog'],
							  'anaboi'=>$_POST['anaboi'],
							  'bonote'=>$_POST['bonote'],
							  'degres'=>$_POST['degres']);
			$bout     = new bout($donnees);
			$bout_dao->add($bout);
			
		}

	}

}

header('Location: ../fiche/vins.fiche.a.php?revins='.$revins.'&rebout=0');

require '../index/footer.php';

?>