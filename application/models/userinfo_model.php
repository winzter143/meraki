<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Userinfo_model extends MY_Model
{

    /**
     * Get The user roles
     * 
     * @param str $mac
     * @return array
     */
    public function get_user($mac)
    {
        return $this->get_by( array('mac' => $mac) );
    }

    public function save($data)
    {
        $data['timestamp']=time();
        $data['mac']=$this->session->userdata('mac');
        
        return $this->insert($data);
    }

}