<?php

	require '../index/calendrier.php';
	
	require '../classe/vins.class.php';
	require '../classe/bout.class.php';
	require '../classe/empl.class.php';
	require '../classe/colo.class.php';
	require '../classe/casi.class.php';
	require '../classe/rang.class.php';
	require '../classe/enso.class.php';
	require '../dao/vins.dao.php';
	require '../dao/bout.dao.php';
	require '../dao/empl.dao.php';
	require '../dao/colo.dao.php';
	require '../dao/casi.dao.php';
	require '../dao/rang.dao.php';
	require '../dao/enso.dao.php';
	require '../index/conn_db.php';
	
	$bout_dao = new bout_dao($db);
	$empl_dao = new empl_dao($db);
	$colo_dao = new colo_dao($db);
	$casi_dao = new casi_dao($db);
	$rang_dao = new rang_dao($db);
	

?>