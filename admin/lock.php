<?php 
session_start();
if(!$_SESSION['admin']){
	exit('no');
}


require '../config.php';
require '../mysql.class.php';

$id = $_POST['id'];
$option = $_POST['option'];

DB::connect();

if((!empty($id)  && is_numeric($id))){
	if($option == 'lock'){
		$option_sql = 'update '. GB_TABLE_NAME.' set status = 1 where id = ' . $id;
	}elseif($option == 'unlock'){
		$option_sql = 'update '. GB_TABLE_NAME.' set status = 0 where id = ' . $id;
	}


	$option_status = mysqli_query(DB::$con,$option_sql);

	if($option_sql){
		echo json_encode(["error"=>0,'msg'=>$option . 'success']);
	}else{
		echo json_encode(["error"=>1,'msg'=>$option . 'falure']);
	}
}else{
	echo json_encode(['error'=>1,'msg'=>'id needed!']);
}