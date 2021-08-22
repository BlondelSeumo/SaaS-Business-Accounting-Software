<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Readonly extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    

    public function export_pdf($id){

        $data = array();
        if (is_dir(APPPATH.'third_party/mpdf')) {
            $data['invoice'] = $this->admin_model->get_invoice_details($id);
            
            if($data['invoice']->type == 1){
                $type = 'Invoice';
            }else if($data['invoice']->type == 2){
                $type = 'Estimate';
            }else{
                $type = 'Bill';
            };

            $data['page_title'] = $type.' Export';      
            $data['page'] = $type;

            //load the view and saved it into $html variable
            $html=$this->load->view('admin/user/export_file', $data, TRUE);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $type.'-'.$data['invoice']->type.".pdf";

            //load mPDF library
            $this->load->library('m_pdf');

            //generate the PDF from the given html
            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        }else{
            $this->load->view('admin/user/mpdf_info',$data);
        }
    }


     public function export_invoice($id){

        $data = array();
        if (is_dir(APPPATH.'third_party/mpdf')) {
           
            $data['page_title'] = 'Export'; 
            $data['user'] = $this->admin_model->get_user_payment_details($id);

            //load the view and saved it into $html variable
            $html=$this->load->view('admin/payment_invoice_receipt', $data, TRUE);

            //this the the PDF filename that user will get to download
            $pdfFilePath = "payment-invoiec.pdf";

            //load mPDF library
            $this->load->library('m_pdf');

            //generate the PDF from the given html
            $this->m_pdf->pdf->WriteHTML($html);
          
            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        }else{
            $this->load->view('admin/user/mpdf_info',$data);
        }
    }



    public function estimate($mode, $id)
    {
        $data = array();
        $data['mode'] = $mode;       
        if ($mode == 'preview') {   
            $data['link'] = $_SERVER['HTTP_REFERER'];
        } 
        $data['invoice'] = $this->admin_model->get_readonly_invoice($id);
        $data['page_title'] = 'Estimate preview'; 
        $data['page'] = 'Estimate';
        $this->load->view('admin/user/estimate_view',$data);
    }

    public function invoice($mode, $id)
    {
        
        $data = array();
        $data['invoice'] = $this->admin_model->get_readonly_invoice($id);
        $data['mode'] = $mode;   
        if ($mode == 'preview') {   
            $data['link'] = $_SERVER['HTTP_REFERER'];
        } 

        if (isset($_GET['view'])) {  
            $view_data = array(
                'is_view' => 1,
                'view_date' => my_date_now()
            );
            $this->admin_model->edit_option($view_data, $data['invoice']->id, 'invoice');
        }

        $data['page_title'] = 'Invoice preview';      
        $data['page'] = 'Invoice';
        $this->load->view('admin/user/invoice_view',$data);
    }

    public function bill($mode, $id)
    {
        $data = array();
        $data['invoice'] = $this->admin_model->get_readonly_invoice($id);
        $data['mode'] = $mode;   
        if ($mode == 'preview') {   
            $data['link'] = $_SERVER['HTTP_REFERER'];
        } 
        $data['page_title'] = 'Invoice preview';      
        $data['page'] = 'Bill';
        $this->load->view('admin/user/bill_view',$data);
    }

    public function inv(){

        $invoice = $this->admin_model->get_by_md5_id(md5(1), 'invoice');
        $data = array();
        if (isset($is_myself)) {
            $data['email_myself'] = $this->input->post('email_myself', true);
        } else {
            $data['email_myself'] = '';
        }

        $data['email_to'] = $this->input->post('email_to', true);
        $data['message'] = $this->input->post('message', true);
        $data['subject'] = $this->input->post('subject', true);
        $data['invoice'] = $invoice;
        $this->load->view('email_template/invoice',$data);
    }


    public function approve($status, $id) 
    {
        $invoice = $this->admin_model->get_by_md5_id($id, 'invoice');
        if ($status == 1) {
            $reject_reason = '';
        } else {
            $reject_reason = $this->input->post('reject_reason');
        }
        
        $data = array(
            'status' => $status,
            'reject_reason' => $reject_reason,
            'client_action_date' => my_date_now(),
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $invoice->id, 'invoice');
        redirect($_SERVER['HTTP_REFERER']);
    }


    // not found page
    public function error_404()
    {
        $data['page_title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('error_404');
    }


}