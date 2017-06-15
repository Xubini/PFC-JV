<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends Pfc_login_template_base_controller {
	
	
	public function __construct(){
		parent::__construct();
	}

	public function index($data=array(),$errors=array()){
		var_dump($_SESSION); 
        $this->load_language_file('login');
		$this->load->helper('messages_helper');
		
		$this->parse_document(array(
				'login_view'
		),array(
				'var_user' => safe_array_get('user',$data),
				'var_user_type' => safe_array_get('user_type',$data),
				'var_errors'=>$errors
		));
    }

 	public function authenticate(){
 		$this->load->library('form_validation');
        $this->form_validation->set_rules('user', '{user}','trim|required');
		$this->form_validation->set_rules('password', '{password}','trim|required|callback_check_credentials');
		$this->form_validation->set_rules('user_type', '{user_type}','required');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->index(array('user'=>$this->input->post('user',TRUE),'user_type'=>$this->input->post('user_type',TRUE)),$this->form_validation->error_array());
        }
        else
        {
            redirect(base_url("home"));
        }
    }
    public function check_credentials($password)
    {
        $user = $this->input->post('user');
        $user_type = $this->input->post('user_type');
        $this->load->model('user_model', '', TRUE);
        $user = $this->user_model->check_credentials($user, $password, $user_type);
        if (!isempty_array($user)){
        	//var_dump($user);exit();
        	switch($user_type){
        		case "S":
        			$this->session_service->set_superadmin($user);
        			break;
        		case "A":
        			$this->session_service->set_admingroup($user);
        			break;
        		case "P":
        			$this->session_service->set_owner($user);
        			break;
        		case "E":
        			$this->session_service->set_employee($user);
        			break;
        		default:
        			return FALSE;
        			
        	}
            
            return TRUE;
        }
        $this->form_validation->set_message('check_credentials','Credenciales incorrectas');
        return FALSE;
    }
    
    public function logout()
    {
    	if ($this->session_service->is_superadmin_logged_in()) {
    		$this->session_service->remove_superadmin();
    	}
    	
    	if ($this->session_service->is_admingroup_logged_in()){
    		$this->session_service->remove_admingroup();
    	}

    	if ($this->session_service->is_owner_logged_in()){
    		$this->session_service->remove_owner();
    	}
    	
    	if ($this->session_service->is_employee_logged_in()){
    		$this->session_service->remove_employee();
    	}
    	     	
    	redirect(base_url("login"));
    }
}