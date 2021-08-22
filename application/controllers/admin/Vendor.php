<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Vendor';      
        $data['page'] = 'Vendor';   
        $data['main_page'] = 'Purchases'; 
        $data['vendor'] = FALSE;
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['main_content'] = $this->load->view('admin/user/vendors',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    // load currency by ajax
    public function load_customer_info($id)
    {
        $vendor = $this->admin_model->get_vendor_info($id);
        if (empty($vendor)) {
            $value = '<h5> Nothing found ! </h5>';
            echo json_encode(array('st' => 0, 'value' => $value, 'currency' => ''));
        }else{
            $currency = $this->business->currency_symbol;
            $value = '<h5>'.$vendor->phone.'</h5> <h6>'.$vendor->email.'</h6>';
            echo json_encode(array('st' => 1, 'value' => $value, 'currency' => $currency, 'code' => $this->business->currency_code));
        }
        
    }

    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Vendor Name", 'required|max_length[100]');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/vendor'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'phone' => $this->input->post('phone', true),
                    'email' => $this->input->post('email', true),
                    'address' => $this->input->post('address', true),
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'vendors');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'vendors');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }
                redirect(base_url('admin/Vendor'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['vendor'] = $this->admin_model->select_option($id, 'vendors');
        $data['main_content'] = $this->load->view('admin/user/vendors',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'vendors');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/vendor'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'vendors');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/Vendor'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'vendors'); 
        echo json_encode(array('st' => 1));
    }

}
	

