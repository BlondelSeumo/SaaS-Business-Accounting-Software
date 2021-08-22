
<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    
    <?php if (!is_admin() && auth('role') != 'viewer'): ?>
      <?php if (check_payment_status() == TRUE || settings()->enable_paypal == 0 || user()->user_type == 'trial'): ?>
        <div id="floating-container">
          <div class="circle1 circle-blue1"></div>
          <div class="floating-menus" style="display:none;">
            <?php if (check_permissions(auth('role'), 'invoices') == TRUE): ?>
            <div>
              <a href="<?php echo base_url('admin/invoice/create') ?>"> <?php echo trans('create-new-invoice') ?>
              <i class="fa fa-file-text-o"></i></a>
            </div>
            <?php endif ?>

            <?php if (check_permissions(auth('role'), 'estimates') == TRUE): ?>
            <div>
              <a href="<?php echo base_url('admin/estimate/create') ?>"> <?php echo trans('create-new-estimate') ?>
              <i class="fa fa-file-text"></i></a>
            </div>
            <?php endif ?>

            <?php if (check_permissions(auth('role'), 'bills') == TRUE): ?>
            <div>
              <a href="<?php echo base_url('admin/bills/create') ?>"><?php echo trans('create-new-bill') ?>
              <i class="fa fa-file-text-o"></i></a>
            </div>
            <?php endif ?>
            
            <?php if (check_permissions(auth('role'), 'customers') == TRUE): ?>
            <div>
              <a href="<?php echo base_url('admin/customer') ?>"><?php echo trans('add-customer') ?>
              <i class="fa fa-user-o"></i></a>
            </div>
            <?php endif ?>
            
            <div>
              <a href="<?php echo base_url('admin/vendor') ?>"><?php echo trans('add-vendor') ?>
              <i class="fa ti-user"></i></a>
            </div>
          </div>
          <div class="fab-button">
            <i class="ti-plus" aria-hidden="true"></i>
          </div>
        </div>
      <?php endif ?>
    <?php endif ?>

  </div>
  
</footer>

<?php include'js_msg_list.php'; ?>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php $success = $this->session->flashdata('msg'); ?>
<?php $error = $this->session->flashdata('error'); ?>
<input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
<input type="hidden" id="error" value="<?php echo html_escape($error);?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<input type="hidden" id="browser" value="<?php echo $this->agent->browser(); ?>">

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- popper -->
<script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/admin/js/admin.js?var=<?php echo settings()->version ?>&time=<?=time();?>"></script>

<script src="<?php echo base_url() ?>assets/admin/js/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/html2canvas.min.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/template.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/jquery.invoice.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/wow.min.js"></script>

<!-- datatable export buttons -->
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/buttons.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/buttons.flash.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/jszip.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/pdfmake.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/vfs_fonts.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/buttons.html5.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/export_buttons/buttons.print.min.js"> </script>

<script src="<?php echo base_url() ?>assets/admin/js/bootstrap4-toggle.min.js"> </script>
<script src="<?php echo base_url() ?>assets/admin/js/summernote.js"> </script>




<?php $this->load->view('include/stripe-js'); ?>


<!-- datatable export buttons -->
<script type="text/javascript">
    $(document).ready(function() {

        $(function() {
          $(".ac-textarea").on("keyup input", function(){
              $(this).css('height', 'auto').css('height', this.scrollHeight+ 
              (this.offsetHeight - this.clientHeight));
          });
        });

        $("#summernote").summernote({
            height: 100,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph'] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ]
            ]
        });

        $('.dt_btn').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>


<!-- high charts js-->
<?php if (isset($page_title) && $page_title == 'User Dashboard' || $page_title == 'Dashboard'): ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<?php endif ?>


<script>

<?php if (isset($page_title) && $page_title == 'User Dashboard'): ?>
    
  
  var incomeData = <?php echo $income_data; ?>;
  var expenseData = <?php echo $expense_data; ?>;
  var incomeAxis = <?php echo $income_axis; ?>;

  Highcharts.chart('incomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          reversed: true,
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?> {point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?> {point.y}</b><br/>'
      },

      series: [
          {
              name: "<?php echo trans('income') ?>",
              data: incomeData,
              color: '#2568ef'
          },
          {
              name: "<?php echo trans('expense') ?>",
              data: expenseData,
              color: '#67757c'
          }
      ]
  });

<?php endif ?>

