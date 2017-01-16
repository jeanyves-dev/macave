<?php

require '../classe/prod.class.php';
require '../dao/prod.dao.php';

require '../index/conn_db.php';

$prod_dao = new prod_dao($db);

if ($_GET['mode'] == "del")
{
	$prod_dao->delete($_GET['reprod']);
}
else
{
	if (isset($_POST['deprod']) AND $_POST['deprod'] <> "")
	{
	
		echo $_POST["reprod"];
		
		if (isset($_POST["reprod"]) AND $_POST["reprod"] <> 0)
		{
			$donnees  = array('reprod' =>$_POST['reprod'],
							  'deprod' =>$_POST['deprod'],
							  'adresa' =>$_POST['adresa'],
							  'adresb' =>$_POST['adresb'],
							  'codpos' =>$_POST['codpos'],
							  'villep' =>$_POST['villep'],
							  'typrop' =>$_POST['typrop'],
							  'admail' =>$_POST['admail'],
							  'adrweb' =>$_POST['adrweb']);
			$prod     = new prod($donnees);
			$prod_dao->update($prod);
		}
		else
		{
			$donnees  = array('deprod' =>$_POST['deprod'],
							  'adresa' =>$_POST['adresa'],
							  'adresb' =>$_POST['adresb'],
							  'codpos' =>$_POST['codpos'],
							  'villep' =>$_POST['villep'],
							  'typrop' =>$_POST['typrop'],
							  'admail' =>$_POST['admail'],
							  'adrweb' =>$_POST['adrweb']);
			$prod     = new prod($donnees);
			$prod_dao->add($prod);
		}

	}
}

header('Location: ../liste/prod.liste.php');

require '../index/Footer.php';

?>