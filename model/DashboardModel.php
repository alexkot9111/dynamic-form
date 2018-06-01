<?php 

require_once './model/Model.php';

/**
 * DashboardModel Class
 *
 * @version 0.1.0
 */
class DashboardModel extends Model { 

	/**
     * @var array $data Data
     */
	static $data;

	/**
     * Check if isset email in DB
     *
     * @param string $email Email
     *
     * @param string $name Name
     *
     * @param int $territory Territory
     *
     * @return self::$data
     */
	public function checkIssetEmail($email, $name, $territory) {

        $query = "SELECT email FROM users WHERE email = '$email'";
		$result = mysqli_query(self::$dbLink, $query) or die('Запрос не удался: ' . mysqli_error(self::$dbLink));
		$res_arr = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if ($res_arr['email'] === null) {
            self::setDashboardInfo($email, $name, $territory);
        }else{
            self::$data['message'] = 'Ви вже зареєстровані з даним email: '.$res_arr['email'];
            self::getDashboardInfo($res_arr['email']);
        }

        mysqli_free_result($result);

		return self::$data;
	}

	/**
     * Insert registration form data to DB
     *
     * @param string $email Email
     *
     * @param string $name Name
     *
     * @param int $territory Territory
     *
     * @return self::$data['message']
     */
	public function setDashboardInfo($email, $name, $territory) {

		$query = "INSERT INTO users (email, name, territory) VALUES ('$email', '$name', '$territory')";
		$result = mysqli_query(self::$dbLink, $query) or die('Запрос не удался: ' . mysqli_error(self::$dbLink));

		self::getDashboardInfo($email);

		self::$data['message'] = 'Дякуємо за реєстрацію!';

    }

	/**
     * Get user data if email isset
     *
     * @param string $email Email
     *
     * @return self::$data['dasboard_info']
     */
    public function getDashboardInfo($email) {

        $query = "SELECT * FROM users AS u LEFT JOIN t_koatuu_tree AS k ON u.territory = k.ter_id WHERE email = '$email'";
		$result = mysqli_query(self::$dbLink, $query) or die('Запрос не удался: ' . mysqli_error(self::$dbLink));
		
		self::$data['dasboard_info'] = mysqli_fetch_array($result, MYSQLI_ASSOC);

		mysqli_free_result($result);

    }
}
