<section class="section">
    <div class="container">

        <?php if (empty($faqs)): ?>
            <div class="text-center">
                <h3 class="ptb-200"><span><?php echo trans('no-data-founds') ?>!</span></h3>
            </div>
        <?php else: ?>

        <div class="section-heading section-heading--center">
            <h2 class="title"><?php echo trans('frequently-asked-questions') ?></h2>
        </div>

        <div class="spacer py-2"></div>

        <div class="row">
            <div class="col-12">

                <div class="content-container">
                    <!-- start FAQ -->
                    <div class="faq">
                        <div class="accordion-container">
                            
                            <!-- start item -->
                            <?php $i=1; foreach ($faqs as $row): ?>
                                <div class="accordion-item">
                                    <div class="accordion-toggler">
                                        <h4 class="accordion-title"><?php echo html_escape($row->title); ?></h4>
                                        <i class="circled"></i>
                                    </div>

                                    <article class="accordion-content" style="display: none;">
                                        <div class="accordion-contentinner">
                                            <p>
                                                <?= $row->details; ?>
                                            </p>
                                        </div>
                                    </article>
                                </div>
                            <?php $i++; endforeach; ?>
                            <!-- end item -->
                           
                        </div>
                    </div>
                    <!-- end FAQ -->
                </div>

            </div>
        </div>
        <?php endif; ?>
    </div>
</section>