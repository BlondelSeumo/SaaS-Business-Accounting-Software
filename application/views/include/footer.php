    </main>
    <!-- end main -->

    <!-- start footer -->
    <?php if (isset($page_title) && $page_title != 'Register'): ?>
        <footer class="footer footer--s3 footer--color-dark">
            <div class="footerline footerline--first">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-5">
                            <div class="footeritem">
                                <a class="footerlogo site-logo" href="<?php echo base_url() ?>">
                                    <img src="<?php echo base_url(settings()->logo) ?>" width="159" alt="demo" />
                                </a>
                            </div>

                            <div class="footeritem">
                                <?php echo html_escape(settings()->footer_about) ?>
                            </div>
                        </div>


                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="footeritem">
                                <nav id="footernavigation" class="footernavigation">
                                    <?php if (!empty(get_pages())): ?>
                                    <ul>
                                        <li><a class="eb" href="#"><?php echo trans('pages') ?></a></li>
                                        <?php foreach (get_pages() as $page): ?>
                                            <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <?php endif ?>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12 col-md-5 col-lg-4">
                            <div class="footeritem">
                                <nav id="footernavigation" class="footernavigation">
                                    <ul>
                                        <li><a class="eb" href="#"><?php echo trans('resourcess') ?></a></li>
                                        <li><a href="<?php echo base_url('features') ?>"><?php echo trans('features') ?></a></li>
                                        <li><a href="<?php echo base_url('pricing') ?>"><?php echo trans('pricing') ?></a></li>
                                        <li><a href="<?php echo base_url('blog') ?>"><?php echo trans('blogs') ?></a></li>
                                        <li><a href="<?php echo base_url('faqs') ?>"><?php echo trans('faqs') ?></a></li>
                                        <li><a href="<?php echo base_url('contact') ?>"><?php echo trans('contact') ?></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                
                    </div>

                    <div class="spacer py-4 py-sm-2"></div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <span class="copys"><?php echo html_escape(settings()->copyright) ?></span>
                        </div>
                    </div>
                </div>
            </div>


        </footer>
    <?php endif; ?>
    <!-- end footer -->

    <?php include'js_msg_list.php'; ?>

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <?php $success = $this->session->flashdata('msg'); ?>
    <?php $error = $this->session->flashdata('error'); ?>
    <input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
    <input type="hidden" id="error" value="<?php echo html_escape($error);?>">

    <input type="hidden" class="accept_cookies" value="<?php echo trans('accept-cookies') ?>">
    <input type="hidden" class="accept" value="<?php echo trans('accept') ?>">
    </div>
    

    <script src="<?php echo base_url() ?>assets/front/js/jquery-2.2.4.min.js"></script>

    <!-- Popper JS -->
    <script src="<?php echo base_url() ?>assets/front/js/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script>

    <!-- gdpr compliance code -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/jquery.cookieMessage.min.js"></script>
    <script type="text/javascript">
        var cookieMsg = $('.accept_cookies').val();
        var accept = $('.accept').val();
        $.cookieMessage({
            'mainMessage': cookieMsg,
            'acceptButton': accept,
            'fontSize': '16px',
            'backgroundColor': '#222',
        });
    </script>
    <!-- gdpr compliance code -->


    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/main.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/custom.js?var=1.9&time=<?=time();?>"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>


    <script src="<?php echo base_url() ?>assets/front/js/aos.js"></script>
    <script>AOS.init();</script>

    <script>
        $(document).ready(function() {
            $('.multiple_select').select2();
            $('.single_select').select2();
        });
    </script>

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
              hideAfter: 4500
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
              hideAfter: 4500
            });
          });
      <?php endif; ?>
    </script>

    <?php $this->load->view('include/stripe-js'); ?>

</body>
</html>