
<section class="section">
    <div class="container">

        <?php if (empty($features)): ?>
            <div class="text-center">
                <h3 class="ptb-200"><span><?php echo trans('no-data-founds') ?>!</span></h3>
            </div>
        <?php else: ?>

        <div class="section-heading section-heading--center">
            <h2 class="title"><?php echo trans('explore-our-features') ?></h2>
        </div>

        <div class="spacer py-6"></div>
        <?php $i=1; foreach ($features as $feature): ?>
            <div class="row <?php if($i % 2 == 0){echo "flex-lg-row-reverse";} ?> align-items-md-center">
                <div class="col-12 col-lg-6">
                    <div class="section-heading">
                        <h3 class="title"><?php echo html_escape($feature->name); ?></h3>
                    </div>

                    <div class="spacer py-2"></div>

                    <div>
                        <p>
                            <?php echo strip_tags($feature->details); ?>
                        </p>
                    </div>
                </div>

                <div class="spacer py-4 d-lg-none"></div>

                <div class="col-12 col-lg-6  text-center text-lg-<?php if($i % 2 == 0){echo "left";}else{echo "right";} ?>">
                    <img class="img-fluid" width="520" height="507" src="<?php echo base_url($feature->image) ?>" alt="demo" />
                </div>
            </div>
        <?php $i++; endforeach; ?>

        <?php endif ?>
        
    </div>
</section>