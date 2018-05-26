<?php 
require_once './model/Model.php';

/**
 * formModel Class
 *
 * @version 0.1.0
 */
class formModel extends Model { 

    /**
     * Get info for dynamic select from DB
     *
     * @param int $ter_pid Territory Parent Id
     *
     * @param int $ter_type_id Territory Type
     *
     * @param int $ter_level Territory Level
     *
     * @return $res_arr
     */
    public function getSelectInfo($ter_pid, $ter_type_id, $ter_level){
    	if (is_null($ter_pid)) {
    	    $ter_pid_val = "IS NULL";
    	}else{
    		$ter_pid_val = "= '$ter_pid'";
    	}   
        $query = "SELECT ter_id, ter_name FROM t_koatuu_tree WHERE ter_level = '$ter_level' AND ter_pid $ter_pid_val AND ter_type_id = '$ter_type_id' AND NOT ter_id = '8000000000' AND NOT ter_id = '8500000000'";
		$result = mysqli_query(self::$dbLink, $query) or die('Запрос не удался: ' . mysql_error(self::$dbLink));
		while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    $res_arr[] = $res;
		}
		return $res_arr;
    }

}