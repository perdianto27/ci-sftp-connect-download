<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
    include FCPATH.'assets/SFTP/Net/SFTP.php';
    
    class Sftp{

        protected $CI;
        public function __construct(){
            $this->ci =& get_instance();
        }
	}
