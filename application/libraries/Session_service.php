<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Session_service
{

    const DATA_SUPERADMIN_KEY = 'superadmin';
    const DATA_ADMINGROUP_KEY = 'admingroup';
    const DATA_OWNER_KEY = 'owner';
    const DATA_EMPLOYEE_KEY = 'employee';
        
    const DATA_RAL_KEY = 'redirect_after_login';
    const MESSAGE_ERROR_KEY = "error";
    const MESSAGE_SUCCESS_KEY = "success";
    
    const LANGUAGE_KEY = "language";
    const FLASHDATA_KEY = "_flash_oo";
    
    private $superadmin_session_data_keys = array(
    		self::MESSAGE_ERROR_KEY,
    		self::MESSAGE_SUCCESS_KEY,
    		self::LANGUAGE_KEY,
    		self::DATA_SUPERADMIN_KEY
    );
    
    private $admingroup_session_data_keys = array(
    		self::MESSAGE_ERROR_KEY,
    		self::MESSAGE_SUCCESS_KEY,
    		self::LANGUAGE_KEY,
    		self::DATA_ADMINGROUP_KEY
    );
    
    private $owner_session_data_keys = array(
    		self::MESSAGE_ERROR_KEY,
    		self::MESSAGE_SUCCESS_KEY,
    		self::LANGUAGE_KEY,
    		self::DATA_OWNER_KEY
    );
    
    private $employee_session_data_keys = array(
    		self::MESSAGE_ERROR_KEY,
    		self::MESSAGE_SUCCESS_KEY,
    		self::LANGUAGE_KEY,
    		self::DATA_EMPLOYEE_KEY
    );
    
    

    private $code_igniter;

    private $session;

    public function __construct ()
    {
        $this->code_igniter = & get_instance();
        if (!isset($this->code_igniter->session)){
     	  $this->code_igniter->load->driver('session');
     	  log_message("DEBUG", "Loading Session driver");
        }
        $this->session = & $this->code_igniter->session;
    }
    
    public function has_session(){
    	if (isset($_SESSION) &&(isset($_SESSION[self::DATA_ADMINGROUP_KEY]) || isset($_SESSION[self::DATA_EMPLOYEE_KEY]) 
    			|| isset($_SESSION[self::DATA_SUPERADMIN_KEY])|| isset($_SESSION[self::DATA_OWNER_KEY]))){
    		return TRUE;
    	}
    	
    	return FALSE;
    }
    

    public function get_language ()
    {
        if ($this->session->has_userdata(self::LANGUAGE_KEY)) {
            return $this->session->userdata(self::LANGUAGE_KEY);
        }
        
        return config_item('language');
    }
    
    public function set_language ($language = NULL) {
        if (!isempty($language)){
            $this->session->set_userdata(self::LANGUAGE_KEY, $language);
        }
    }

    public function get_html_language ()
    {
        $lang = $this->get_language();
        
        return preg_replace('/_/i', '-', $lang);
    }
    
    public function set_flash_data($data = NULL){
        $this->session->set_flashdata(self::FLASHDATA_KEY, $data);
    }
    
    public function get_flash_data() {
        return $this->session->flashdata(self::FLASHDATA_KEY);
    }
    
    
    public function destroy_session ()
    {
        $this->session->sess_destroy ();
    }
    
    
    public function set_error_message($message){
        return $this->session->set_userdata(self::MESSAGE_ERROR_KEY,$message);
    }
    
    public function has_error_message(){
        return $this->session->has_userdata(self::MESSAGE_ERROR_KEY);
    }
    
    public function get_error_message(){
         
        if ($this->session->has_userdata(self::MESSAGE_ERROR_KEY)){
             
            return $this->session->userdata(self::MESSAGE_ERROR_KEY);
        }
    }
    
    public function remove_error_message(){
        return $this->session->unset_userdata(self::MESSAGE_ERROR_KEY);
    }
     
    
    public function set_success_message($message){
        $this->session->set_userdata (self::MESSAGE_SUCCESS_KEY,$message);
    }
    
    
    public function get_success_message(){
        if ($this->session->has_userdata(self::MESSAGE_SUCCESS_KEY)){
            return $this->session->userdata(self::MESSAGE_SUCCESS_KEY);
        }
    }
    
    public function remove_success_message(){
        return  $this->session->unset_userdata(self::MESSAGE_SUCCESS_KEY);
    }
    
    
    public function has_success_message(){
        return $this->session->has_userdata(self::MESSAGE_SUCCESS_KEY);
    }
    
    public function set_redirect_after_login ($url)
    {
        $this->session->set_userdata(self::DATA_RAL_KEY, $url);
    }
    
    public function get_redirect_after_login ()
    {
        if ($this->session->has_userdata(self::DATA_RAL_KEY)) {
            return $this->session->userdata(self::DATA_RAL_KEY);
        }
    
        return NULL;
    }
    
    public function remove_redirect_after_login ()
    {
        $this->session->unset_userdata(self::DATA_RAL_KEY);
    }
    
    
    
    
    /*********************************************************************************************/
    /*                                SUPERADMIN                                                 */
    /*********************************************************************************************/
    
    private function build_superadmin_for_session(&$superadmin){
        if (isempty($superadmin) || isempty_array($superadmin)){
            return FALSE;
        }
    
        return array_extract_by_keys($superadmin, array ('i_id_usuario', 's_email', 'b_activo','c_tipo_usuario'));
    }
    
    public function set_superadmin ($array)
    {
        $this->session->set_userdata(self::DATA_SUPERADMIN_KEY, $this->build_superadmin_for_session($array));
    }
    
    public function get_superadmin ()
    {
        if ($this->session->has_userdata(self::DATA_SUPERADMIN_KEY)) {
            return $this->session->userdata(self::DATA_SUPERADMIN_KEY);
        }
    
        return NULL;
    }
    
    public function remove_superadmin ()
    {
        $this->session->unset_userdata(self::DATA_SUPERADMIN_KEY);
    }
    
    public function is_superadmin_logged_in () {
        $superadmin = $this->get_superadmin();
        return ((!isempty_array($superadmin)) && (!isempty(safe_array_get('i_id_usuario', $superadmin))));
    }
    
    public function clear_superadmin_session_data(){
        //clear session user data
        $this->session->unset_userdata($this->superadmin_session_data_keys);
    }
    
    
    
    
    
    /*********************************************************************************************/
    /*                                     ADMINGROUP                                            */
    /*********************************************************************************************/
    
    private function build_admingroup_for_session(&$admingroup){
        if (isempty($admingroup) || isempty_array($admingroup)){
            return FALSE;
        }
    
        return array_extract_by_keys($admingroup, array ('i_id_usuario', 's_email', 'b_activo','c_tipo_usuario'));
    }
    
    public function set_admingroup($array)
    {
        $this->session->set_userdata(self::DATA_ADMINGROUP_KEY, $this->build_admingroup_for_session($array));
    }
    
    public function get_admingroup ()
    {
        if ($this->session->has_userdata(self::DATA_ADMINGROUP_KEY)) {
            return $this->session->userdata(self::DATA_ADMINGROUP_KEY);
        }
    
        return NULL;
    }
    
    public function remove_admingroup ()
    {
        $this->session->unset_userdata(self::DATA_ADMINGROUP_KEY);
    }
    
    public function is_admingroup_logged_in () {
        $admingroup = $this->get_admingroup();
        return ((!isempty_array($admingroup)) && (!isempty(safe_array_get('i_id_usuario', $admingroup))));
    }
    
    public function clear_admingroup_session_data(){
        //clear session user data
        $this->session->unset_userdata($this->admingroup_session_data_keys);
    }
    


    /*********************************************************************************************/
    /*                                     OWNER                                                 */
    /*********************************************************************************************/
    
    private function build_owner_for_session(&$owner){
    	if (isempty($owner) || isempty_array($owner)){
    		return FALSE;
    	}
    
    	return array_extract_by_keys($owner, array ('i_id_usuario', 's_email', 'b_activo','c_tipo_usuario'));
    }
    
    public function set_owner($array)
    {
    	$this->session->set_userdata(self::DATA_OWNER_KEY, $this->build_owner_for_session($array));
    }
    
    public function get_owner ()
    {
    	if ($this->session->has_userdata(self::DATA_OWNER_KEY)) {
    		return $this->session->userdata(self::DATA_OWNER_KEY);
    	}
    
    	return NULL;
    }
    
    public function remove_owner ()
    {
    	$this->session->unset_userdata(self::DATA_OWNER_KEY);
    }
    
    public function is_owner_logged_in () {
    	$owner = $this->get_owner();
    	return ((!isempty_array($owner)) && (!isempty(safe_array_get('i_id_usuario', $owner))));
    }
    
    public function clear_owner_session_data(){
    	//clear session user data
    	$this->session->unset_userdata($this->owner_session_data_keys);
    }
    
 

    /*********************************************************************************************/
    /*                                     EMPLOYEE                                              */
    /*********************************************************************************************/
    
    private function build_employee_for_session(&$employee){
    	if (isempty($employee) || isempty_array($employee)){
    		return FALSE;
    	}
    
    	return array_extract_by_keys($employee, array ('i_id_usuario', 's_email', 'b_activo','c_tipo_usuario'));
    }
    
    public function set_employee($array)
    {
    	$this->session->set_userdata(self::DATA_EMPLOYEE_KEY, $this->build_employee_for_session($array));
    }
    
    public function get_employee ()
    {
    	if ($this->session->has_userdata(self::DATA_EMPLOYEE_KEY)) {
    		return $this->session->userdata(self::DATA_EMPLOYEE_KEY);
    	}
    
    	return NULL;
    }
    
    public function remove_employee ()
    {
    	$this->session->unset_userdata(self::DATA_EMPLOYEE_KEY);
    }
    
    public function is_employee_logged_in () {
    	$employee = $this->get_employee();
    	return ((!isempty_array($employee)) && (!isempty(safe_array_get('i_id_usuario', $employee))));
    }
    
    public function clear_employee_session_data(){
    	//clear session user data
    	$this->session->unset_userdata($this->employee_session_data_keys);
    }
       
    /*******************************************************************************************************/
    
    public function get_data_user_connected(){
    	 
    	if($this->is_superadmin_logged_in()){
    		return $this->get_superadmin();
    	}
    	
    	if($this->is_admingroup_logged_in()){
    		return $this->get_admingroup();
    	}
    	
    	if($this->is_owner_logged_in()){
    		return $this->get_owner();
    	}
    	
    	if($this->is_employee_logged_in()){
    		return $this->get_employee();}
    	}
    
    
}