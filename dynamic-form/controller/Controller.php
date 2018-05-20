<?php

/**
 * Controller Class
 *
 * @version 0.1.0
 */
class Controller {
 	
 	/**
     * Get view file
     *
     * @param string $file_name File Name
     *
     * @param string $data Data
     *
     * @return view file
     */
    function view( $file_name, $data = null ){
        if( is_array($data) ) {
            extract($data);
        }
        include 'view/' . $file_name;
    }
}