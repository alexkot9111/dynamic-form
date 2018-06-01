<?php

require_once './controller/Controller.php';
require_once './model/FormModel.php';
require_once './model/DashboardModel.php';

/**
 * DashboardController Class
 *
 * @version 0.1.0
 */
class DashboardController extends Controller {

    /**
     * @var object $dashboardModel
     */
    public $dashboardModel; 

    /**
     * @var object $formModel
     */
    public $formModel;
 
    function __construct(){  

        $this->dashboardModel = new DashboardModel();
        $this->formModel = new FormModel();
        $dbLink = Model::$dbLink;

        if (isset($_POST['ter_pid']) && isset($_POST['ter_type']) && isset($_POST['ter_level']) ){

            $ter_pid = mysqli_real_escape_string($dbLink, $_POST['ter_pid']);
            $ter_type = mysqli_real_escape_string($dbLink, $_POST['ter_type']);
            $ter_level = mysqli_real_escape_string($dbLink, $_POST['ter_level']);
            $this->updateForm($ter_pid, $ter_type, $ter_level);

        }else{

            if (!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['territory'])){
                $this->createForm();
            } else {
                $email = mysqli_real_escape_string($dbLink, $_POST['email']);
                $name = mysqli_real_escape_string($dbLink, $_POST['name']);
                $territory = mysqli_real_escape_string($dbLink, $_POST['territory']);
                $this->createDashboard($email, $name, $territory);
            }

        }

        //Clear POST
        $_POST = array();
        
    }
    
    /**
     * Create dashboard content
     *
     * @param string $email Email
     *
     * @param string $name Name
     *
     * @param int $territory Territory
     *
     * @return dashboard content
     */
    function createDashboard($email, $name, $territory){
        $data = $this->dashboardModel->checkIssetEmail($email, $name, $territory);
        $this->view('dashboardView.php', $data);
    }

    /**
     * Create form content
     *
     * @return form content
     */
    function createForm(){
        $data = $this->formModel->getSelectInfo(null, 0, 1);
        $this->view('formView.php', $data);
    }

    /**
     * Create dynamic select content
     *
     * @param int $ter_pid Territory Parent Id
     *
     * @param int $ter_type_id Territory Type
     *
     * @param int $ter_level Territory Level
     *
     * @return dynamic select content
     */
    function updateForm($ter_pid, $ter_type, $ter_level){
        $form_info = $this->formModel->getSelectInfo($ter_pid, $ter_type, $ter_level);
        $data['ter_pid'] = $ter_pid;
        $data['ter_type'] = $ter_type;
        $data['select_info'] = $form_info;
        $this->view('selectView.php', $data);
    }
}