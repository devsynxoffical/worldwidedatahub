<?php
/**
 * Template Name: Home New
 */
get_header(); 

?>

<section class="bg-grey">
<div class="home-banner-sec">
    <div class="container">
      <div class="row">
      <div class="col-md-3 home-banner-categories">
        <div class="slider-catlist">
          <h4> <i class="fa fa-bars"></i> Categories </h4>
          <div class="sandy-category-scroll">
          <ul>
            <li class="open has-submenu"> 
              <a href="javascript:void(0)"> Business Email Data </a> 
              <ul>
                <?php $subcatargs = array(
                'orderby'    => 'id',
                'order'      => 'asc',
                'hide_empty' => true,
                'parent' => 16,
                'taxonomy' => 'product_cat'
                );
                $subcats = get_categories($subcatargs);
                if(!empty($subcats)):
                foreach ($subcats as $sc):
                ?>

                <li class="has-submenu"> <a href="javascript:void(0)"> <?php echo $sc->name; ?> </a> 
                    <ul>
                    <?php 
                    $args = array(
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => $sc->slug
                        )
                    ),
                    'post_type' => 'product',
                    'orderby' => 'title,'
                    );

                    $products = new WP_Query( $args );

                    while ( $products->have_posts() ) :
                    $products->the_post();
                    $product = wc_get_product(get_the_id());
                           

                    ?>
                      <li> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </li>
                    <?php endwhile; 
                    wp_reset_postdata();
                    ?>
                    <?php 
                    $category_link__bus_menu = get_category_link($sc->cat_ID); 
                    ?> 
                      <li> <a href="<?php echo $category_link__bus_menu; ?>" class="view-all-btn"> View All </a></li>
                    </ul>
                </li>
            <?php endforeach; 
            endif;
            ?>
            </ul>                
            </li>
            <li class="has-submenu"> <a href="javascript:void(0)"> Consumer Email Data </a> 
              <ul>
              <?php $subcatargs = array(
              'orderby'    => 'id',
              'order'      => 'asc',
              'hide_empty' => true,
              'parent' => 23,
              'taxonomy' => 'product_cat'
              );
              $subcats = get_categories($subcatargs);
              
              if(!empty($subcats)):
              foreach ($subcats as $sc):
              ?>
              
                <li class="has-submenu"> <a href="javascript:void(0)"> <?php echo $sc->name; ?> </a> 
                    <ul>
                    <?php 
                    $args = array(
                    'posts_per_page' => -1,
                    'tax_query' => array(
                    'relation' => 'AND',
                    array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $sc->slug
                    )
                    ),
                    'post_type' => 'product',
                    'orderby' => 'title,'
                    );

                    $products = new WP_Query( $args );

                    while ( $products->have_posts() ) :
                    $products->the_post();
                    $product = wc_get_product(get_the_id());
                    ?>
                      <li> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </li>
                     <?php endwhile;
                     wp_reset_postdata();
                      ?> 
                      <?php 
                    $category_link__bus_menu = get_category_link($sc->cat_ID); 
                    ?>
                     <li> <a href="<?php echo $category_link__bus_menu; ?>" class="view-all-btn"> View All </a></li>
                    </ul>
                </li>            
              
              <?php endforeach; ?>
              <?php endif; ?>
              </ul>
            </li>
            <li> 
            <?php $category_link_special_cat = get_category_link(30); ?> 
            <a href="<?php echo esc_url($category_link_special_cat); ?>"> Special Category Database </a> 
            </li>
            <?php $category_link_who_is_cat = get_category_link(37); ?> 
            <li> <a href="<?php echo esc_url($category_link_who_is_cat); ?>"> Global Whois Data </a> </li>         
          </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 home-banner-slider">
        <img src="https://worldwidedatahub.com/wp-content/uploads/2025/04/revisedfile.png" alt="main Banner" width="140%">
		
    </div>
  </div>
        <!--<div class="slider-catlist">
          <h4> <i class="fa fa-bar-chart"></i> TRENDING </h4>

          <div class="home-banner-sidebar-wraper">
            <?php
              $args=array('post_type' => 'post','order' => 'DESC','posts_per_page'=> 1) ;
              $the_qyery= new WP_Query($args);
              if ($the_qyery->have_posts()) :
              while ( $the_qyery->have_posts() ) : $the_qyery->the_post();?>
              <a href="<?php the_permalink(); ?>"> 
              <img src="<?php the_post_thumbnail_url();  ?>" alt="" width="100%"> 
              <h4> <?php the_title(); ?> </h4>
            </a> 
            <?php endwhile; endif; ?>
            
            <div class="home-banner-email-get-form">
              <img src="<?php echo site_url(); ?>/wp-content/themes/theglobaldatabase/img/blog1.jpg" alt="" width="100%"> 
              <form action="">
              <h4> Get a 10% discount submit your email. </h4>
              <div class="email-form-wrap">          
                <input type="email" class="form-control" placeholder="Email">
                <button> <i class="fa fa-angle-right"></i> </button>
              </div>
              </form>
            </div>
          </div>  


        </div>  -->
      </div>
      </div>
    </div>
    </div>
	<div class="mt-30"></div>


    <div class="container">
        <div class="client-stripe">
          <?php if( have_rows('client_stripe',186) ): ?>
          <?php $cnt =1; ?>
          <?php while ( have_rows('client_stripe',186) ) : the_row(); ?>
            <div class="features-item <?php if($cnt==3): echo "last"; endif; ?>">
              <img src="<?php the_sub_field('stripe_image',186); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( get_sub_field('stripe_heading',186) ) ); ?>">
              <h4> <?php the_sub_field('stripe_heading',186); ?> </h4>
              <p> <?php the_sub_field('stripe_content',186); ?> </p>
            </div>
          <?php $cnt++; endwhile;
          endif;
          ?>
                              
        </div>
    </div>
    <div class="buisiness-databases-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mb-30 text-center">
              <h1> B2B Email Lists and Business Databases by Country </h1>
				<h4> Now pay online by card and get immediate download link </h4>	
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_business_north = get_category_link(18); ?> 
            <a href="<?php echo esc_url( $category_link_business_north ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/north-america1.jpeg" alt="">
              </a>
            </div>
          </div>            

          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'north-america-business-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                    <?php 
                      $regularPrice = $product->get_regular_price();
                      $salePrice = $product->get_sale_price();
                      $price = $product->get_price();

                      $profit_price = $regularPrice-$salePrice;

                      $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                      if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif; ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php echo the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?></p>
                    <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>                
                </div>                
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>                                
                  
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_bus_european = get_category_link(19); ?> 
            <a href="<?php echo esc_url( $category_link_bus_european ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/Europe-Business1.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'european-business-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                    <?php endif ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>         
        </div>
      </div>
    </div>
    


    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_bus_european = get_category_link(17); ?> 
            <a href="<?php echo esc_url( $category_link_bus_european ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/Asia-Business1-3.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'asia-business-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                    <?php endif ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>         
        </div>
      </div>
    </div>
    

    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_bus_european = get_category_link(20); ?> 
            <a href="<?php echo esc_url( $category_link_bus_european ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/south-america-Business1-3.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'south-america-business-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                    <?php endif ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>         
        </div>
      </div>
    </div>



    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_bus_european = get_category_link(29); ?> 
            <a href="<?php echo esc_url( $category_link_bus_european ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/Ocena-Business1-3.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'oceania-consumer-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                    <?php endif ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>         
        </div>
      </div>
    </div>



    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_bus_european = get_category_link(28); ?> 
            <a href="<?php echo esc_url( $category_link_bus_european ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/Africa-Business1-3.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'africa-consumer-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                    <?php endif ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div>         
        </div>
      </div>
    </div>



    <!-- <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_business_north = get_category_link(17); ?> 
            <a href="<?php echo esc_url( $category_link_business_north ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/north-america1.jpeg" alt="">
              </a>
            </div>
          </div>            

          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'asia-business-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                    <?php 
                      $regularPrice = $product->get_regular_price();
                      $salePrice = $product->get_sale_price();
                      $price = $product->get_price();

                      $profit_price = $regularPrice-$salePrice;

                      $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                      if ( $product->is_on_sale() ) :
                    ?>
                    <?php endif; ?>
                    <?php 
                     if(get_field('updated_data_year')): ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif; ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php echo the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?></p>
                    <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>                
                </div>                
                <?php  endwhile; 
                wp_reset_postdata();
                ?> 
            </div>
          </div> -->



    <div class="buisiness-databases-list content-tabs-block mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          <?php $category_link_asia = get_category_link(17); ?> 
            <a href="<?php echo esc_url( $category_link_asia ); ?>" class="content-tab"> Asia </a>
          </div>
          <div class="col-md-3"> 
          <?php $category_link_south_america = get_category_link(20); ?> 
            <a href="<?php echo esc_url( $category_link_south_america ); ?>" class="content-tab"> South America </a>
          </div>
          <div class="col-md-3"> 
          <?php $category_link_oceania = get_category_link(22); ?> 
            <a href="<?php echo esc_url($category_link_oceania); ?>" class="content-tab"> Oceania </a>
          </div>
          <div class="col-md-3">
          <?php $category_link_africa = get_category_link(21); ?> 
            <a href="<?php echo esc_url($category_link_africa); ?>" class="content-tab"> Africa </a>
          </div>                              
        </div>
      </div>
    </div>    
    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="mb-30 text-center">
           <h2> Country-Wise Consumer Email Database </h2>
          </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_con_north = get_category_link(25); ?> 
            <a href="<?php echo esc_url( $category_link_con_north ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/North-America-Consumer1.jpg" alt="">
              </a>
            </div>
          </div>            
          <div class="col-md-9">
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'north-america-consumer-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                  <?php endif; ?>
                  <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif;  ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?>  
            </div>
          </div>         
        </div>
      </div>
    </div> 
    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
            <?php $category_link_con_erope = get_category_link(27); ?> 
            <a href="<?php echo esc_url( $category_link_con_erope ); ?>">
              <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/Europe-Consumer1.jpg" alt="">
              </a>
            </div>            
          </div>            
          <div class="col-md-9">
            <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'european-consumer-data', 'orderby' =>'date','order' => 'ASC' ); ?>
            <div class="owl-carousel owl-theme product-carousel">
                <?php
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                global $product; 
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                  <?php endif; ?>
                  <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif;  ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?></p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>               
                </div>
                <?php  endwhile; 
                wp_reset_postdata();
                ?>  
            </div>
          </div>         
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list content-tabs-block mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-3"> 
            <?php $category_link_con_asia = get_category_link(24); ?> 
            <a href="<?php echo esc_url( $category_link_con_asia ); ?>" class="content-tab"> Asia </a>
          </div>
          <div class="col-md-3"> 
          <?php $category_link_con_south_america = get_category_link(26); ?> 
            <a href="<?php echo esc_url($category_link_con_south_america); ?>" class="content-tab"> South America </a>
          </div>
          <div class="col-md-3"> 
          <?php $category_link_con_oceania = get_category_link(29); ?>
            <a href="<?php echo esc_url($category_link_con_oceania); ?>" class="content-tab"> Oceania </a>
          </div>
          <div class="col-md-3"> 
          <?php $category_link_con_africa = get_category_link(28); ?>
            <a href="<?php echo esc_url($category_link_con_africa); ?>" class="content-tab"> Africa </a>
          </div>                              
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row"> 
          <div class="col-md-12">
            <div class="mb-30 text-center">
              <h2> Special Databases by Industry and Country </h2>
            </div>
          </div>  
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'special-database', 'orderby' =>'date','order' => 'ASC' ); ?>                 
          <?php
          $i=1;
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
          global $product; 
          $product = wc_get_product(get_the_id());
          if($i<=8):
          ?>
          <div class="col-md-3">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                  <?php endif; ?>
                  <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif; ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>                 
          </div>
          <?php  
          endif;
          $i++;
          endwhile;
          wp_reset_postdata();
           ?>
          <div class="col-md-4 offset-md-4 text-center mt-20"> 
          <?php $category_link_special = get_category_link(30); ?>
            <a href="<?php echo esc_url($category_link_special); ?>" class="orange-btn"> View More Special Data </a>
          </div>                   
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list mt-30">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mb-30 text-center">
              <h2> 2025 Latest Whois Country Wise Database </h2>
            </div>
          </div>           
          <?php $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 12,'product_cat' => 'whois-database', 'orderby' =>'date','order' => 'ASC' ); ?>                 
          <?php
          $j=1;
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
          global $product; 
          $product = wc_get_product(get_the_id());
           if($j<=4):
          ?>
          <div class="col-md-3">
                  <div class="product-item-wraper ">
                  <?php 
                    $regularPrice = $product->get_regular_price();
                    $salePrice = $product->get_sale_price();
                    $price = $product->get_price();

                    $profit_price = $regularPrice-$salePrice;

                    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

                    if ( $product->is_on_sale() ) :
                    ?>
                  <?php endif; ?>
                  <?php 
                     if(get_field('updated_data_year')): 
                      ?>
                    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR; ?> Updated</span> </div>
                  <?php endif; ?>
                    <div class="product-item-image">
                      <a href="<?php the_permalink(); ?>"> <img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), 'woocommerce_thumbnail' ); ?>" alt="<?php the_title(); ?>"> </a>
                    </div>
                    <div class="product-item-content">
                      <p><?php echo get_field('product_record',$product->id) ?> </p>
                      <h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
                      <?php if ( $price_html = $product->get_price_html() ) : ?>
                      <p class="price"> <?php echo $price_html; ?> </p>
                      <?php endif; ?>
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                    </div>
                  </div>                 
          </div>
          <?php  
          endif;
          $j++;
          endwhile;
          wp_reset_postdata();
           ?>
          <div class="col-md-4 offset-md-4 mt-30 mb-50 text-center"> 
          <?php $category_link_whois = get_category_link(37); ?>
            <a href="<?php echo esc_url($category_link_whois); ?>" class="orange-btn"> View More Whoisdata </a>
          </div>                    
        </div>
      </div>
    </div>                     
  </section>
  <section class="footer-above-section">
    <div class="global-database-wraper">
      <div class="container">
        <div class="row align-items-center justify-content-center">
        <?php if( have_rows('the_global_database') ): ?>
        <?php while ( have_rows('the_global_database') ) : the_row(); ?>
          <div class="col-md-5 offset-md-1 col-sm-12 d-lg-none d-md-none d-sm-block d-xs-block">
            <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/global-database.svg" alt="" width="100%">
          </div>          
          <div class="col-md-6 col-sm-12">
            <h2 class="mb-15"> <?php the_sub_field('heading'); ?> </h2>
            <p class="mb-40"> <?php the_sub_field('content'); ?> </p>
            <a href="https://worldwidedatahub.com/contact-us/"  class="orange-btn sample_request"> Request A Sample Data </a>
          </div>
          <div class="col-md-5 offset-md-1 col-sm-12 d-sm-none d-none d-md-block d-lg-block">
            <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/global-database.svg" alt="" width="100%">
          </div>
          <div class="clearfix"></div>
          <?php 
         endwhile;
         endif; ?> 
        </div>
      </div>
    </div>
    <div class="recently-updated-wraper">
      <div class="container">
        <div class="row align-items-center justify-content-center">
        <?php if( have_rows('recently_updated') ): ?>
        <?php while ( have_rows('recently_updated') ) : the_row(); ?>
          <div class="col-md-5 col-sm-12">
            <img src="<?php echo home_url('/wp-content/themes/theglobaldatabase'); ?>/img/recently-updated.png" alt="" width="100%">
          </div>          
          <div class="col-md-6 col-sm-12 offset-md-1">
            <h2 class="mb-15"> <?php the_sub_field('heading'); ?> </h2>
            <p class="mb-40"> <?php the_sub_field('content'); ?> </p>
            <a href="https://worldwidedatahub.com/contact-us/"  class="orange-btn sample_request"> Request A Sample Data </a>
          </div>

          <div class="clearfix"></div>
           <?php 
         endwhile;
         endif; ?>
        </div>
      </div>
    </div>
    <div class="buisiness-database-wraper">
      <div class="container">
        <div class="row align-items-center justify-content-center">
        <?php if( have_rows('business_and_consumer_database') ): ?>
        <?php while ( have_rows('business_and_consumer_database') ) : the_row(); ?>
          <div class="col-md-6 col-sm-12">
            <h3 class="mb-10"> <?php the_sub_field('heading_database'); ?> </h3>
            <p class="mb-25"> <?php the_sub_field('content_database'); ?> </p>
            <a href="<?php the_sub_field('learn_more_url'); ?>" class="orange-btn"> Learn More </a>
          </div>
          <?php
          endwhile;
          endif;
           ?>
          <!-- <div class="col-md-6 col-sm-12">
            <h3 class="mb-10"> Consumer Database </h3>
            <p class="mb-25"> We do provide the database for the shop and store owner to run tha campaign to target the consumer of any country &amp; location. </p>
            <a href="" class="orange-btn"> Learn More </a>
          </div> -->
        </div>
      </div>
    </div>    
  </section>




<?php get_footer();  ?>