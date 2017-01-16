<?php

require '../classe/tbsd.class.php';
require '../dao/tbsd.dao.php';
require '../index/conn_db.php';

$tbsd_dao = new tbsd_dao($db);

echo "Mode : ".$_GET['mode'];

switch ($_GET['mode'])
{
    case "del":
		$tbsd_dao->delete($_GET['retbsd']);
        break;
		
    case "upd":
		$donnees  = array('codtab'=>$_POST['codtab'],'retbsd'=>$_POST['retbsd'],'detbsd'=>$_POST['detbsd']);
		$tbsd     = new tbsd($donnees);
		$tbsd_dao->update($tbsd);
        break;
		
    case "add":
		$donnees  = array('codtab'=>$_POST['codtab'],'retbsd'=>$_POST['retbsd'],'detbsd'=>$_POST['detbsd']);
		$tbsd     = new tbsd($donnees);
		$tbsd_dao->add($tbsd);
        break;
}

header('Location: ../liste/tbsd.liste.php?codtab='.$_POST['codtab']);

require '../index/Footer.php';

?>