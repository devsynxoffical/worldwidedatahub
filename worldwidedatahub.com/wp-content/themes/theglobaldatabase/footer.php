<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theglobaldatabase
 */

?>

  
  <footer>
    <div class="top-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="our-links">
              <p class="footer-title"> Our Links </p>
              <?php
              wp_nav_menu(array(
              'menu'=>'Ourlinks',
              'container_id'=>'database-our-links',
              'container_class'=>'database-our-links-wrap',
              'menu_class' =>'our-link-list',
              'theme_location' => 'menu-2'
              ));
              ?>
            </div>
            <div class="our-links">
              <p class="footer-title"> Business List </p>
              <?php $args = array('menu'=>'businesslist','container_id'=>'database-business-list','container_class'=>'business-list-wrap','menu_class'=>'business-list','theme_location'=>'menu-3'); ?>
              <?php wp_nav_menu($args); ?>

            </div>
            <div class="our-links">
              <p class="footer-title"> Consumer List </p>
              <?php $args = array('menu'=>'speciallist','container_id'=>'database-special-list','container_class'=>'special-list-wrap','menu_class'=>'special-list','theme_location'=>'menu-4'); ?>
              <?php wp_nav_menu($args); ?>
            </div>        
            <div class="clearfix"></div>                   
          </div>
          <div class="col-md-3 footer-right-column foot-contact">
            <p class="footer-title"> Contact </p>
            <?php the_field('footer_contact', 'option'); ?> 
            <ul class="social-media mt-20">
              <?php if( have_rows('footer_social', 'option') ):?>
            <ul>
            <?php while( have_rows('footer_social', 'option') ): the_row(); ?>
            <li> <a href="<?php  the_sub_field('social_link','option'); ?>"> <i class="fa <?php the_sub_field('social_class','option'); ?>"></i> </a> </li>
            <?php endwhile; ?>
            <!-- <li> <a href=""> <i class="fa fa-twitter-square"></i> </a> </li>
            <li> <a href=""> <i class="fa fa-linkedin-square"></i> </a> </li> -->
          </ul>
          <?php endif; ?>
            </ul>
            <div class="wwdh-gps-wrap"><?php if ( function_exists( 'wwdh_preferred_source_badge' ) ) { echo wwdh_preferred_source_badge(); } ?></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="lower-footer">
      <div class="container">
        <div class="row">
        <div class="col-md-8">
          <p> <?php the_field('footer_copy_right', 'option'); ?> </p>
        </div>
        <div class="col-md-4">
          
        </div>
        <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </footer>


   
  <?php wp_footer(); ?>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.js"></script>
  <script src="<?php bloginfo('template_directory'); ?>/js/template.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script> -->

  <script>
  $('.ads-slider').owlCarousel({
      
      margin:0,
      nav:false,
      autoplay:true,
      dots:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  }) 


  $('.product-carousel').owlCarousel({
      
      loop:true,
      margin:30,
      nav:false,
      autoplay:true,
      dots:false,
      responsive:{
        0:{
            items:1,
            margin:0,
        },
        568:{
            items:2
        },        
        667:{
            items:3
        },
        1000:{
            items:3
        }
      }
  })      
  </script>


<script src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js"></script>

<script>

//console.log($.cookie('worildwide_popup_set'));

if($.cookie('worildwide_popup_set') == null){ 

$(document).ready(function(){
  $(".clb-close").click(function(){
    $(".landing-popup").removeClass("active");
  });
});

var header = $('.landing-popup');
setTimeout(function() {
    header.addClass('active');
}, 4000);

}

</script>


  <script type="text/javascript">

    $(document).ready(function(){
    $(".clb-close").click(function(){
      $(".landing-popup1").removeClass("active");
    });
    });
    
    $(".sample_request").click(function(){

      var footerpopup = $('.landing-popup1');
      footerpopup.addClass('active');    
    });

