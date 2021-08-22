

(function($) {
"use strict";


  var loading_html = '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var loader_md = '<div class="container text-center" style="padding: 100px"><div class="spinner-md"></div></div>';
  var loader_btn = '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
  var base_url = $('#base_url').val();


  var msg_opps = $('.msg_opps').val();
  var msg_error = $('.msg_error').val();
  var msg_success = $('.msg_success').val();
  var msg_sorry = $('.msg_sorry').val();
  var msg_yes = $('.msg_yes').val();
  var msg_congratulations = $('.msg_congratulations').val();
  var msg_something_wrong = $('.msg_something_wrong').val();
  var msg_try_again = $('.msg_try_again').val();
  var msg_valid_user_msg = $('.msg_valid_user_msg').val();
  var msg_password_reset_msg = $('.msg_password_reset_msg').val();
  var msg_password_reset_success_msg = $('.msg_password_reset_success_msg').val();
  var msg_confirm_pass_not_match_msg = $('.msg_confirm_pass_not_match_msg').val();
  var msg_old_password_doesnt_match = $('.msg_old_password_doesnt_match').val();
  var msg_inserted = $('.msg_inserted').val();
  var msg_made_changes_not_saved = $('.msg_made_changes_not_saved').val();
  var msg_no_data_founds = $('.msg_no_data_founds').val();
  var msg_del_success = $('.msg_del_success').val();
  var msg_account_suspend_msg = $('.msg_account_suspend_msg').val();
  var msg_are_you_sure = $('.msg_are_you_sure').val();
  var msg_get_started = $('.msg_get_started').val();
  var msg_not_recover_file = $('.msg_not_recover_file').val();
  var msg_deleted_successfully = $('.msg_deleted_successfully').val();
  var msg_data_limit_over = $('.msg_data_limit_over').val();
  var msg_email_exist = $('.msg_email_exist').val();
  var msg_recaptcha_is_required = $('.msg_recaptcha_is_required').val();


  var needToConfirm=false;
  var form_original_data = $(".leave_con").serialize();

  $('[data-toggle="tooltip"]').tooltip(); 
	

    $(".checkItem").on('click', function() {
        if ($(".checkItem").is(":checked")) {
            $(".multiple_delete_btn").show()
        } else {
            $(".multiple_delete_btn").hide()
        }
    });

    $(".agree_btn").on('click', function() {
        if ($(".agree_btn").is(":checked")) {
            $('.submit_btn').prop('disabled', false);
        } else {
            $('.submit_btn').prop('disabled', true);
        }
    });


    $(".switch_price").on('click', function() {
        var priceVal = $(this).val();
        
        if (priceVal == 'monthly') {
            $('.monthly_show').show();
            $('.yearly_show').hide();
            $('.price_year').hide();
            $('.price_month').show();
            $('.monthly_row').show();
            $('.yearly_row').hide();
            $('.bill_type').html('per month');
            $('.billing_type').val('monthly');
        } else {
            $('.monthly_show').hide();
            $('.yearly_show').show();
            $('.price_month').hide();
            $('.price_year').show();
            $('.yearly_row').show();
            $('.monthly_row').hide();
            $('.bill_type').html('per year');
            $('.billing_type').val('yearly');
        }
    });



    $(".switch_payment").on('click', function() {
        var paymentVal = $(this).val();
        
        if (paymentVal == 'paypal') {
            $('.paypal_area').show();
            $('.stripe_area').hide();
        } else {
            $('.paypal_area').hide();
            $('.stripe_area').show();
        }
    });

    


    $(document).on('click', ".inv-item", function() {
        var Id = $(this).attr('data-id');
        var customerData = $('#customer').val();
        if (customerData == '') {var customerId = 0;}else{var customerId = customerData;}

        var url = base_url+'admin/invoice/add_product/'+Id+'/'+customerId;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){
              $("#add_item").append(json.loaded);
              $('.currency_wrapper').html(json.currency);
          }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".package_btn", function() {
        form_original_data = $(".leave_con").serialize();  
        var billType = $('.billing_type').val();
        var url = $(this).attr('href')+'/'+billType;

        $('.pricing_area').hide();
        $(".loader").html(loading_html);
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){  
              window.location.href = json.url;
          }else{
            $('.pricing_area').show();
          }
        }, 'json' );
        return false;
    });


    $(document).on('click', ".price_package_btn", function() {
        var billType = $('.billing_type').val();
        var url = $(this).attr('href')+'&billing='+billType;
        window.location.href=url;
        return false;
    });


    $(function(){
        $(document).on('submit', "#register_form", function() {
            form_original_data = $(".leave_con").serialize();
            
            $(".loader_btn").html(loader_btn);
            $.post($('#register_form').attr('action'), $('#register_form').serialize(), function(json){
                if (json.st == 1) {   
                    $('#register_form')[0].reset();
                    $('.account_area').hide();
                    $('.step_1').removeClass('active');
                    $('.step_2').addClass('active');
                    $('.business_area').show();
                }else if (json.st == 2) {
                    $(".loader_btn").html(msg_get_started);
                    swal({
                      title: msg_opps,
                      text: msg_email_exist,
                      type: "error",
                      showConfirmButton: true
                    });
                }else if (json.st == 3) {
                    $(".loader_btn").html(msg_get_started);
                    swal({
                      title: msg_opps,
                      text: msg_recaptcha_is_required,
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $(".loader_btn").html(msg_get_started);
                    $('#register_form')[0].reset();
                    swal({
                      title: msg_error,
                      text: json.st,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });


    $(function(){
        $(document).on('submit', "#business_form", function() {
            form_original_data = $(".leave_con").serialize(); 
            
            $(".loader_btn2").html(loader_btn);
            $.post($('#business_form').attr('action'), $('#business_form').serialize(), function(json){
                if (json.st == 1) {  
                    $('#business_form')[0].reset();
                    $('.account_area').hide();
                    $('.business_area').hide();
                    $('.step_3').addClass('active');
                    $('.pricing_area').show();
                }else if (json.st == 3) {  
                    window.location.href = base_url+'admin/subscription';
                }else {
                    $('#business_form')[0].reset();
                    $(".loader_btn2").html('Create');
                    swal({
                      title: msg_error,
                      text: json.st,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });



    $(function(){
        $(document).on('submit', "#cahage_pass_form", function() {
            $.post($('#cahage_pass_form').attr('action'), $('#cahage_pass_form').serialize(), function(json){
                if (json.st == 1) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                          title: msg_congratulations,
                          text: msg_password_reset_success_msg,
                          type: "success",
                          showConfirmButton: true
                    });
                }else if (json.st == 2) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: msg_opps,
                      text: msg_confirm_pass_not_match_msg,
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: msg_error,
                      text: msg_old_password_doesnt_match,
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });
    });



    $(document).on('change', ".sort", function() {
        $('.sort_form').submit();
    });

    
    $(document).on('click', ".add_btn", function() {
        $('.add_area').show();
        $('.list_area').hide();
        return false;
    });

    $(document).on('click', ".cancel_btn", function() {
        $('.add_area').hide();
        $('.list_area').show();
        return false;
    });


    $(document).on('click', ".delete_item", function() {

        var del_url = $(this).attr('href');
        var itemId = $(this).attr('data-id');


            swal({
              title: msg_are_you_sure,
              text: msg_not_recover_file,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: msg_yes,
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: msg_success,
                          text: msg_del_success,
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+itemId).slideUp();
                    }
                },'json');

            });

        return false;

    });



    $(document).on('click', ".change_pass", function() {
        $('.change_password_area').slideDown();
        $('.edit_account_area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $(document).on('click', ".cancel_pass", function() {
        $('.change_password_area').hide();
        $('.edit_account_area').slideDown();
        return false;
    });


    $(window).on('bind', "beforeunload", function(e) {
        if ($(".leave_con").serialize() != form_original_data) {
            var needToConfirm = true;
        }
        if(needToConfirm)
            return msg_made_changes_not_saved;
        else 
        e=null; // i.e; if form state change show warning box, else don't show it.
    });


})(jQuery);