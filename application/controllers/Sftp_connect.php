<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sftp_connect extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('sftp');
	}

	public function index(){
		$this->load->view('welcome_message');
	}

	function sftp_connect(){
		error_reporting(E_ERROR | E_PARSE); //disable error
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$dis_timestamp = $this->input->post("timestamp");
		$arr_dis = explode(" ",$dis_timestamp);
		$tgl_dis = explode("-",$arr_dis[0]);
		$time_dis = explode(":",$arr_dis[1]);
		$recfile = $this->input->post("file");

		$dataFile = $recfile.'.mp4';
		
		$sftpServer    = '192.168.1.1';		//hostname ex: 192.168.1.1
		$sftpUsername  = 'root';			//your username ex: root
		$sftpPassword  = 'P@ssw0rd';		//your password ex: password
		$sftpPort      = '22';				//your port ex: 22
		$sftpRemoteDir = '/data/'.$tgl_dis[0].'/'.$tgl_dis[1]; 	//your remote direktori
		
		$localDir = $_SERVER['DOCUMENT_ROOT'].'/assets'; 		//your local directori
		
		$sftp = new Net_SFTP($sftpServer);
		//connect user, password	
		if(!$sftp->login($sftpUsername, $sftpPassword)){
			$data["login"] = false;
		}else{
			$data["login"] = true;
		}
		$remote_file = $sftpRemoteDir . '/' . $dataFile;
        if(!$sftp->get($remote_file, $localDir. '/' . $dataFile)){
            $data["status"] = false;
        }else{
			$data["status"] = true;
			$data["filename"] =$dataFile;
		}		
		echo json_encode($data, true);
	}

}