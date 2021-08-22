<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user()) {
            redirect(base_url());
        }
    }


    public function type($status=0)
    {
        $data = array();

        if (isset($_GET['credit_note']) && $_GET['credit_note'] == 'true') {
            $type = 4;
        } else {
            $type = 1;
        }

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/invoice/type/'.$status);
        
        if ($type == 4) {
            $total_row = $this->admin_model->get_credit_invoices_by_type(1 , 0, 0, $status, $type);
        } else {
            $total_row = $this->admin_model->get_invoices_by_type(1 , 0, 0, $status, $type);
        }

        $config['total_rows'] = $total_row;
        $config['per_page'] = 12;
        $this->pagination->initialize($config);
        
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Invoices';      
        $data['page'] = 'Invoice';
        $data['main_page'] = 'Sales';
        $data['status'] = $status;
        if ($type == 4) {
            $data['invoices'] = $this->admin_model->get_credit_invoices_by_type(0 , $config['per_page'], $page * $config['per_page'], $status, $type);
        } else {
            $data['invoices'] = $this->admin_model->get_invoices_by_type(0 , $config['per_page'], $page * $config['per_page'], $status, $type);
        }
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['main_content'] = $this->load->view('admin/user/invoices',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function create($type=0)
    {
        
        if (check_payment_status() == FALSE && settings()->enable_paypal == 1 && user()->user_type != 'trial'){
            $this->session->set_flashdata('error', 'Please complete your payment to unlock features'); 
            redirect(base_url('admin/subscription'));
        }

        $data = array();
        
        if ($type == 0) {
            $data['page_title'] = 'Create Invoice';  
        } else {
            $data['page_title'] = 'Create Recurring Invoice';  
        }
            
        $data['page'] = 'Invoice'; 
        $data['main_page'] = 'Sales'; 
        $data['type'] = $type; 
        $data['invoice'] = FALSE;
        $data['products'] = $this->admin_model->get_by_user_and_type('products', 'is_sell');
        $data['total_tax'] = $this->admin_model->get_invoice_total_taxes(0);
        $data['asign_taxs'] = $this->admin_model->get_invoice_taxes(0);
        $data['gsts'] = $this->admin_model->get_user_taxes_by_gst();
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['total'] = $this->admin_model->get_total_by_user('invoice', 1);
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['main_content'] = $this->load->view('admin/user/invoice_create',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function edit($id, $type=0)
    {
        $data = array();
        $data['page_title'] = 'Edit Invoice';      
        $data['page_sub'] = 'Edit';      
        $data['page'] = 'Invoice';
        $data['invoice'] = $this->admin_model->get_by_md5_data($id, 'invoice');
        $data['type'] = $data['invoice'][0]['recurring'];
        $data['products'] = $this->admin_model->get_by_user_and_type('products', 'is_sell');
        $data['total_tax'] = $this->admin_model->get_invoice_total_taxes($data['invoice'][0]['id']);
        $data['asign_taxs'] = $this->admin_model->get_invoice_taxes($data['invoice'][0]['id']);
        $data['gsts'] = $this->admin_model->get_user_taxes_by_gst();
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['total'] = $this->admin_model->get_total_by_user('invoice', 1);
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['main_content'] = $this->load->view('admin/user/invoice_create',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add_product($product_id, $customer_id)
    {   
        $product = $this->admin_model->get_by_id($product_id, 'products');
        $customer = $this->admin_model->get_customer_info($customer_id, 'customers');

        $data = array();
        $data['taxes'] = $this->admin_model->get_by_user('tax');
        $data['product'] = $product; 

        if (!empty($product)) {
            if (empty($customer)) {
                $currency = $this->business->currency_symbol;
            }else{

                if (empty($customer->currency_symbol)) {
                    $currency = $this->business->currency_symbol;
                } else {
                    $currency = $customer->currency_symbol;
                }
            }
            $loaded = $this->load->view('admin/user/include/product_list', $data, true);
            echo json_encode(array('st' => 1, 'loaded' => $loaded, 'currency' => $currency));
        }else{
            echo "Data not found";
        }
    }


    public function search_product($value, $type='')
    {   
        $products = $this->admin_model->search_product($value, $type);
        $data = array();
        $data['products'] = $products;
        if (!empty($products)) {
        
            $loaded = $this->load->view('admin/user/include/invoice_product_list', $data, true);
            echo json_encode(array('st' => 1, 'loaded' => $loaded));
        }else{
            echo json_encode(array('st' => 0));
        }
    }



    public function convert_currency($amount='', $from_currency='')
    {
        $result = ($amount / get_rate($from_currency)) * get_rate($this->business->currency_code);
        $rate = (1 / get_rate($from_currency)) * get_rate($this->business->currency_code);

        if ($from_currency == $this->business->currency_code) {
            $conversion = '';
            $convert_total = str_replace(",", "", $result);
        } else {
            if (empty($from_currency)) {
                $rate = '';
            }else{
                $rate = number_format($rate, 4);
            }
            $conversion = trans('currency-conversion').': ' . $this->business->currency_symbol . ' ' . number_format($result, 2) . ' (' . $this->business->currency_code . ') at ' . $rate;
            $convert_total = str_replace(",", "", $result);
        }
        echo json_encode(array('st' => 1, 'result' => $conversion, 'convert_total' => $convert_total));
    }



    public function convert_recurring($id)
    {   
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        $data=array(
            'recurring' => 1
        );
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');
        echo json_encode(array('st' => 1));
    }


    public function get_due_date($value)
    {   
        if ($value == 1) {$value = 0;} else {$value = $value;}
        $result = date('Y-m-d', strtotime('+'.$value.' days'));
        echo json_encode(array('st' => 1, 'result' => $result));
    }


    public function convert_credit_note($id)
    {   
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        $title = 'Credit Note';
        $data=array(
            'type' => 4,
            'title' => $title
        );
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');

        $data=array(
            'type' => 'revert'
        );
        $this->admin_model->update_payment_record($data, $invoice->id, 'payment_records');
        echo json_encode(array('st' => 1));
    }


    public function revert_credit_note($id)
    {   
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        $title = 'Invoice title';
        $data=array(
            'type' => 1,
            'title' => $title
        );
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');

        $data=array(
            'type' => 'income'
        );
        $this->admin_model->update_payment_record($data, $invoice->id, 'payment_records');
        echo json_encode(array('st' => 1));
    }

    
    //send email
    public function send($invoice_id)
    {   
          
        $customer_id = $this->input->post('customer_id', true);
        $is_myself = $this->input->post('is_myself', true);
        $invoice = $this->admin_model->get_invoice_details(md5($invoice_id));
        $customer = $this->admin_model->get_customer_info($customer_id);
        
        $data = array();
        if (isset($is_myself)) {
            $data['email_myself'] = $this->input->post('email_myself', true);
        } else {
            $data['email_myself'] = '';
        }

        if($invoice->type == 1){$type = 'Invoice';}else{$type = 'Estimate';};
        $data['email_to'] = $this->input->post('email_to', true);
        $data['message'] = $this->input->post('message', true);
        $data['subject'] = $this->input->post('subject', true);
        $data['logo'] = base_url($invoice->logo);
        $data['currency_code'] = $customer->currency_code;
        $data['currency_symbol'] = $customer->currency_symbol;
        $data['invoice'] = $invoice;
        $data['type'] = $type;
        $data['html_content'] = $this->load->view('email_template/invoice', $data, true);
        $send_data = $this->email_model->send($data['email_to'], $data['subject'], $data['html_content'], $data['email_myself']);
        
        if ($send_data == true) {
            $sent_data = array(
                'is_sent' => 1,
                'sent_date' => my_date_now()
            );
            $this->admin_model->edit_option($sent_data, $invoice_id, 'invoice');

            $data = array();
            $data['status'] = 1;
            echo json_encode($data);
        } else {
            $data = array();
            $data['status'] = 2;
            echo json_encode($data);
        }
        
    }


    public function save()
    {
        $data = array();
        $data['page_title'] = 'Invoice';      
        $data['page'] = 'Invoice'; 
        $data['products'] = $this->admin_model->get_by_user('invoice');
        $data['main_content'] = $this->load->view('admin/user/invoice_save',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function details($id)
    {
   
        $data = array();
        $data['invoice'] = $this->admin_model->get_invoice_details($id);
        $data['payment'] = $this->admin_model->check_invoice_payment_records($data['invoice']->id, $data['invoice']->parent_id);
        $data['page_title'] = 'Invoice details';      
        $data['page'] = 'Invoice'; 
        $data['main_content'] = $this->load->view('admin/user/invoice_save',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add()
    {
        $data = array();
        $id = $this->input->post('id', true);

        if ($this->settings->site_info == 1) {
            $total = $this->admin_model->count_invoices(1);
            if ($total > 20000) {
                $data['status'] = 4;
                echo json_encode($data);
                exit();
            }
        }
        //validate inputs
        $this->form_validation->set_rules('customer', trans('add-customer-error-msg'), 'required');
        if ($this->form_validation->run() === false) {
            $data['status'] = 3;
            $data['error'] = validation_errors();
            echo json_encode($data);
        } else {

            if (empty($this->input->post('tax'))) {
                $tax = 0;
            } else {
                $tax = $this->admin_model->get_by_id($this->input->post('tax'), 'tax');
                $tax = $tax->rate;
            }
            
            if (!empty($this->input->post('discount'))) {
                $discount = $this->input->post('discount');
            }else{
                $discount = 0;
            }

            if (!empty($id)) {
                $created_at = get_by_id($id, 'invoice')->created_at;
            }else{
                $created_at = my_date_now();
            }

            $customer = $this->admin_model->get_customer_info($this->input->post('customer'), 'customers');
            $convert_total = $this->convert_payment($this->input->post('grand_total'), $customer->currency_code);

            $invoice = array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'title' => $this->input->post('title', true),
                'summary' => $this->input->post('summary', true),
                'customer' => $this->input->post('customer', true),
                'number' => $this->input->post('number', true),
                'poso_number' => $this->input->post('poso_number', true),
                'recurring' => $this->input->post('is_recurring', true),
                'date' => $this->input->post('date', true),
                'discount' => $discount,
                'payment_due' => $this->input->post('payment_due', true),
                'due_limit' => $this->input->post('due_limit', true),
                'footer_note' => $this->input->post('footer_note'),
                'sub_total' => $this->input->post('sub_total', true),
                'grand_total' => $this->input->post('grand_total', true),
                'convert_total' => $convert_total,
                'created_at' => $created_at
            );
  
            $invoice = $this->security->xss_clean($invoice);
            if (!empty($id)) {
                $this->admin_model->delete_items($id, 'invoice_taxes');
                $this->admin_model->delete_items($id, 'invoice_items');

                $this->admin_model->edit_option($invoice, $id, 'invoice');

                // update recurring data
                if ($this->input->post('is_recurring') == 1) {
                    $recurring_data = array(
                        'recurring_start' => $this->input->post('recurring_start', true),
                        'recurring_end' => $this->input->post('recurring_end', true),
                        'frequency' => $this->input->post('frequency', true)
                    );
                    $this->admin_model->edit_option($recurring_data, $id, 'invoice');
                }
            } else {
                if (check_package_limit('invoice') != -2) {
                    $total = get_total_value('invoice', 1);
                    if ($total >= check_package_limit('invoice')):
                        $msg = trans('reached-limit').', '.trans('package-limit-msg');
                        $data['status'] = 5;
                        $data['error'] = $msg;
                        echo json_encode($data);
                        exit();
                    endif;
                }
                $id = $this->admin_model->insert($invoice, 'invoice');
            }
            
            $taxes = $this->input->post('taxes', true);
            if (!empty($taxes)) {
                foreach ($taxes as $tax) {
                    if ($tax != 0) {
                        $tax_data = array(
                            'invoice_id' => $id,
                            'tax_id' => $tax,
                        );
                        $this->admin_model->insert($tax_data, 'invoice_taxes');
                    }
                }
            }


            $product_id = $this->input->post('product_ids', true);
            $items = $this->input->post('items', true);
            $details = $this->input->post('details', true);
            $price = $this->input->post('price', true);
            $quantity = $this->input->post('quantity', true);
            $total_price = $this->input->post('total_price', true);

            if (!empty($items)) {
                for ($i=0; $i < count($items); $i++) { 

                    if ($product_id[$i] == 0) {
                        $product_data=array(
                            'user_id' => user()->id,
                            'business_id' => $this->business->uid,
                            'name' => $items[$i],
                            'price' => $price[$i],
                            'quantity' => 0,
                            'is_sell' =>1,
                            'income_category' => 0,
                            'is_buy' => 0,
                            'expense_category' => 0
                        );
                        $item_product_id = $this->admin_model->insert($product_data, 'products');
                    }else{
                        $item_product_id = $product_id[$i];
                    }
                    

                    $item_data = array(
                        'invoice_id' => $id,
                        'item' => $item_product_id,
                        'details' => htmlspecialchars($details[$i], ENT_QUOTES),
                        'price' => $price[$i],
                        'qty' => $quantity[$i],
                        'total' => $total_price[$i]
                    );
                    $this->admin_model->insert($item_data, 'invoice_items');
              
                    // if (!empty($details[$i])) {
                    //     $this->update_product($item_product_id, $details[$i]);
                    // }

                    if ($this->business->enable_stock == 1):
                        $this->update_quantity($product_id[$i], $quantity[$i]);
                    endif;
                }
            }

            $data['status'] = 2;
            $data['invoice_id'] = md5($id);
            echo json_encode($data);

        }
        
    }


    // update product
    public function update_product($product_id, $details)
    {
        $data = array(
            'details' => $details
        );
        if (!empty($product_id)) {
            $this->admin_model->edit_option($data, $product_id, 'products');
        }
    }

    // update quantity
    public function update_quantity($product_id, $quantity)
    {
        $product = $this->admin_model->get_by_id($product_id, 'products');
        if (!empty($product) && $product->quantity != 0) {
            $data = array(
                'quantity' => $product->quantity - $quantity
            );
            $this->admin_model->edit_option($data, $product->id, 'products');
        }
    }


    // load tax
    public function load_tax($id)
    {
        $tax = $this->admin_model->get_by_id($id, 'tax');
        if (empty($tax)) {
            echo 0;
        }else{
            echo $tax->rate;
        }
    }


    public function preview()
    {
        $data = array();

        if (empty($this->input->post('taxes'))) {
            $taxes = 0;
        } else {
            $taxes = $this->input->post('taxes');
        }

        $invoice = array(
            'title' => $this->input->post('title', true),
            'summary' => $this->input->post('summary', true),
            'customer' => $this->input->post('customer', true),
            'number' => $this->input->post('number', true),
            'poso_number' => $this->input->post('poso_number', true),
            'date' => $this->input->post('date', true),
            'taxes' => $taxes,
            'discount' => $this->input->post('discount', true),
            'payment_due' => $this->input->post('payment_due', true),
            'due_limit' => $this->input->post('due_limit', true),
            'footer_note' => $this->input->post('footer_note'),
            'sub_total' => $this->input->post('sub_total', true),
            'grand_total' => $this->input->post('grand_total', true),
            'convert_total' => $this->input->post('convert_total', true)
        );
        $this->session->set_userdata($invoice);


        $items = $this->input->post('items', true);
        $details = $this->input->post('details', true);
        if (!empty($items)) {
            for ($i=0; $i < count($items); $i++) { 
                if (!empty($details[$i])) {
                    $this->update_product($items[$i], $details[$i]);
                }
            }
        }


        $products = array(
            'item' => $this->input->post('items', true),
            'price' => $this->input->post('price', true),
            'details' => $this->input->post('details', true),
            'quantity' => $this->input->post('quantity', true),
            'total_price' => $this->input->post('total_price', true),
            'product_ids' => $this->input->post('product_ids', true)
        );
        $this->session->set_userdata($products);

        $data['page_title'] = 'Invoice Preview';      
        $data['page'] = 'Invoice'; 
        $load_data = $this->load->view('admin/user/invoice_preview', $data,TRUE);
        $data['status'] = 1;
        $data['load_data'] = $load_data;
        echo json_encode($data);
    }



    public function set_recurring($id)
    {   
        if($_POST)
        {   
            $invoice = $this->admin_model->get_by_id($id, 'invoice');
            
            if ($this->input->post('recurring_start') < date('Y-m-d')) {
                echo json_encode(array('st' => 2));
                exit();
            }
            
            $data=array(
                'recurring_start' => $this->input->post('recurring_start', true),
                'recurring_end' => $this->input->post('recurring_end', true),
                'frequency' => $this->input->post('frequency', true),
                'next_payment' => date_count($this->input->post('recurring_start'), $this->input->post('frequency')),
                'auto_send' => 0,
                'send_myself' => 0,
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->update($data, $id, 'invoice');
            echo json_encode(array('st' => 1));
        }      
        
    }


    public function stop_recurring($id)
    {   
        $data=array(
            'is_completed' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id, 'invoice');
        echo json_encode(array('st' => 1));
    }


    public function ajax_add_product($type='')
    {   
        if($_POST)
        {   
            
            if ($type == 'buy') {
                $is_buy = 1;
                $is_sell = 0;
                $product_type = 'is_buy';
            } else {
                $is_buy = 0;
                $is_sell = 1;
                $product_type = 'is_sell';
            }
            
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'price' => $this->input->post('price', true),
                'quantity' => $this->input->post('quantity'),
                'is_sell' => $is_sell,
                'income_category' => 0,
                'is_buy' => $is_buy,
                'expense_category' => 0,
                'details' => $this->input->post('details')
            );
            $data = $this->security->xss_clean($data);
            $id = $this->admin_model->insert($data, 'products');
            $data['products'] = $this->admin_model->get_by_user_and_type('products', $product_type);
            $load_product = $this->load->view('admin/user/include/invoice_product_list', $data,TRUE);
            echo json_encode(array('st' => 1, 'load_product' => $load_product));
        }
    }


    public function ajax_add_customer()
    {   
        if($_POST)
        {   
            $data=array();
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'country' => $this->input->post('country', true),
                'currency' => $this->input->post('currency', true),
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->insert($data, 'customers');
            $data['invoice'] = FALSE;
            $data['customers'] = $this->admin_model->get_by_user('customers');
            $load_customers = $this->load->view('admin/user/include/invoice_load_customers', $data,TRUE);
            echo json_encode(array('st' => 1, 'load_customers' => $load_customers));
        }
    }


    public function ajax_add_vendor()
    {   
        $data=array();
        if($_POST)
        {   
            $data=array(
                'user_id' => user()->id,
                'business_id' => $this->business->uid,
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'address' => $this->input->post('address', true)
            );
            $data = $this->security->xss_clean($data);
            $id = $this->admin_model->insert($data, 'vendors');
            $data['invoice'] = FALSE;
            $data['customers'] = $this->admin_model->get_by_user('vendors');
            $load_customers = $this->load->view('admin/user/include/load_vendors', $data,TRUE);
            echo json_encode(array('st' => 1, 'load_customers' => $load_customers));
        }
    }


    public function convert_payment($amount='', $from_currency='')
    {
        if (empty($from_currency)) {
            return $amount;
        } else {
            $result = ($amount / get_rate($from_currency)) * get_rate($this->business->currency_code);
            $rate = (1 / get_rate($from_currency)) * get_rate($this->business->currency_code);
            $convert_total = str_replace(",", "", $result);
            return $convert_total;
        }
    }


    public function update_record_payment($id)
    { 
        $invoice_id = $this->input->post('invoice_id', true);
        $amount = $this->input->post('amount', true);
        $payment_method = $this->input->post('payment_method', true);
        $invoice = $this->admin_model->get_by_md5_id($invoice_id, 'invoice');
        $customer = $this->admin_model->get_customer_info($invoice->customer, 'customers');

        $data=array(
            'payment_date' => $this->input->post('payment_date', true),
            'amount' => $amount,
            'convert_amount' => $this->convert_payment($amount, $customer->currency_code),
            'payment_method' => $payment_method,
            'note' => $this->input->post('note', true)
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id, 'payment_records');


        $total_payment = get_total_invoice_payments($invoice->id, $invoice->parent_id);
        if($amount == $invoice->grand_total){
            $status = 2;
        }else if ($amount < $invoice->grand_total) {
            if ($total_payment == $invoice->grand_total) {
                $status = 2;
            } else {
                $status = 1;
            }
        }

        if ($invoice->recurring == 1 && $status == 2) {
            $is_completed = 1;
        } else {
            $is_completed = 0;
        }

        $invoice_data=array(
            'status' => $status,
            'is_completed' => $is_completed
        );
        $this->admin_model->edit_option($invoice_data, $invoice->id, 'invoice');


        $this->session->set_flashdata('msg', trans('msg-updated'));
        redirect($_SERVER['HTTP_REFERER']);
    }


    //record invoice payment 
    public function record_payment()
    {   
        if($_POST)
        {   
            $id = $this->input->post('invoice_id', true);
            $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
            $customer = $this->admin_model->get_customer_info($invoice->customer, 'customers');
            $customer_record = $this->admin_model->get_customer_advanced_record($invoice->customer);

            if (!empty($this->input->post('is_autoload_amount'))) {
                $auto_load = $this->input->post('is_autoload_amount', true);
            } else {
                $auto_load = 0;
            }
            
            $amount_data=array(
                'is_autoload_amount' => $auto_load
            );
            $amount_data = $this->security->xss_clean($amount_data);
            $this->admin_model->edit_option($amount_data, $this->business->id, 'business');
            $business = $this->admin_model->get_by_id($this->business->id, 'business');


            if (!empty($customer_record) && $customer_record->customer_id == $invoice->customer) {
                if ($business->is_autoload_amount == 1) {
                    $amount = $this->input->post('amount', true);
                    $amount = $customer_record->amount+$amount;
                }else{
                    $amount = $this->input->post('amount', true);
                }
            } else {
                $amount = $this->input->post('amount', true);
            }

            if ($invoice->parent_id == 0) {
                $invoice_id = $invoice->id;
            } else {
                $invoice_id = $invoice->parent_id;
            }

            
            if (!empty($this->input->post('payment_method'))) {
                $payment_method = $this->input->post('payment_method', true);
            } else {
                $payment_method = '0';
            }

            $data=array(
                'payment_date' => $this->input->post('payment_date', true),
                'amount' => $amount,
                'convert_amount' => $this->convert_payment($amount, $customer->currency_code),
                'customer_id' => $invoice->customer,
                'invoice_id' => $invoice_id,
                'business_id' => $this->business->uid,
                'payment_method' => $payment_method,
                'note' => $this->input->post('note', true),
                'type' => 'income'
            );
            $data = $this->security->xss_clean($data);
            $id = $this->admin_model->insert($data, 'payment_records');

            $total_payment = get_total_invoice_payments($invoice->id, $invoice->parent_id);


            if($amount == $invoice->grand_total){
                $status = 2;

                if ($business->is_autoload_amount == 1) {
                    $adv_data=array(
                        'amount' => abs($invoice->grand_total - $amount)
                    );
                    if (!empty($customer_record) && $customer_record->customer_id == $invoice->customer) {
                        $this->admin_model->edit_option($adv_data, $customer_record->id, 'payment_advance');
                    }
                }
            }else if ($amount > $invoice->grand_total) {
                $status = 2;

                if ($business->is_autoload_amount == 1) {
                    $adv_data=array(
                        'amount' => abs($invoice->grand_total - $amount),
                        'customer_id' => $invoice->customer,
                        'business_id' => $this->business->uid,
                        'created_at' => my_date_now()
                    );

                    if (empty($customer_record)) {
                        $this->admin_model->insert($adv_data, 'payment_advance');
                    }else{
                        $this->admin_model->edit_option($adv_data, $customer_record->id, 'payment_advance');
                    }
                }
                

            }else if ($amount < $invoice->grand_total) {

                if ($total_payment == $invoice->grand_total) {
                    $status = 2;
                } else {
                    $status = 1;
                }
                
                if ($business->is_autoload_amount == 1) {
                    $adv_data=array(
                        'amount' => abs($invoice->grand_total - $amount)
                    );
                    if (!empty($customer_record) && $customer_record->customer_id == $invoice->customer) {
                        $this->admin_model->edit_option($adv_data, $customer_record->id, 'payment_advance');
                    }
                }
            }

            if (empty($this->input->post('due_date'))) {
                $due_date = date('Y-m-d');
            }else{
                $due_date = $this->input->post('due_date', true);
            }

            if ($invoice->recurring == 1 && $status == 2) {
                $is_completed = 1;
            } else {
                $is_completed = 0;
            }

            $invoice_data=array(
                'status' => $status,
                'payment_due' => $due_date,
                'is_completed' => $is_completed
            );
            $this->admin_model->edit_option($invoice_data, $invoice->id, 'invoice');

            redirect($_SERVER['HTTP_REFERER']);
        }      
        
    }

    public function approve_invoice($id) 
    {
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');
        echo json_encode(array('st' => 1));
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'invoice');
        $this->admin_model->delete_invoice_payments($id,'payment_records');
        echo json_encode(array('st' => 1));
    }

    public function delete_payment_record($id)
    {
        $this->admin_model->delete($id,'payment_records');
        echo json_encode(array('st' => 1));
    }


}
	

