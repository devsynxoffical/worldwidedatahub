<?php
/**
 * Template Name: contact
 */
get_header(); ?>

<div class="banner-with-breadcumb" style="background-image:url('<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/inner-banner1.jpeg');">
  <div class="bwb-overlay"></div>
  <div class="container">
    <div class="row">
    <div class="col-md-8 banner-title">
      <h1> <?php the_title(); ?> </h1>
      <ul>
        <li> <a href="<?php echo site_url(); ?>"> Home </a> </li>
        <li> <a href="javascript:void(0);"> <?php the_title(); ?> </a>  </li>
      </ul>
      <p>
      </p>
    </div>   
   
<section class="block-padd">
	<div class="container">
		<div class="contact-colout-wrap">  

		<div class="contact-colout">
			<div class="contact-icon"> <span class="fa fa fa-whatsapp"></span> </div>
			<h4> Whatsapp: </h4>
			<p><a style="color: #000;" href="https://web.whatsapp.com/send?phone=+91-9051 158 007">+91-9051 158 007</a></p>
		</div>
		<div class="contact-colout">
			<div class="contact-icon"> <span class="fa fa-skype"></span> </div>
			<h4> skype id </h4>
			<p><a href="skype:theglobaldatabase?call" style="color: #000;">Theglobaldatabase</a></p>
		</div>	
		<div class="contact-colout">
			<div class="contact-icon"> <span class="fa fa-life-ring"></span> </div>
			<h4> 24/7 Support </h4>
			<p>We provide the 24X7 online support to our valuable customers.</p>
		</div>			
		</div>
	</div>
</section>
<section class="block-padd" style="padding-top:0px;">
   <div class="container">
  	
   	<div class="row  align-items-center justify-content-center">    		
   	<div class="col-md-6">
		<?php //echo do_shortcode(' <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeSgVCIYXbjibFjHZEmN4p7jBlgivL7piwuub1KdvD-cstXLw/viewform?embedded=true" width="640" height="943" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>'); ?>
		

    <div class="comment-form"> 


<?php echo do_shortcode('[contact-form-7 id="1464" title="Contact form 1" html_class="row"]'); ?>

 </div>
		
   	
		</div>
   	<div class="clearfix"></div>
   	</div>
   </div>
</section>

<section class="all-section contact-footer">
    <div class="container">
      <div class="row d-flex">
        <div class="col-lg-12 col-md-12">
          <div class="row">
            <div class="col-md-4 col-sm-6 wow slideInLeft">
              <div class="box-contact">
                <div class="icon-contact">
                  <span class="fa fa-whatsapp">
                </div>
                <div class="content-contact">
                  <h3>Our Office</h3>
                      <p>Manchester Road, London, United Kingdom</p>
                </div>
              </div>
            </div>
            <!--- col-md-4 -->
            <div class="col-md-4 col-sm-6">
              <div class="box-contact">
                <div class="icon-contact">
                  <span class="fa fa-envelope">
                </div>
                <div class="content-contact">
                    <h3>Email Us</h3>
                      <p><a style="color:#fff;" href="mailto:sales@worldwidedatahub.com">sales@worldwidedatahub.com</a></p>
                </div>
              </div>
            </div>
            <!--- col-md-4 -->
            <div class="col-md-4 col-sm-6 wow slideInLeft">
              <div class="box-contact">
                <div class="icon-contact">
                  <span class="fa fa-phone">
                </div>
                <div class="content-contact">
                    <h3>Call Now</h3>
                      <p><a style="color:#fff;" href="tel:+91-9073182063">+91-9051 158  007</a></p>
                </div>
              </div>
            </div>
            <!--- col-md-4 -->

          </div>
        </div>
      </div>
    </div>
  </section>
<?php get_footer(); 