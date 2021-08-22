<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense extends Home_Controller {

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
        $data['page_title'] = 'Expense';      
        $data['page'] = 'Expense';   
        $data['main_page'] = 'Purchases'; 
        $data['expense'] = FALSE;
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['expenses'] = $this->admin_model->get_user_expenses();        
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/expenses',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            //validate inputs
            $this->form_validation->set_rules('amount', "Amount", 'required|max_length[100]');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/expense'));
            } else {

                $file_name = 'expense_'.random_string('numeric',4).'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                $tax = $this->input->post('tax', true);
                if(!empty($tax)){$tax = $tax;}else{$tax = 0;};
                if(!empty($this->input->post('vendor', true))){$vendor = $this->input->post('vendor', true);}else{$vendor = 0;};
                $amount = $this->input->post('amount', true);
                $net_amount = $amount + ($amount * $tax/100);


                if (empty($_FILES['file']['name'])) {
                    if ($id != '') {
                        $expense = $this->admin_model->get_by_id($id, 'expenses');
                        $file_name = $expense->file;
                    }else{
                        $file_name = '';
                    }
                    
                } else {
                    $file_name = $file_name;
                }
                

                $data=array(
                    'user_id' => user()->id,
                    'business_id' => $this->business->uid,
                    'amount' => $this->input->post('amount', true),
                    'net_amount' => $net_amount,
                    'tax' => $tax,
                    'category' => $this->input->post('category', true),
                    'vendor' => $vendor,
                    'notes' => $this->input->post('notes', true),
                    'file' => $file_name,
                    'date' => $this->input->post('date', true),
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'expenses');
                    $this->session->set_flashdata('msg', trans('msg-updated')); 
                } else {
                    $id = $this->admin_model->insert($data, 'expenses');
                    $this->session->set_flashdata('msg', trans('msg-inserted')); 
                }


                if (!empty($_FILES['file']['name'])) {

                    $config['upload_path']          = './uploads/files'; //file save path
                    $config['allowed_types']        = 'pdf|gif|jpg|png|JPG|GIF|PNG|jpeg|JPEG';
                    $config['max_size']             = 10000;
                    $config['file_name'] = $file_name;


                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('file')){
                        $error = array('error' => $this->upload->display_errors());
                    }else{
                        $data = array('upload_data' => $this->upload->data());
                    }
                }

                
                redirect(base_url('admin/expense'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['expense'] = $this->admin_model->select_option($id, 'expenses');        
        $data['expense_category'] = $this->admin_model->get_product_categories($type=2);
        $data['main_content'] = $this->load->view('admin/user/expenses',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function download($id)
    {
        $this->load->helper('download');
        $expense = $this->admin_model->get_by_id($id, 'expenses');  
        $link = base_url('uploads/files/'.$expense->file);
        $data = file_get_contents($link);
        $name = $expense->file;
        force_download($name, $data); 
        $this->session->set_flashdata('msg', $file.'File Downloaded Successfully');
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'Expenses');
        $this->session->set_flashdata('msg', trans('msg-activated')); 
        redirect(base_url('admin/expense'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'expenses');
        $this->session->set_flashdata('msg', trans('msg-deactivated')); 
        redirect(base_url('admin/expense'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'expenses'); 
        echo json_encode(array('st' => 1));
    }

}
	

