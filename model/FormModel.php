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
     * @return $data_arr
     */
    public function getSelectInfo($ter_pid){

    	$loc_id = '';
    	$loc_name = '';
    	$city_dist = 0;
    	$res_arr = array();

    	if (is_null($ter_pid)) {
    	    $ter_pid_val = "IS NULL";
    	}else{
    		$ter_pid_val = "= '$ter_pid'";

    		// get parent type
    		$query_ter = "SELECT * FROM t_koatuu_tree WHERE ter_id = '$ter_pid'";
			$result_ter = mysqli_query(self::$dbLink, $query_ter) or die('Запрос не удался: ' . mysqli_error(self::$dbLink));
			$ter_arr = mysqli_fetch_array($result_ter, MYSQLI_ASSOC);
			
			// check parent type
			if ($ter_arr['ter_level'] == '1' && $ter_arr['reg_id'] != '80' && $ter_arr['reg_id'] != '85') {
    	    	$loc_id = 'city';
    			$loc_name = 'місто/район';
			}else{
	    		$loc_id = 'territory';
	    		if ((int)$ter_arr['ter_type_id'] <= 1) {
	    			$loc_name = 'район міста';
	    		}else{
	    			$loc_name = 'населений пункт';
	    		}
			}
    	}

    	// get child territories
        $query = "SELECT * FROM t_koatuu_tree WHERE ter_pid $ter_pid_val";
		$result = mysqli_query(self::$dbLink, $query) or die('Запрос не удался: ' . mysql_error(self::$dbLink));

		while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    $res_arr[] = $res;
		    if ($loc_id == 'territory' && $res['ter_level'] == '3') {
		    	if ($res['ter_type_id'] == '3') {
		    		$city_dist = 1;
		    	}
		    }else{
		    	$city_dist = 1;
		    }
		}

		// check if city district isset
		if (!$city_dist) {
			$empty_arr = array('ter_id' => "$ter_pid", 'ter_name' => "В межах міста");
			array_unshift($res_arr, $empty_arr);
		}

		//data_arr layout
		$data_arr['loc_id'] = $loc_id;
		$data_arr['loc_name'] = $loc_name;
		$data_arr['res_arr'] = $res_arr;

		return $data_arr;
    }

}