<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Splash extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('parser');
        $this->load->model('userinfo_model', 'user');
    }
    
	public function index()
	{
        // I expect there always MAC parameter or else not valid request
        $mac = $this->input->get('client_mac');
        $user = '';
        $data = array(
            'mac'=>$mac,
            'title'   => 'My Blog Title',
            //'heading' => 'My Blog Heading',
            'base_grant_url'=>$this->input->get('base_grant_url'),
            'user_continue_url'=>$this->input->get('user_continue_url'),
            );

        if ($mac){
            $user = $this->user->get_user($mac);
            
            $this->session->set_userdata('mac',$mac);
        }
        $views=array();
        if ($user){
            $data['name']=$user->name;
            $views['_content']='meraki_welcome';
        }else{
            $views['_content']='meraki_form';
        }

        $this->template->load('meraki_template', $views, $data);
        //$this->parser->parse('meraki_form', $data);
		//$this->load->view('meraki_form');
	}
    
    public function submit()
    {
        $data = array(
            'mobile' => $this->input->post('mobile'),
            'name' => $this->input->post('name'),
        );
        $views =array();
        $this->user->save($data);
        $base_grant_url = $this->input->post('base_grant_url');
        
        if($base_grant_url){
        $user_continue_url = $this->input->post('user_continue_url');     
//            $views['_content']='meraki_welcome';
//            
//            $this->template->load('meraki_template', $views, $data);
            redirect($base_grant_url.'?continue_url='.urlencode($user_continue_url).'&duration=120');
            
        }else{
            $this->session->set_flashdata('error', 'Not grant URL');
            redirect('splash');
//            $data['name']='Winzter';
//            $views['_content']='meraki_welcome';
//            $this->template->load('meraki_template', $views, $data);
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */