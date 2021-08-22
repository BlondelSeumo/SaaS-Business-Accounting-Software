<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Home_Controller {

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
        $data =array();        
        $data['page_title'] = 'Reports';
        $data['main_page'] = 'Report';
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['categories'] = $this->admin_model->get_by_user('categories');
        $data['reports'] = '';
        $data['main_content'] = $this->load->view('admin/user/reports/reports', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function profit_loss()
    {
        $data =array();        
        $data['page_title'] = 'Profit & Loss';
        $data['main_page'] = 'Report';
        $data['incomes'] = $this->admin_model->get_profitloss_income_reports();
        $bills = $this->admin_model->get_profitloss_expense_reports();
        $expenses = $this->admin_model->get_profitloss_expense_reports2();
        $data['expenses'] = $bills + $expenses;
        $data['profitloss'] = number_format($data['incomes'] - $data['expenses'], 2);
        $data['main_content'] = $this->load->view('admin/user/reports/profit_loss', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function sales_tax()
    {
        $data =array();        
        $data['page_title'] = 'Sales Tax';
        $data['main_page'] = 'Report';
        $data['taxes'] = $this->admin_model->get_tax_reports();
        $data['main_content'] = $this->load->view('admin/user/reports/taxes', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function customers()
    {
        $data =array();        
        $data['page_title'] = 'Customers';
        $data['main_page'] = 'Report';
        $data['type'] = 1;
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['users'] = $this->admin_model->get_customer_reports(1);
        $data['main_content'] = $this->load->view('admin/user/reports/customers_vendors', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function vendors()
    {
        $data =array();        
        $data['page_title'] = 'Vendors';
        $data['main_page'] = 'Report';
        $data['type'] = 3;
        $data['customers'] = $this->admin_model->get_by_user('vendors');
        $data['users'] = $this->admin_model->get_customer_reports(3);
        //echo "<pre>"; print_r($data['users']); exit();
        $data['main_content'] = $this->load->view('admin/user/reports/customers_vendors', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function balance_sheet()
    {
        $data =array();        
        $data['page_title'] = 'Balance Sheet';
        $data['main_page'] = 'Report';
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        $data['categories'] = $this->admin_model->get_by_user('categories');

        $data['reports'] = '';
        $data['main_content'] = $this->load->view('admin/user/reports', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function generate()
    {
        $data =array();
        $data['page_title'] = 'Reports';
        $data['main_page'] = 'Report';
        $data['customers'] = $this->admin_model->get_by_user('customers');
        $data['vendors'] = $this->admin_model->get_by_user('vendors');
        if (isset($_GET['report_types']) && $_GET['report_types'] == 3) {
            //$data['reports'] = $this->admin_model->get_user_expense_reports();
            $data['reports'] = $this->admin_model->get_user_reports();
            $data['page_title'] = 'Income Reports';
        } else {
            $data['reports'] = $this->admin_model->get_user_reports();
            $data['page_title'] = 'Income Reports';
        }

        $data['main_content'] = $this->load->view('admin/user/reports/reports', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

}