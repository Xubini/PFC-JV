<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function check_credentials($user,$password,$type_user){
        if (isempty($user) || isempty($password) || isempty($type_user)) {
            return FALSE;
        }

        $user = $this->db->escape($user);
        $password = $this->db->escape(sha1($password));
        $type_user = $this->db->escape($type_user);

        $sql = "SELECT * FROM usuario WHERE s_email = $user AND s_password = $password AND c_tipo_usuario = $type_user AND b_activo = 1;";
        $query = $this->db->query($sql);

        if ($query->num_rows() >0){
            $result = $query->result('array');
            return $result[0];
        }

        return FALSE; 
    }
    
	public function get_user_by_id($id){
		if (isempty($id)) {
			return FALSE;
		}
		
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM usuario WHERE i_id_usuario = $id AND b_activo = 1;";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() >0){
			$result = $query->result('array');
			return $result[0];
		}
		
		return FALSE;		
		
	}
    
}