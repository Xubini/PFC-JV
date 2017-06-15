<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Planning_controller extends Pfc_default_template_base_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
	
        $this->parse_document(array(
            'planning_view'
        ),array(
            //'var_user' => session_get_admin()
        ));
    }
}