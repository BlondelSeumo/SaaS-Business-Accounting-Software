<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Home_Controller {

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
        $data['page_title'] = 'Customers';
        $data['page'] = 'Customers';
        $data['main_page'] = 'Sales';
        $data['customer'] = FALSE;
        $data['customers'] = $this->admin_model->get_customers();
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['main_content'] = $this->load->view('admin/user/customers',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    // load currency by ajax
    public function load_currency($currency_id)
    {
        $currency = $this->admin_model->get_by_id($currency_id, 'country');
        if (empty($currency)) {
            echo '<option value="0">'.'Nothing found !'.'</option>';
        }else{
            echo '<option value="'.$currency->currency_code.'">'.$currency->currency_code.' - '.$currency->currency_name.'</option>';
        }
    }

    // load currency by ajax
    public function load_customer_info($id)
    {
        $customer = $this->admin_model->get_customer_info($id, 'customers');

        if (empty($customer)) {
            $value = '<h5> Nothing found ! </h5>';
            echo json_encode(array('st' => 0, 'value' => $value, 'currency' => ''));
        }else{

            if (empty($customer->currency_symbol)) {
                $currency = $this->business->currency_symbol;
            } else {
                $currency = $customer->currency_symbol;
            }
            
            $value = '<h5>'.$customer->country.'</h5> <h6>'.$customer->currency_code.' - '.$customer->currency_name.'</h6>';
            $currency_name = $customer->currency_code.' ('.$currency.') - '.$customer->currency_name;
            $code = $customer->currency_code;
            echo json_encode(array('st' => 1, 'value' => $value, 'currency' => $currency, 'currency_name' => $currency_name, 'code' => $code));
        }
        
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
                redirect(base_url('admin/customers'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'phone' => $this->input->post('phone', true),
                    'address' => $this->input->post('address', true),
                    'cus_number' => $this->input->post('cus_number', true),
                    'vat_code' => $this->input->post('vat_code', true),
                    'country' => $this->input->post('country', true),
                    'currency' => $this->input->post('currency', true),
                    'address1' => $this->input->post('address1', true),
                    'address2' => $this->input->post('address2', true),
                    'city' => $this->input->post('city', true),
                    'postal_code' => $this->input->post('postal_code', true),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'customers');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {

                    if (check_package_limit('customer') != -2) {
                        $total = get_total_value('customers', 0);
                        if ($total >= check_package_limit('customer')):
                            $msg = trans('reached-limit').', '.trans('package-limit-msg');
                            $this->session->set_flashdata('error', $msg);
                            redirect(base_url('admin/customer'));
                            exit();
                        endif;
                    }

                    $id = $this->admin_model->insert($data, 'customers');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                redirect(base_url('admin/customer'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['page'] = 'Customers';
        $data['countries'] = $this->admin_model->select('country');
        $data['customer'] = $this->admin_model->select_option($id, 'customers');
        $data['main_content'] = $this->load->view('admin/user/customers',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'customers');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/customers'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'customers');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/customers'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'customers'); 
        echo json_encode(array('st' => 1));
    }


}