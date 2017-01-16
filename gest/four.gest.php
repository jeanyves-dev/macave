<?php

require '../classe/four.class.php';
require '../dao/four.dao.php';

require '../index/conn_db.php';

$four_dao = new four_dao($db);

if ($_GET['mode'] == "del")
{
	$four_dao->delete($_GET['refour']);
}
else
{
	if (isset($_POST['defour']) AND $_POST['defour'] <>"")
	{
		
		if (isset($_POST["refour"]) AND $_POST["refour"] <> 0)
		{
			$donnees  = array('refour' =>$_POST['refour'],
							  'defour' =>$_POST['defour'],
							  'adresa' =>$_POST['adresa'],
							  'adresb' =>$_POST['adresb'],
							  'codpos' =>$_POST['codpos'],
							  'villef' =>$_POST['villef'],
							  'numtel' =>$_POST['numtel'],
							  'numfax' =>$_POST['numfax'],
							  'admail' =>$_POST['admail'],
							  'sitweb' =>$_POST['sitweb']);
			$four     = new four($donnees);
			$four_dao->update($four);
		}
		else
		{
			$donnees  = array('defour' =>$_POST['defour'],
							  'adresa' =>$_POST['adresa'],
							  'adresb' =>$_POST['adresb'],
							  'codpos' =>$_POST['codpos'],
							  'villef' =>$_POST['villef'],
							  'numtel' =>$_POST['numtel'],
							  'numfax' =>$_POST['numfax'],
							  'admail' =>$_POST['admail'],
							  'sitweb' =>$_POST['sitweb']);
			$four     = new four($donnees);
			$four_dao->add($four);
		}

	}
}

header('Location: ../liste/four.liste.php');

require '../index/Footer.php';

?>