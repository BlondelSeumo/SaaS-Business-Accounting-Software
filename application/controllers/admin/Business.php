<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user() && !is_admin()) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data = array();
        $data['page_title'] = 'Business';
        $data['page'] = 'Business';
        $data['busines'] = FALSE;
        $data['business'] = $this->admin_model->get_business(0);
        $data['total'] = count($data['business']);
        $data['active_business'] = $this->admin_model->get_active_business();
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['categories'] = $this->admin_model->select_asc('business_category');
        $data['main_content'] = $this->load->view('admin/user/business',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Customer Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/business'));
            } else {

                if ($id != '') {
                    $business = $this->admin_model->get_single_business($id);
                    $uid = $business[0]['uid'];
                    $country = $business[0]['country'];
                }else{
                    $uid = random_string('numeric',5);
                    $country = $this->input->post('country', true);
                }

                $data=array(
                    'user_id' => user()->id,
                    'uid' => $uid,
                    'title' => $this->input->post('title', true),
                    'name' => $this->input->post('name', true),
                    'address' => $this->input->post('address', true),
                    'biz_number' => $this->input->post('biz_number', true),
                    'vat_code' => $this->input->post('vat_code', true),
                    'is_autoload_amount' => 0,
                    'country' =>$country ,
                    'category' => $this->input->post('category', true),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'business');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {


                    if (check_package_limit('business') != -2) {
                        $total = get_total_value('business', 0);
                        if ($total >= check_package_limit('business')):
                            $msg = trans('reached-limit').', '.trans('package-limit-msg');
                            $this->session->set_flashdata('error', $msg);
                            redirect(base_url('admin/business'));
                            exit();
                        endif;
                    }


                    $id = $this->admin_model->insert($data, 'business');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo1');
                if($data_img){
                    $data_img = array(
                        'logo' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'business'); 
                 }

                redirect(base_url('admin/business'));
            }
        }      
        
    }


    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'Business';
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['categories'] = $this->admin_model->select_asc('business_category');
        $data['busines'] = $this->admin_model->get_single_business_by_md5($id);
        if (!empty($data['busines']) && $data['busines'][0]['user_id'] != user()->id) {
            $this->session->set_flashdata('error', 'Access Denied!'); 
            redirect(base_url('admin/business')); exit();
        }
        $data['main_content'] = $this->load->view('admin/user/business',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function set_primary($id) 
    {
        $this->admin_model->update_business_default();
        $data = array(
            'is_primary' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update_md5($data, $id,'business');
        echo json_encode(array('st' => 1));
    }


    public function invoice_customize() 
    {
        if($_POST)
        {   
            if (!empty($this->input->post('template_style'))) {
                $template_style = $this->input->post('template_style', true);
            } else {
                $template_style = 1;
            }

            if(!empty($this->input->post('enable_stock'))){$enable_stock = $this->input->post('enable_stock', true);}
            else{$enable_stock = 0;}
            
            $data = array(
                'template_style' => $template_style,
                'color' => $this->input->post('color', true),
                'enable_stock' => $enable_stock,
                'footer_note' => $this->input->post('footer_note')
            );
            $this->admin_model->update($data, $this->business->id, 'business');
            $this->session->set_flashdata('msg', trans('msg-updated')); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['page_title'] = 'Invoice Customization';   
        $data['page'] = 'Invoice';   
        $data['business'] = $this->admin_model->get_business(0);
        $data['main_content'] = $this->load->view('admin/user/invoice_customize',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function categories()
    {  
        $data = array();
        $data['page_title'] = 'Categories';   
        $data['page'] = 'Business';
        $data['main_page'] = 'Settings';
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->select('business_category');
        $data['main_content'] = $this->load->view('admin/user/business_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add_category()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Name", 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/business/categories'));
            } else {
                $data=array(
                    'name' => $this->input->post('name', true)
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'business_category');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'business_category');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                // upload logo
                $data_img = $this->admin_model->do_upload('photo1');
                if($data_img){
                    $data_img = array(
                        'logo' => $data_img['medium']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'business'); 
                 }

                redirect(base_url('admin/business/categories'));
            }
        }      
        
    }


    public function edit_category($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'Business';
        $data['category'] = $this->admin_model->select_option($id, 'business_category');
        $data['main_content'] = $this->load->view('admin/user/business_category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

  

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'business');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/business'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'business');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/business'));
    }

   
    
    public function delete($id)
    {
        $business = $this->admin_model->get_single_business($id);
        $uid = $business[0]['uid'];

        $this->admin_model->delete_by_business($uid,'payment_records');
        $this->admin_model->delete_by_business($uid,'customers');
        $this->admin_model->delete_by_business($uid,'expenses');
        $this->admin_model->delete_by_business($uid,'invoice');
        $this->admin_model->delete_by_business($uid,'payment_advance');
        $this->admin_model->delete_by_business($uid,'expenses');
        $this->admin_model->delete_by_business($uid,'vendors');
        
        $this->admin_model->delete($id,'business'); 

        $my_business = $this->admin_model->select_by_user('business');
        redirect(base_url('admin/profile/switch_business/'.$my_business[0]->uid));
    }

    public function delete_category($id)
    {
        $this->admin_model->delete($id,'business_category'); 
        echo json_encode(array('st' => 1));
    }


}