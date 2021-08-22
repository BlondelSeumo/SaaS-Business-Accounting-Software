<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Discounts';      
        $data['page'] = 'Discount'; 
        $data['main_page'] = 'Settings';
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['main_content'] = $this->load->view('admin/discount',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function update()
    {   

        if(!empty($this->input->post('enable_discount'))){$enable_discount = $this->input->post('enable_discount', true);}
            else{$enable_discount = 0;}

        $monthly = $this->input->post('monthly', true);
        $yearly = $this->input->post('yearly', true);

        $packages = $this->admin_model->select_asc('package');

        $i=0; 
        foreach ($packages as $package) {
            $data = array(
                'dis_month' => $monthly[$i],
                'dis_year' => $yearly[$i]
            );
            $this->admin_model->edit_option($data, $package->id, 'package');
            $i++;
        }

        $set_data = array(
            'enable_discount' => $enable_discount
        );
         $this->admin_model->edit_option($set_data, 1, 'settings');

        $this->session->set_flashdata('msg', trans('msg-updated')); 
        redirect(base_url('admin/discount'));
        
    }



}
	

