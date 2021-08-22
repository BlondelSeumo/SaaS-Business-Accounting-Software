
<!-- start section -->
<section class="section">
	<div class="container">

		<?php if (empty($posts)): ?>
            <div class="text-center">
                <h3 class="ptb-200"><span><?php echo trans('no-data-founds') ?>!</span></h3>
            </div>
        <?php else: ?>

		<div class="section-heading">
			<h4 class="mb-2"><span><?php echo trans('categories') ?></span></h4>
			<?php foreach ($categories as $category): ?>
				 <a class="category-title mb-2" href="<?php echo base_url('category/'.$category->category_slug) ?>"><?php echo html_escape($category->category) ?></a>
			<?php endforeach ?>
			<?php if (isset($page_title) && $page_title == 'Category Posts'): ?>
				<h2><span><?php echo html_escape($title) ?></span></h2>
			<?php endif ?>
		</div>

		<div class="spacer py-2"></div>

		<div class="row">
			<div class="col-12">

				<!-- start posts -->
				<div class="posts posts--s2">
					<div class="inner">
						<div class="row">
							<!-- start item -->
							<?php foreach ($posts as $post): ?>
								<div class="col-12 col-sm-6 col-lg-4 d-sm-flex">
									<div class="item item--preview">
										<div class="header">
											<a href="<?php echo base_url('post/'.$post->slug) ?>">
												<figure class="image">
													<img width="303" height="223" src="<?php echo base_url($post->image) ?>" alt="demo" />
												</figure>
											</a>
										</div>

										<div class="body">
											<div class="content">
												<a class="post_category" href="<?php echo base_url('category/'.$post->category_slug) ?>">
													<?php echo html_escape($post->category) ?>
												</a>

												<h4 class="title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h4>

												<p>
													<?php echo character_limiter($post->details, 100)?>
												</p>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach ?>
							<!-- end item -->

						</div>
					</div>
				</div>
				<!-- end posts -->

				<!-- start pagination -->
				<div class="row">
					<div class="mt-md-12 text-center">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
				<!-- end pagination -->

			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
<!-- end section -->