<?php 


class DB{
	public static $con;



	public static function connect(){
		if (!self::$con) {
			self::$con = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);
			if (mysqli_connect_error()) {
				exit('database error!');
			}
		}

		return self::$con;
	}





	static function close(){
		if (self::$con) {
			# code...
			self::$con->close();
			self::$con=null;
		}
	}
}