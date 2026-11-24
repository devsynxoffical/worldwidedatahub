<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theglobaldatabase
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
	
	  <meta name="google-site-verification" content="QTlTAuASoIDLiIoodLUzpIi4Xec-lw6JEzzZ69KZCD8" />
	 <meta name="google-site-verification" content="BJMnw3kqFW1yoitGsrTWTDVENvTDTVr8gjAhXbUf8VE" />
	 <meta name="google-site-verification" content="zpoV4SPT9g50Kh8mPvO1KKQ62r-RoMILMTSV1QnxwPw" />
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

   <?php wp_head(); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500;600;700;800&family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/responsive.css">    
	

<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1780426085470040&ev=PageView&noscript=1"
/></noscript>



	
	  		

<!-- begin olark code --><script type="text/javascript" async>
  ;(function(o,l,a,r,k,y){if(o.olark)return;
  r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0];
  y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r);
  y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)};
  y.extend=function(i,j){y("extend",i,j)};
  y.identify=function(i){y("identify",k.i=i)};
  y.configure=function(i,j){y("configure",i,j);k.c[i]=j};
  k=y._={s:[],t:[+new Date],c:{},l:a};
  })(window,document,"static.olark.com/jsclient/loader.js");/* custom configuration goes here (www.olark.com/documentation) */olark.identify('1457-474-10-9844');</script><!-- end olark code -->	

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CJ4X3TPFBN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CJ4X3TPFBN');
</script>
	  <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "ltsm07m91r");
</script>
  </head>
  <body <?php body_class(); ?>>
  <header>
    <div class="sandy-header-top">
      <div class="container">
      <?php
      $hero = get_field('top_bar', 'option');  
      if( $hero ): ?>
      <div class="st-headeder-right">
        <a class="current-open" href="<?php echo $hero['phone_link']; ?>"> <i class="fa fa-phone"></i> <span><?php echo $hero['phone']; ?> </span>  </a>
        <a class="current-open" href="<?php echo $hero['whatsapp_link']; ?>"> <i class="fa fa-whatsapp"></i> <span> <?php echo $hero['whatsapp_phone']; ?> </span> </a>
      </div>         
      <div class="st-headeder-left">
        <a class="current-open" href="<?php echo $hero['email_link']; ?>"> <i class="fa fa-envelope"></i> <span> <?php echo $hero['email']; ?></span> </a>
        <a class="current-open" href="<?php echo $hero['skype_link']; ?>"> <i class="fa fa-skype"></i> <span> <?php echo $hero['skype']; ?></span>  </a>
       
      </div>  
      <div class="clearfix"></div> 
         <?php endif; ?>   
      </div>
    </div>
    <div class="header-top">
    <div class="container">
      <div class="logo">
        <a href="<?php echo site_url(); ?>"> <img src="<?php the_field('logo','option'); ?>" alt="WorldWide DataHub logo" width="100%">  </a>
        <button class="menu-btn">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
      <div class="search-form"> 
        <?php dynamic_sidebar('prod_search'); ?>
      </div>
      <div class="header-right-option">
        <div class="search-btn"> 

          <a href="javascript:void(0);" class="search-mobile"> <img src="<?php bloginfo('template_directory'); ?>/img/search.png" alt="Search"> </a> 
          <a href="javascript:void(0);" class="search-cancel" style="display: none"> <i class="fa fa-times" aria-hidden="true"></i></a> 

        </div>
      	<?php if(is_user_logged_in()){ ?>
        <div class="account-btn"> <a href="<?php echo site_url();?>/my-account/"> <img src="<?php bloginfo('template_directory'); ?>/img/user.png" alt="My account"> <span class="account-text"> My Account </span></a> </div>
        <?php } else {  ?>
        	<div class="account-btn"> <a href="<?php echo site_url();?>/my-account/"> <img src="<?php bloginfo('template_directory'); ?>/img/user.png" alt="My account"> <span class="account-text"> Login / Register </span></a> </div>
        <?php } ?>	
        <?php  $count = WC()->cart->cart_contents_count; ?>
        <div class="shoping-cart-btn-h"> <a href="<?php echo site_url('/cart'); ?>"> <img src="<?php bloginfo('template_directory'); ?>/img/cart.png" alt="Shopping cart"> <span class="account-text"> Shopping Cart: </span> <span id="count-cart-items"> <?php if($count > 0): echo esc_html( $count ); else: echo "0"; endif; ?> Items </span></a> </div>
        <div class="header-social-media">
        <?php if( have_rows('header_social', 'option') ):?>
          <ul>
            <?php while( have_rows('header_social', 'option') ): the_row(); ?>
            <li> <a href="<?php  the_sub_field('social_link','option'); ?>"> <i class="fa <?php the_sub_field('social_class','option'); ?>"></i> </a> </li>
            <?php endwhile; ?>
            <!-- <li> <a href=""> <i class="fa fa-twitter-square"></i> </a> </li>
            <li> <a href=""> <i class="fa fa-linkedin-square"></i> </a> </li> -->
          </ul>
          <?php endif; ?>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>


    </div>
    <div class="lower-nav">
      <div class="container">
        <?php
              wp_nav_menu(array(
              'menu'=>'Primary',
              'theme_location' => 'menu-1'
              ));
              ?>
      </div>
    </div>
  </header>
  <div class="mobile-nav-wraper">
      <a class="mobile-menu-close-btn"> 
        <span> </span>
        <span> </span>
      </a>
      <div class="mobile-nav">
        <img src="<?php the_field('logo','option'); ?>" alt="WorldWide DataHub logo" width="100%">
        <?php
        wp_nav_menu(array(
        'menu'=>'Primary',
        'theme_location' => 'menu-1'
        ));
        ?>
      </div>
  </div>  
  <div class="mobile-nav-bg"></div>  

