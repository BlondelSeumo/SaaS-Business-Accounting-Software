<?php if (isset($page_title) && $page_title == 'Invoice Preview'){
    $status = 1;
    $logo = $this->business->logo;
    $color = $this->business->color;
    $business_name = $this->business->name;
    $business_address = $this->business->address;
    $country = $this->business->country;

    if (empty($this->session->userdata('customer'))) {
        $currency_symbol = $this->business->currency_symbol;
    } else {
        $currency_symbol = helper_get_customer($this->session->userdata('customer'))->currency_symbol;
        if (isset($currency_symbol)) {
            $currency_symbol = $currency_symbol;
        } else {
            $currency_symbol = $this->business->currency_symbol;
        }
    }

    $biz_number = $this->business->biz_number;
    $biz_vat_code = $this->business->vat_code;

    $cus_number = helper_get_customer($this->session->userdata('customer'))->cus_number;
    $cus_vat_code = helper_get_customer($this->session->userdata('customer'))->vat_code;

    $title = $this->session->userdata('title');
    $summary = $this->session->userdata('summary');
    $customer_id = $this->session->userdata('customer');
    $number = $this->session->userdata('number');
    $date = $this->session->userdata('date');
    $poso_number = $this->session->userdata('poso_number');
    $payment_due = $this->session->userdata('payment_due');
    $due_limit = $this->session->userdata('due_limit');
    $sub_total = $this->session->userdata('sub_total');
    $taxes = $this->session->userdata('taxes');
    $discount = $this->session->userdata('discount');
    $grand_total = $this->session->userdata('grand_total');
    $footer_note = $this->session->userdata('footer_note');
    $amount_due = '';
    $view_type = 'preview';
}else{
    
    $taxes = get_invoice_taxes($invoice->id);

    if (isset($this->business->color)) {
        $color = $this->business->color;
    } else {
        if (isset($invoice->color)) {
            $color = $invoice->color;
        } else {
            $color = '#2568ef';
        }
    }
    
    $status = $invoice->status;
    $logo = $invoice->logo;
    $color = $color;
    $business_name = $invoice->business_name;
    $business_address = $invoice->business_address;
    $country = $invoice->country;

    if ($invoice->type == 3) {
        $currency_symbol = $invoice->currency_symbol;
    } else {
        $currency_symbol = helper_get_customer($invoice->customer)->currency_symbol;
    }

    
    if (isset($currency_symbol)) {
        $currency_symbol = $currency_symbol;
    } else {
        $currency_symbol = $invoice->currency_symbol;
    }
    
    $biz_number = $invoice->biz_number;
    $biz_vat_code = $invoice->vat_code;

    $cus_number = helper_get_customer($invoice->customer)->cus_number;
    $cus_vat_code = helper_get_customer($invoice->customer)->vat_code;

    $title = $invoice->title;
    $summary = $invoice->summary;
    $customer_id = $invoice->customer;
    $number = $invoice->number;
    $date = $invoice->date;
    $poso_number = $invoice->poso_number;
    $payment_due = $invoice->payment_due;
    $due_limit = $invoice->due_limit;
    $sub_total = $invoice->sub_total;
    $taxes = $taxes;
    $discount = $invoice->discount;
    $grand_total = $invoice->grand_total;
    $footer_note = $invoice->footer_note;
    $view_type = 'live';
    $amount_due = $invoice->grand_total - get_total_invoice_payments($invoice->id, $invoice->parent_id);
}?>