<div class="container py-4">
	<div class="row">
			<?php 
				// print_r($data);die;
				$title 			= $data['title'];
				$created_date 	= $data['created_at'];
				$content      	= $data['content'];
				$category     	= $data['name'];
				$created_by	  	= $data['created_by'];
				$photo 		  	= $data['photo_real'];
			?>
			<div class="col-lg-9 order-lg-1">
				<div class="blog-posts single-post">
					<article class="post post-large blog-single-post border-0 m-0 p-0">
						<div class="post-image ml-0">
							<a href="">
								<img src="<?= base_url($photo); ?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="" />
							</a>
						</div>
										
						<div class="post-date ml-0">
							<span class="day"><?= date('d', strtotime($created_date)); ?></span>
							<span class="month"><?= date('m', strtotime($created_date)); ?></span>
						</div>
										
						<div class="post-content ml-0">

							<h2 class="font-weight-bold"><a href=""><?= $title; ?></a></h2>
				
							<div class="post-meta">
								<span><i class="far fa-user"></i> By <a href="#"><?= $created_by; ?></a> </span>
								<span><i class="far fa-folder"></i> <a href="#"><?= $category; ?></a> </span>
								<!-- <span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span> -->
							</div>

								<p>
									<?= $content; ?>
								</p>
							
							<div class="post-block mt-5 post-share">
								<h4 class="mb-3">Share this Post</h4>
				
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style ">
									<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
									<a class="addthis_button_tweet"></a>
									<a class="addthis_button_pinterest_pinit"></a>
									<a class="addthis_counter addthis_pill_style"></a>
								</div>
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
								<!-- AddThis Button END -->
							</div>
						</div>
					</article>
				</div>
			</div>
			<div class="col-lg-3 order-lg-2">
				<aside class="sidebar">
					<h5 class="font-weight-bold pt-4">Categories</h5>
					<ul class="nav nav-list flex-column mb-5">
						<li class="nav-item"><a class="nav-link" href="#">Event</a></li>
						<li class="nav-item"><a class="nav-link" href="#">News</a></li>
					</ul>
					<h5 class="font-weight-bold pt-4">About Us</h5>
					<p>ITX merupakan open marketplace untuk semua pelaku bisnis industri pariwisata di Indonesia (seller, buyer, penyedia sistem pemesanan, penyedia konten dan juga penyedia destinasi wisata).</p>
					<a href="<?= site_url('register'); ?>" class="btn btn-lg btn-primary">Register Now!</a>
				</aside>
			</div>	
		</div>
	</div>
</div>
							
