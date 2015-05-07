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
        $mac = $this->input->get('mac');
        $user = '';
        $data = array(
            'title'   => 'My Blog Title',
            //'heading' => 'My Blog Heading',
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
        $grant_url = $this->input->post('grant_url');
        if($grant_url){
             
            $views['_content']='meraki_welcome';
            
            $this->template->load('meraki_template', $views, $data);
            
            //redirect($grant_url);
            
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