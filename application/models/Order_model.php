<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');

class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_time_next_order($group){
    	if (isempty($group)) {
    		return FALSE;
    	}
    	    	   	
    	$sql = "SELECT dt_fecha_pedido FROM pedido WHERE i_id_grupo = $group AND c_estado = 'P' ORDER BY dt_fecha_pedido LIMIT 1";
    	$query = $this->db->query($sql);
    	
    	if ($query->num_rows() >0){
    		$result = $query->result('array');
    		return $result[0];
    	}
    	
    	return FALSE;
    	
    }
    
    
}