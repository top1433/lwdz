<?php require 'common/header.php' ?>

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-info">
	<div class="panel-heading"><h2>PHP 留言本</h2></div>
<div class="panel-body">


<?php 

	require 'config.php';
	require 'mysql.class.php';

	$gb_count_sql = 'select count(*) from ' .GB_TABLE_NAME.' where status=0';

	DB::connect();

	$gb_count_res = mysqli_query(DB::$con,$gb_count_sql);
	$gb_count = mysqli_fetch_row($gb_count_res)[0];

	//var_dump($gb_count);

	$page = isset($_GET['page']) ? intval($_GET['page']) : 1 ;
	$pagenum = ceil($gb_count/PER_PAGE_GB);

	if($page > $pagenum || $page < 0){
		$page = 1;
	}


	$offset=($page-1)*PER_PAGE_GB;


	$pagedata_sql = 'select nickname,content,email,createtime,reply,replytime from  '.GB_TABLE_NAME.'  WHERE STATUS=0 ORDER BY CREATETIME DESC LIMIT  '.$offset.','.PER_PAGE_GB;
	//echo $pagedata_sql;
	$sql_page_result = mysqli_query(DB::$con,$pagedata_sql);

	//var_dump($sql_page_result);

	while($temp = mysqli_fetch_array($sql_page_result)){
		$sql_page_array[]=$temp;
	}
	DB::close();

	//print_r($sql_page_array);

	if(!empty($sql_page_array)){


		foreach($sql_page_array as $key => $value) {
			echo '<div style="background-color:#F7F7F9"><li class="list-group-item list-group-item-success">留言者:<span> '.$value['nickname'].'</span>' .(empty($value['email']) ? '': '&nbsp;&nbsp;  |  &nbsp;&nbsp; 邮箱：'.$value['email']);
			echo '<span style="float:right;">时间：' . $value['createtime'] .'</span></li>';
			echo '<li class="list-group-item 1">内容：' . $value['content'] .'</li>';
			if (!empty($value['reply'])) {
            echo '<li class="list-group-item list-group-item-warning">管理员回复：' . $value['reply'] ;
            echo '<span style="float:right;">回复时间：' . $value['replytime'] .'</span></li>';
        }
        echo '</div><hr>';
		}
	}

	echo "共".$gb_count."条留言";


	if($pagenum > 1){ 	
		for($i=1;$i<=$pagenum;$i++){
			if($i==$page){
				echo $i;
			}
			else{
				echo '<a href = "?page='.$i.'">&nbsp;'.$i.'&nbsp</a>';
			}
		}
	}

	


 ?>
 </div>



 <div class="panel-footer">
 	<div class="post">
 		<form name="message_submit" id="form" method="post" class="form-horizontal">
 			
 			<div class="form-group">
 				<label for="" class="col-sm-2 control-lable">姓名：</label>
 				<div class="col-sm-4">
 					<input type="text" name="nickname" class="form-control" id="nickname" placeholder="必填（不超过50个字符）" required="" maxlength="50">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="" class="col-sm-2 control-lable">内容：</label>
 				<div class="col-sm-4">
 					<input type="text" name="content" class="form-control" id="content" placeholder="必填（不超过50个字符）" required="" maxlength="50">
 				</div>
 			</div>

 			<div class="form-group">
 				<label for="" class="col-sm-2 control-lable">EMAIL:</label>
 				<div class="col-sm-4">
 					<input type="text" name="email" class="form-control" id="email" placeholder="EMAIL" required="" maxlength="50">
 				</div>
 			</div>


 			<div class="form-group">
 				<label for="" class="col-sm-2 control-lable"></label>
 				<div class="col-sm-4">
 					<button type="button" name="sub" id="sub">留言</button>
 					<button type="reset" id="reset">重置</button>
 				</div>
 			</div>
 		</form>
 	</div>
 </div>

</div>
</div>

<?php  require 'common/footer.php'; ?>

<script src="https://cdn.bootcss.com/jquery/2.2.3/jquery.js"></script>

<script type="text/javascript" src="js/ajax_submit.js"></script>