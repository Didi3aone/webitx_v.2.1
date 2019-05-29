<div role="main" class="main">
	<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
	<div id="googlemaps" class="google-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6128555269374!2d106.82774081390606!3d-6.182539862297784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f431e0c09157%3A0x7995047b079de386!2sMenara+Multimedia+Hall!5e0!3m2!1sid!2sid!4v1550634168157" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
	</div>

	<div class="container">
		<div class="row py-4">
			<div class="col-lg-6">
				<div class="overflow-hidden mb-1">
					<h2 class="font-weight-normal text-7 mt-2 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200"><strong class="font-weight-extra-bold">Contact</strong> Us</h2>
				</div>
				<form id="contactForm" class="contact-form" action="php/contact-form.php" method="POST">
					<div class="contact-form-success alert alert-success d-none mt-4" id="contactSuccess">
						<strong>Success!</strong> Your message has been sent to us.
					</div>
				
					<div class="contact-form-error alert alert-danger d-none mt-4" id="contactError">
						<strong>Error!</strong> There was an error sending your message.
						<span class="mail-error-message text-1 d-block" id="mailErrorMessage"></span>
					</div>
					
					<div class="form-row">
						<div class="form-group col-lg-6">
							<label class="required font-weight-bold text-dark text-2">Your name *</label>
							<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
						</div>
						<div class="form-group col-lg-6">
							<label class="required font-weight-bold text-dark text-2">Your email address *</label>
							<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label class="font-weight-bold text-dark text-2">Subject</label>
							<input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subject" id="subject" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label class="required font-weight-bold text-dark text-2">Message</label>
							<textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control" name="message" id="message" required></textarea>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<input type="submit" value="Send Message" class="btn btn-primary btn-modern" data-loading-text="Loading...">
						</div>
					</div>
				</form>

			</div>
			<div class="col-lg-6">
				<h4 class="heading-primary mt-lg">Get in <strong>Touch</strong></h4>
				<p>ITX is a B2B tourism marketplace in which provides an online system that allows the suppliers to offer their inventories, and the distributor to buy the inventories.</p>
				<hr>
				<h4 class="heading-primary">The <strong>Office</strong></h4>
				<ul class="list list-icons list-icons-style-3 mt-xlg">
					<li>
						<i class="fa fa-map-marker"></i> Menara Multimedia  6<sup>th</sup> Floor<br>Jl. Kebon Sirih No.12 RT.11/RW.2, Gambir<br>Kota Jakarta Pusat 10110, Indonesia
					</li>
					<!-- <li><i class="fa fa-phone"></i>+62 21 538 8538</li> -->
					<li><i class="fa fa-envelope"></i> <a href="mailto:info@itx.co.id">info@itx.co.id</a></li>
				</ul>

				<hr>
				<h4 class="heading-primary">Business <strong>Hours</strong></h4>
				<ul class="list list-icons list-dark mt-xlg">
					<li><i class="fa fa-clock-o"></i> Monday to Friday - 8.30 am to 5.30 pm</li>
					<li><i class="fa fa-clock-o"></i> Saturday & Sunday - Closed</li>
				</ul>
			</div>
		</div>
	</div>
</div>