$("#popup_submit").on("click", function(event){
  event.preventDefault();

  var name = $("#fname").val();
  var country_code = $("#country_code").val();
  var phone = $("#phone").val();
  var email = $("#email").val();
  var country = $("#country").val();
  var message = $('textarea#message').val();
  
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if(name == '')
  {
    var msg = '<span style="color:red">Please Enter Your Name.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(country_code == ''){
    var msg = '<span style="color:red">Please Enter Your Country Code.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(country == ''){
    var msg = '<span style="color:red">Please Enter Your Country.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(message == ''){
    var msg = '<span style="color:red">Please Enter Your Message.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(phone == ''){
    var msg = '<span style="color:red">Please Enter Your Phone number.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(email == ''){
    var msg = '<span style="color:red">Please Enter Your Email.</span>';
    $("#errorreq_id").html(msg);
    return false;
  }else if(!mailformat.test(email)){
    var msg = '<span style="color:red">Please Enter Your Valid Email.</span>';
       $('#errorreq_id').html(msg);
      
      return false;
  }else if(!$.isNumeric( phone )){
    var msg = '<span style="color:red">Please Enter Your Valid phone Number.</span>';
       $('#errorreq_id').html(msg);
      
      return false;
  }

  $('#myloader').show();

  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  $.ajax({

      type: 'POST',
      url: ajaxurl,
      data: {name:name,country_code:country_code,phone:phone,email:email,country:country,message:message,action:'worldwidedatabase_form'},
      dataType: 'html',
      success:function(res){
         window.location.href = "<?php echo site_url('/thank-you'); ?>";
        $('#myloader').hide();
        $('#errorreq_id').hide();
         document.getElementById("form_id").reset();
      }

  });


});

/*-----------Window load popup-------------*/
$("#popup_submit_window1").on("click", function(e){

  console.log('testing');

  e.preventDefault();

  var name1 = $("#fname1").val();
  var country_code1 = $("#country_code1").val();
  var phone1 = $("#phone1").val();
  var email1 = $("#email1").val();
  var comments1 = $("#comments").val();
  
  
  var mailformat1 = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if(name1 == '')
  {
    var msg1 = '<span style="color:red">Please Enter Your Name.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(country_code1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Country Code.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(phone1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Phone number.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(email1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Email.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(!mailformat1.test(email1)){
    var msg1 = '<span style="color:red">Please Enter Your Valid Email.</span>';
       $('#errorreq_id1').html(msg1);
      
      return false;
  }else if(!$.isNumeric( phone1 )){
    var msg1 = '<span style="color:red">Please Enter Your Valid phone Number.</span>';
       $('#errorreq_id1').html(msg1);
      
      return false;
  }

  $('#myloader1').show();

  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  var site_url = "<?php site_url(); ?>"

  jQuery.ajax({

      type: 'POST',
      url: ajaxurl,
      data: {name:name1,country_code:country_code1,phone:phone1,email:email1,comments:comments1,action:'worldwidedatabase_form_popup'},
      dataType: 'html',
      success:function(result){

        //$.cookie("worildwide_popup_set", "popup_world", { expires: 7, path: site_url });

       window.location.href = "<?php echo site_url('/thank-you'); ?>";
        $('#myloader1').hide();
        $('#errorreq_id1').hide();
         document.getElementById("form_id1").reset();
      }

  });


});

/*-----------Home side form-------------*/
$("#side_home_form").on("click", function(e){

  console.log('testing1');

  e.preventDefault();

  var name1 = $("#fname1").val();
  var country_code1 = $("#country_code1").val();
  var phone1 = $("#phone1").val();
  var email1 = $("#email1").val();
  var comments1 = $("#comments").val();
  
  
  var mailformat1 = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if(name1 == '')
  {
    var msg1 = '<span style="color:red">Please Enter Your Name.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(country_code1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Country Code.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(phone1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Phone number.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(email1 == ''){
    var msg1 = '<span style="color:red">Please Enter Your Email.</span>';
    $("#errorreq_id1").html(msg1);
    return false;
  }else if(!mailformat1.test(email1)){
    var msg1 = '<span style="color:red">Please Enter Your Valid Email.</span>';
       $('#errorreq_id1').html(msg1);
      
      return false;
  }else if(!$.isNumeric( phone1 )){
    var msg1 = '<span style="color:red">Please Enter Your Valid phone Number.</span>';
       $('#errorreq_id1').html(msg1);
      
      return false;
  }

  $('#myloader1').show();

  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

  var site_url = "<?php site_url(); ?>"

  $.ajax({

      type: 'POST',
      url: ajaxurl,
      data: {name:name1,country_code:country_code1,phone:phone1,email:email1,comments:comments1,action:'worldwidedatabase_form_popup'},
      dataType: 'html',
      success:function(result){
      window.location.href = "<?php echo site_url('/thank-you'); ?>";
        $('#errorreq_id1').hide();
         document.getElementById("form_id1").reset();
		 
      }

  });


});



$(document).ready(function(){
  $(".search-btn a").click(function(){
    $(".search-form").show();
    $(".search-mobile").hide();
    $(".search-cancel").show();
  });

  $(".search-cancel").click(function(){
    $(".search-form").hide();
    $(".search-mobile").show();
    $(".search-cancel").hide();
  })

});

  </script>

<!-- begin olark code -->
<!-- <script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('3901-742-10-5207');</script> -->
<!-- end olark code -->


</body>
</html>