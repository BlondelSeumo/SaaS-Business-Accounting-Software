<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function all($type='')
    {
        $data = array();
        $data['page_title'] = 'Products';      
        $data['page'] = 'Product';   
        if ($type == 'buy') {
            $data['main_page'] = 'Purchases';   
        } else {
            $data['main_page'] = 'Sales';   
        }
        $data['type'] = $type;   
        $data['product'] = FALSE;
        $data['products'] = $this->admin_model->get_by_user_and_type('products', 'is_'.$type);
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['income_category'] = $this->admin_model->get_product_categories($type=1);
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/products',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            $type = $this->input->post('type', true);
            
            //validate inputs
            $this->form_validation->set_rules('name', "Product", 'required');
            $this->form_validation->set_rules('price', "Price", 'required');
            
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {

                if (!empty($this->input->post('income_category'))) {
                    $income_category = $this->input->post('income_category');
                } else {
                    $income_category = 0;
                }

                if (!empty($this->input->post('expense_category'))) {
                    $expense_category = $this->input->post('expense_category');
                } else {
                    $expense_category = 0;
                }

                if (!empty($this->input->post('quantity'))) {
                    $quantity = $this->input->post('quantity');
                } else {
                    $quantity = 0;
                }
                
                if (!empty($this->input->post('is_both'))) {
                    $is_sell = 1;
                    $is_buy = 1;
                } else {
                    $is_sell = $this->input->post('is_sell', true);
                    $is_buy = $this->input->post('is_buy', true);
                }

                
                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'name' => $this->input->post('name', true),
                    'price' => $this->input->post('price', true),
                    'is_sell' => $is_sell,
                    'income_category' => $income_category,
                    'is_buy' => $is_buy,
                    'expense_category' => $expense_category,
                    'details' => $this->input->post('details'),
                    'quantity' => $quantity
                );
                $data = $this->security->xss_clean($data);
                
                if ($id != '') {
                    //$this->admin_model->delete_tax($id, 'product_tax');
                    $this->admin_model->edit_option($data, $id, 'products');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'products');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }

                redirect(base_url('admin/product/all/'.$type));

            }
        }      
        
    }

    public function edit($id, $type)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['type'] = $type;
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['selected_tax'] = $this->admin_model->get_tax_by_product($id);
        $data['product'] = $this->admin_model->select_option($id, 'products');
        $data['income_category'] = $this->admin_model->get_product_categories($type=1);
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/products',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'products'); 
        echo json_encode(array('st' => 1));
    }

}
	