<?php if (isset($page_title) && $page_title == 'Dashboard'): ?>
    
  var incomeData = <?php echo $income_data; ?>;
  var incomeAxis = <?php echo $income_axis; ?>;

  Highcharts.chart('adminIncomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          reversed: true,
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?>{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?>{point.y}</b><br/>'
      },

      series: [
          {
              name: "<?php echo trans('income') ?>",
              data: incomeData,
              color: '#2568ef'
          }
      ]
  });


  //users packages share pie chart

  Highcharts.chart('packagePie', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  credits: {
      enabled: false
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Users',
    colorByPoint: true,
    
    data: [
        <?php 
          foreach ($upackages as $upackage) {
            echo '{
                  name: "'.$upackage->name.'",
                  y: '.$upackage->total.'
                },';
          }
        ?>
      ]
  }]
  });

<?php endif ?>

</script>
<!-- high charts js end-->

<script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>


<!-- bt-switch -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-switch.min.js"></script>
<script type="text/javascript">
$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
var radioswitch = function() {
    var bt = function() {
        $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioState")
        }), $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
        }), $(".radio-switch").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
        })
    };
    return {
        init: function() {
            bt()
        }
    }
}();
$(document).ready(function() {
    radioswitch.init()
});
</script>

  
    <!-- Style switcher -->
    <script src="<?php echo base_url() ?>assets/admin/js/jQuery.style.switcher.js"></script>

    <script type="text/javascript">
      <?php if (isset($success)): ?>
      $(document).ready(function() {
        var msg = $('#success').val();
        var msg_success = $('.msg_success').val();

        $.toast({
          heading: msg_success,
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'success',
          hideAfter: 8000
        });

      });
      <?php endif; ?>


      <?php if (isset($error)): ?>
      $(document).ready(function() {
        var msg = $('#error').val();
        var msg_error = $('.msg_error').val();

        $.toast({
          heading: msg_error,
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'error',
          hideAfter: 8000
        });

      });
      <?php endif; ?>
    </script>

    <script>
        ! function(window, document, $) {
            "use strict";
          $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);

        $(document).ready(function() {
            $('.datatable').dataTable();
            $('.multiple_select').select2();
            $('.single_select').select2();
        });
    </script>

    <script type="text/javascript">
      jQuery('.datepicker').datepicker({
          format: 'yyyy-mm-dd'
      });

      //colorpicker start
      $('.colorpicker-default').colorpicker({
          format: 'hex'
      });
      $('.colorpicker-rgba').colorpicker();

    </script>

    <!-- <script>
        CKEDITOR.replace('ckEditor', {
            language: 'en',
            filebrowserImageUploadUrl: "<?php //echo base_url(); ?>admin/post/upload_ckimage_post?key=kgh764hdj990sghsg46r"
        });
    </script> -->

    <?php if (isset($page_sub) && $page_sub == 'Edit'): ?>
      <script type="text/javascript">
        $(document).ready(function() {
            var Id = $('#customer').val();
            var base_url = $('#base_url').val();
            if(Id != ''){
                var url = base_url+'admin/customer/load_customer_info/'+Id;
                $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                  if(json.st == 1){
                    $('#load_info').html(json.value);
                    $('.currency_wrapper').html(json.currency);
                    $('.currency_name').html(json.currency_name);
                    $('.currency_code').val(json.code);
                  }
                }, 'json' );
            }else{
              $('.currency_wrapper').html('');
              $('#load_info').html('Select a customer');
            }
        });
      </script>
    <?php endif ?>


    <?php if (isset($page_sub) && $page_sub == 'Edit Bill'): ?>
      <script type="text/javascript">
        $(document).ready(function() {
            var Id = $('#vendors').val();
            var base_url = $('#base_url').val();
            if(Id != ''){
                var url = base_url+'admin/vendor/load_customer_info/'+Id;
                $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                  if(json.st == 1){
                    $('#load_info').html(json.value);
                    $('.currency_wrapper').html(json.currency);
                    $('.currency_name').html(json.currency_name);
                    $('.currency_code').val(json.code);
                  }
                }, 'json' );
            }else{
              $('.currency_wrapper').html('');
              $('#load_info').html('Select a vendor');
            }
        });
      </script>
    <?php endif ?>


    <?php if (isset($page) && $page == 'Invoice' || isset($page) && $page == 'Create' || isset($page) && $page == 'Bill'): ?>
      <script type="text/javascript">
        $(document).on("click",function(){
            var base_url = $('#base_url').val();
            var total = $('.grandtotal').val();
            var code = $('.currency_code').val();

            var url = base_url+'admin/invoice/convert_currency/'+total+'/'+code;
            $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
               if(json.st == 1){
                  $('.conversion_currency').html(json.result);
                  $('.convert_total').val(json.convert_total);
                }
            }, 'json' );
        });
      </script>
    <?php endif ?>

</body>
</html>
