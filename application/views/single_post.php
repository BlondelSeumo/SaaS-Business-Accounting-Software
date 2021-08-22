
<!-- start section -->
<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-9">
				<div class="content-container">
					<!-- start posts -->
					<div class="posts">
						<div class="item">
							<img class="img-fluid" width="878" height="586" src="<?php echo base_url($post->image) ?>" alt="demo" />

							<div class="mt-6 mt-lg-10 mb-lg-4">
								<div class="row align-items-sm-center justify-content-sm-between">
									<div class="col-12 col-sm-auto mb-4">
										<div class="post-author">
											<div class="d-table">
												<div class="d-table-cell align-middle">
													<span class="post-authorname"><?php echo html_escape($post->category) ?></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-12 col-sm-auto mb-4">
										<time> <?php echo my_date_show($post->created_at) ?></time>
									</div>
								</div>
							</div>

							<h3>
								<?php echo html_escape($post->title) ?>
							</h3>

							<p>
								<?php echo $post->details; ?>
							</p>

							<?php if (!empty($tags)): ?>
								<div class="my-6 my-md-11">
									<div class="h5"><?php echo trans('tags') ?>:</div>
									<div class="tags-list">
										<ul class="">
											<?php foreach ($tags as $tag): ?>
												<li><a href="#"><?php echo html_escape($tag->tag) ?></a></li>
											<?php endforeach ?>
										</ul>
									</div>
								</div>
							<?php endif ?>

							<div>
								<div class="share-btns">
								</div>
							</div>

						</div>
					</div>
					<!-- end posts -->
				</div>

				<?php if (!empty($comments)): ?>
					<div class="py-3 py-md-6 py-lg-12">
						<h4 class="mb-6"><?php echo trans('comments') ?> - (<?php echo html_escape(count($comments)) ?>)</h4>
						<!-- start comments list -->
						<ul class="comments-list">
							
							<li class="comment">
								<table>
									<?php foreach ($comments as $comment): ?>
									<tr>
										<td class="align-top">
											<div class="d-none d-lg-block">
												<div class="commentauthor-img">
													<img class="img-fluid" width="70" height="70" src="img/ava_1.jpg" alt="demo" />
												</div>
											</div>
										</td>

										<td class="align-top" width="100%">
											<div class="d-flex align-items-center mb-3 mb-lg-0">
												<div class="d-block d-lg-none">
													<div class="commentauthor-img">
														<img class="img-fluid" width="70" height="70" src="img/ava_1.jpg" alt="demo" />
													</div>

												</div>
												<span class="commentauthor-name"><?php echo html_escape($comment->name); ?> &emsp; <time class="post-metaitem date-post"><?php echo my_date_show($comment->created_at); ?></time></span>
											</div>

											<p>
												<?php echo html_escape($comment->message); ?>
											</p>
										</td>
									</tr>
									<?php endforeach ?>
								</table>
							</li>
							
						</ul>
						<!-- end comments list -->
					</div>
				<?php endif; ?>

				<div class="pt-3 pt-md-6 pt-lg-12">
					<h4 class="mb-6"><?php echo trans('send') ?></h4>

					<form method="post" class="site-form" action="<?php echo base_url('home/send_comment/'.html_escape($post->id)); ?>">
						<div class="row">
							<div class="col-12 col-sm-6">
								<div class="input-wrp">
									<input class="textfield textfield--grey" name="name" type="text" placeholder="<?php echo trans('full-name') ?>" />
								</div>
							</div>

							<div class="col-12 col-sm-6">
								<div class="input-wrp">
									<input class="textfield textfield--grey" name="email" type="text" placeholder="<?php echo trans('email') ?>" required inputmode="email" x-inputmode="email" />
								</div>
							</div>
						</div>

						<div class="input-wrp">
							<textarea class="textfield textfield--grey" name="message" placeholder="<?php echo trans('comments') ?>" required></textarea>
						</div>

						<!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

						<button class="btn btn-sm btn-primary" type="submit" role="button"><?php echo trans('post-comment') ?></button>
					</form>
				</div>

			</div>

			<div class="spacer py-4 d-lg-none"></div>

			<div class="col-12 col-lg-4 col-xl-3">

				<!-- start sidebar -->
				<aside class="sidebar">
					<!-- start widget -->
					<div class="widget widget--categories">
						<h4 class="widget-title"><?php echo trans('category') ?></h4>

						<ul class="list">
							<?php foreach ($categories as $category): ?>
								<li class="listitem">
									<a class="listitemlink" href="<?php echo base_url('category/'.$category->slug) ?>"><?php echo html_escape($category->name) ?><span class="post-count"><?php echo count_posts_by_categories($category->id) ?></span></a>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<!-- end widget -->

					<!-- start widget -->
					<div class="widget widget--posts">
						<h4 class="widget-title"><?php echo trans('related-posts') ?></h4>

						<div>
							<?php foreach ($related_posts as $post): ?>
							<article>
								<div class="row no-gutters">
									<div class="col-auto image-wrap">
										<figure class="image">
											<a href="<?php echo base_url('post/'.$post->slug) ?>">
												<img src="<?php echo base_url($post->image) ?>" alt="demo" />
											</a>
										</figure>
									</div>

									<div class="col">
										<h5 class="title"><a href="<?php echo base_url('post/'.$post->slug) ?>"><?php echo html_escape($post->title) ?></a></h5>

										<div class="post-meta">
											<time class="post-metaitem date-post"><?php echo my_date_show($post->created_at) ?></time>
										</div>
									</div>
								</div>
							</article>
							<?php endforeach ?>
						</div>
					</div>
					<!-- end widget -->

					<!-- start widget -->
					<div class="widget widget--banner">
						<a href="#">
							<img class="img-fluid lazy" width="271" height="305" src="img/blank.gif" data-src="img/widget_banner.jpg" alt="demo" />
						</a>
					</div>
					<!-- end widget -->
				</aside>
				<!-- end sidebar -->

			</div>
		</div>
	</div>
</section>
<!-- end section -->