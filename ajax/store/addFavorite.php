<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('storeAccount.php');
chdir('../ajax/store');

if(isset($_GET['storeId']) and isset($_GET['productId'])){
	$userId=$_SESSION['storesLogin'][$_GET['storeId']]['userId'];
	if(isset($userId))
	{
		$userFavorites = getFavorites($userId);
		if(isset($userFavorites[0]))
		{
			$found='false';
			foreach($userFavorites as $favorite)
			{
				if($favorite.id == $_GET["productId"])
				{
					$found='true';
					break;
				}
			}
			if($found=='false')
			{
				addFavorite($userId,$_GET["productId"]);
			}
		}else{
			addFavorite($userId,$_GET["productId"]);
		}
		echo json_encode(Array("result"=>"ok"));
	}else{
		echo json_encode(Array("result"=>"user must be logged in"));
	}
}else{
	echo json_encode(Array("result"=>"missing data"));
}

?>