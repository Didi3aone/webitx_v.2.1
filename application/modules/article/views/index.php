<?php $this->load->view('article/right-sidebar'); ?>
		<div class="col-lg-9 order-lg-1">
			<div class="blog-posts">
				<?php 
					if(!empty($data)) :
						foreach( $data as $key => $val ) :
							$title 		= $val['title'];
							$seo_url 	= $val['seo_url'];
							$photo   	= $val['photo_real'];
							$content 	= $val['content'];
							$created 	= $val['created_at'];
							$cretedBy	= $val['created_by'];
							$category 	= $val['name'];
				?>
				<article class="post post-medium">
					<div class="row">
						<div class="col-md-5">
							<div class="post-image">
								<div class="owl-carousel owl-theme" data-plugin-options="{'items':1}">
									<div>
										<div class="img-thumbnail">
											<img class="img-responsive" src="<?= base_url($photo); ?>" alt="" height="190">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="post-content">
								<h2><a href='<?= site_url('article/read/'.$seo_url); ?>'><?= $title; ?></a></h2>
								<p>
									<?= limit_words($content, 30); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="post-meta">
								<span><i class="fa fa-calendar"></i> <?= format_datetime($created); ?></span>
								<span><i class="fa fa-user"></i> Post By <a href="#"><?= $cretedBy; ?></a> </span>
								<span><i class="fa fa-tag"></i> <a href="#"><?= $category; ?></a> </span>
								<a href='<?= site_url('article/read/'.$seo_url); ?>' class="btn btn-xs btn-primary float-right">Read more...</a>
							</div>
						</div>
					</div>
				</article>
				<?php endforeach; endif; ?>
			</div>
			<?= $pagination; ?>
		</div>
	</div>
</div>