<?php
/* Template Name: Front Page */

get_header();
?>

 <section class="home-products-wraper bg-grey">
  <div class="home-banner-sec">
    <div class="container">
      <div class="row">
      <div class="col-md-3 home-banner-categories">
        <div class="slider-catlist">
          <h4> <i class="fa fa-bars"></i> Categories </h4>
          <div class="sandy-category-scroll">
          <ul>
            <li class="open has-submenu"> 
              <a href="javascript:void(0)"> Global Business Database </a> 
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
                    <?php endwhile; ?>
                    </ul>
                </li>
            <?php endforeach; 
            endif;
            ?>
            </ul>                
            </li>
            <li class="has-submenu"> <a href="javascript:void(0)"> Global Consumer Database </a> 
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
                     <?php endwhile; ?> 
                    </ul>
                </li>            
              
              <?php endforeach; ?>
          		<?php endif; ?>
              </ul>
            </li>
            <li> <a href=""> Special Category Database </a> </li>
            <li> <a href=""> Special Category Database </a> </li>         
          </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 home-banner-slider">
        
        <div class="owl-carousel owl-theme" id="banner-slider">
            <div class="item"> <img src="<?php bloginfo('template_directory'); ?>/img/slider/main-banner1.jpg" alt="" width="100%"> </div>
            <div class="item"> <img src="<?php bloginfo('template_directory'); ?>/img/slider/main-banner1.jpg" alt="" width="100%"> </div>
            <div class="item"> <img src="<?php bloginfo('template_directory'); ?>/img/slider/main-banner1.jpg" alt="" width="100%"> </div>
            <div class="item"> <img src="<?php bloginfo('template_directory'); ?>/img/slider/main-banner1.jpg" alt="" width="100%"> </div>
        </div>        
      </div>
      <div class="col-md-3 home-banner-tredings">
        <div class="slider-catlist">
          <h4> <i class="fa fa-bar-chart"></i> TRENDING </h4>
        <a href=""> <img src="<?php bloginfo('template_directory'); ?>/img/blog2.jpg" alt="" width="100%"> </a> 
        <a href=""> <img src="<?php bloginfo('template_directory'); ?>/img/blog1.jpg" alt="" width="100%"> </a>          
        </div>  
      </div>
      </div>
    </div>
    </div> 
    <div class="mt-30"></div>   
    <div class="container">
        <div class="client-stripe"> 
		<?php if( have_rows('client_stripe',7) ): ?>
			<?php $cnt =1; ?>
		<?php while ( have_rows('client_stripe',7) ) : the_row(); ?>
          <div class="features-item <?php if($cnt==3): echo "last"; endif; ?>">
            <img src="<?php the_sub_field('stripe_image',7); ?>" alt="">
            <h4> <?php the_sub_field('stripe_heading',7); ?> </h4>
            <p> <?php the_sub_field('stripe_content'); ?> </p>
          </div>
      <?php $cnt++; endwhile;
      endif;
       ?>

          <!-- <div class="features-item">
            <img src="<?php //bloginfo('template_directory'); ?>/img/features/2.png" alt="">
            <h4> 24/7 Support </h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do. </p>
          </div>
          <div class="features-item last">
            <img src="<?php //bloginfo('template_directory'); ?>/img/features/3.png" alt="">
            <h4> Safe Payment </h4>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do. </p>
          </div> -->                    
        </div>
    </div>
    <div class="buisiness-databases-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="dl-title-wraper mb-30">
            <h2> Buisiness Databases </h2>
            <ul class="dl-tabs-list">
             <li class="active business_data_cat"> <a href="javascript:void(0)" business-slug="global-business-data" data_cat_id="16"> View All </a> </li>
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
              <li class="business_data_cat"> <a href="javascript:void(0)" business-slug="<?php echo $sc->slug; ?>" data_cat_id="<?php echo $sc->term_id; ?>"> <?php echo $sc->name; ?> </a> </li>
            <?php endforeach; 
            endif;
            ?>  
              
            </ul>
            <div class="clearfix"></div>
          </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
              <div class="owl-carousel owl-theme ads-slider">
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad1.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad2.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad3.jpg" alt="">
                  </div>                  
              </div>
            </div>
          </div>            

          <div class="col-md-9 product_business_data">
          <div id="demo">
            <div class="owl-carousel owl-theme product-carousel" id="business-data-slide">
                <?php
                 $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'tax_query'             => array(
                array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 16,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ),
                array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator'      => 'NOT IN'
                )
                )
                );
                $products = new WP_Query($args);

                if($products->have_posts()):
                  while($products->have_posts()):
                    $products->the_post();
                	$product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">
                    <?php
                      
                        $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                          ?>
                        <?php
                         endif; 
                       ?>
                       <span class="database-updated"><?php echo WWDH_DATA_YEAR . " Updated"; ?></span>
                      <img src="<?php $img_url= wp_get_attachment_url( get_post_thumbnail_id()); echo $img_url;?>" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                      <a href="<?php the_permalink(); ?>" class="prduct-view-btn"> View </a>
                      </div>
                    </div>
                    <div class="product-item-content">
                      <p> <?php the_field('product_record',$product->id); ?> </p>
                      <h4> <a href=""> <?php the_title(); ?> </a> </h4>
						<?php if ( $price_html = $product->get_price_html() ) : ?>
						<p class="price"><?php echo $price_html; ?></p>
						<?php endif; ?>
                    </div>
                  </div>                
                </div>
                <?php    
                endwhile;
                endif; 
                wp_reset_query();
                ?> 
            </div>
          </div>                                
            </div>      
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <hr>
          <div class="dl-title-wraper mb-30">
            <h2> Consumer Databases </h2>
            <ul class="dl-tabs-list consumer-list">
            <li class="active global-consumer-data"> <a href="javascript:void(0)" consumer-data-slug="global-consumer-data"> View All </a> </li>
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
            	<li class="global-consumer-data"> <a href="javascript:void(0)" consumer-data-slug="<?php echo $sc->slug; ?>"> <?php echo $sc->name; ?> </a> </li>
            <?php
            
            endforeach;
            endif;
             ?>	
              
             
            </ul>
            <div class="clearfix"></div>
          </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
              <div class="owl-carousel owl-theme ads-slider">
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad1.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad2.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad3.jpg" alt="">
                  </div>                  
              </div>
            </div>
          </div>            
          <div class="col-md-9">
          <div id="demo-consumer">
            <div class="owl-carousel owl-theme product-carousel" id="consumer-data-slide">
                <?php
                 $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'tax_query'             => array(
                array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 23,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ),
                array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator'      => 'NOT IN'
                )
                )
                );
                $products = new WP_Query($args);

                if($products->have_posts()):
                  while($products->have_posts()):
                    $products->the_post();
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">
                    <?php
                      
                        $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                          ?>
                        <?php
                         endif; 
                       ?>
                       <span class="database-updated"><?php echo WWDH_DATA_YEAR . " Updated"; ?></span>
                      <img src="<?php $img_url= wp_get_attachment_url( get_post_thumbnail_id()); echo $img_url;?>" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                      <a href="<?php the_permalink(); ?>" class="prduct-view-btn"> View </a>
                      </div>                      
                    </div>
                    <div class="product-item-content">
                      <p> <?php the_field('product_record',$product->id); ?> </p>
                      <h4> <a href=""> <?php the_title(); ?> </a> </h4>
					<?php if ( $price_html = $product->get_price_html() ) : ?>
					<p class="price"><?php echo $price_html; ?></p>
					<?php endif; ?>

                    </div>
                  </div>                
                </div>
                <?php endwhile;
                endif;
                wp_reset_query(); ?>
            </div>
          </div> 
          </div>
        </div>
      </div>
    </div>
    <div class="buisiness-databases-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <hr>
          <div class="dl-title-wraper mb-30">
            <h2> Special Databases </h2>
            <ul class="dl-tabs-list special-database">
              <li class="active"> <a href="javascript:void(0)" special-database-slug="special-database"> View All </a> </li>
              <?php $subcatargs = array(
              'orderby'    => 'id',
              'order'      => 'asc',
              'hide_empty' => false,
              'parent' => 30,
              'taxonomy' => 'product_cat'
              );
              $subcats = get_categories($subcatargs);

              if(!empty($subcats)):
              foreach ($subcats as $sc):
              ?>
              <li> <a href="javascript:void(0)" special-database-slug="<?php echo $sc->slug; ?>"> <?php echo $sc->name; ?> </a> </li>
            <?php endforeach; endif;  ?>
              <!-- <li> <a href=""> North America </a> </li>
              <li> <a href=""> Africa </a> </li>
              <li> <a href=""> Europe </a> </li>
              <li> <a href=""> South America </a> </li> -->
              
            </ul>
            <div class="clearfix"></div>
          </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
              <div class="owl-carousel owl-theme ads-slider">
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad1.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad2.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad3.jpg" alt="">
                  </div>                  
              </div>
            </div>
          </div>            
          <div class="col-md-9">
          <div id="demo-special-database">
            <div class="owl-carousel owl-theme product-carousel" id="special-database-slide">
                <?php
                 $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => -1,
                'tax_query'             => array(
                array(
                'taxonomy'      => 'product_cat',
                'field' => 'term_id', //This is optional, as it defaults to 'term_id'
                'terms'         => 30,
                'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ),
                array(
                'taxonomy'      => 'product_visibility',
                'field'         => 'slug',
                'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                'operator'      => 'NOT IN'
                )
                )
                );
                $products = new WP_Query($args);

                if($products->have_posts()):
                  while($products->have_posts()):
                    $products->the_post();
                $product = wc_get_product(get_the_id());
                ?>
                <div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">
                    <?php
                      
                        $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                          ?>
                        <?php
                         endif; 
                       ?>
                       <span class="database-updated"><?php echo WWDH_DATA_YEAR . " Updated"; ?></span>
                      <img src="<?php $img_url= wp_get_attachment_url( get_post_thumbnail_id()); echo $img_url;?>" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                      <a href="<?php the_permalink(); ?>" class="prduct-view-btn"> View </a>
                      </div>                      
                    </div>
                    <div class="product-item-content">
                      <p> <?php the_field('product_record',$product->id); ?> </p>
                      <h4> <a href=""> <?php the_title(); ?> </a> </h4>
						<?php if ( $price_html = $product->get_price_html() ) : ?>
						<p class="price"><?php echo $price_html; ?></p>
						<?php endif; ?>
                    </div>
                  </div>                
                </div>
                <?php  endwhile; endif; wp_reset_query(); ?> 
            </div>
            </div>
          </div>         
        </div>
      </div>
    </div> 
    <div class="buisiness-databases-list">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <hr>
          <div class="dl-title-wraper mb-30">
            <h2> Most Selling </h2>
            <!-- <ul class="dl-tabs-list">
              <li class="active"> <a href=""> Asia </a> </li>
              <li> <a href=""> Oceania </a> </li>
              <li> <a href=""> North America </a> </li>
              <li> <a href=""> Africa </a> </li>
              <li> <a href=""> Europe </a> </li>
              <li> <a href=""> South America </a> </li>
              <li> <a href=""> View All </a> </li>
            </ul> -->
            <div class="clearfix"></div>
          </div>
          </div>
          <div class="col-md-3 pia-wrapper">
            <div class="product-item-advertisement">
              <div class="owl-carousel owl-theme ads-slider">
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad1.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad2.jpg" alt="">
                  </div>
                  <div class="item">
                    <img src="<?php bloginfo('template_directory'); ?>/img/ad3.jpg" alt="">
                  </div>                  
              </div>
            </div>
          </div>            
          <div class="col-md-9">
            <div class="owl-carousel owl-theme product-carousel" >
			<?php
			$args = array(
			'post_type' => 'product',
			'meta_key' => 'total_sales',
			'orderby' => 'meta_value_num',
			'posts_per_page' => -1,
			);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $product; ?>
			
                <div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">
                    <?php
                      
                        $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                          ?>
                        <?php
                         endif; 
                       ?>
                       <span class="database-updated"><?php echo WWDH_DATA_YEAR . " Updated"; ?></span>
			         <?php if (has_post_thumbnail( $loop->post->ID )) 
			         echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
			         else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" />'; ?>
                      <div class="product-actions-overlay">
                      <a href="<?php echo site_url().'/?add-to-cart='.get_the_ID(); ?>" class="cart-btn"> Add To Cart </a>
                      <a href="<?php the_permalink(); ?>" class="prduct-view-btn"> View </a>
                      </div>          
                    </div>
                    <div class="product-item-content">
                      <p> <?php the_field('product_record',$loop->post->ID); ?> </p>
                      <h4> <a href=""> <?php the_title(); ?> </a> </h4>
					<?php if ( $price_html = $product->get_price_html() ) : ?>
					<p class="price"><?php echo $price_html; ?></p>
					<?php endif; ?>
                    </div>
                  </div>                
                </div>
                <?php endwhile; ?>
			<?php wp_reset_query(); ?>
            </div>
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
            <img src="<?php bloginfo('template_directory'); ?>/img/global-database.svg" alt="" width="100%">
          </div>          	
          <div class="col-md-6 col-sm-12">
            <h2 class="mb-15"> <?php the_sub_field('heading'); ?> </h2>
            <p class="mb-40"> <?php the_sub_field('content'); ?> </p>
            <a href="" class="orange-btn"> Request A Sample Data </a>
          </div>
          <div class="col-md-5 offset-md-1 col-sm-12 d-sm-none d-none d-md-block d-lg-block">
            <img src="<?php bloginfo('template_directory'); ?>/img/global-database.svg" alt="" width="100%">
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
            <img src="<?php bloginfo('template_directory'); ?>/img/recently-updated.png" alt="" width="100%">
          </div>          
          <div class="col-md-6 col-sm-12 offset-md-1">
            <h2 class="mb-15"> <?php the_sub_field('heading'); ?> </h2>
            <p class="mb-40"> <?php the_sub_field('content'); ?> </p>
            <a href="" class="orange-btn"> Request A Sample Data </a>
          </div>

          <div class="clearfix"></div>
          <?php 
          endwhile;
          endif;
           ?>
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
            <p class="mb-25"> <?php the_sub_field('content_database') ?> </p>
            <a href="<?php the_sub_field('learn_more_url'); ?>" class="orange-btn"> Learn More </a>
          </div>
          <?php
          endwhile;
          endif;
           ?>
          <!-- <div class="col-md-6">
            <h3 class="mb-10"> Consumer Database </h3>
            <p class="mb-25"> We do provide the database for the shop and store owner to run tha campaign to target the consumer of any country & location. </p>
            <a href="" class="orange-btn"> Learn More </a>
          </div> -->
        </div>
      </div>
    </div>    
  </section>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
   
   $(".business_data_cat a").on("click",function(){

    var catid = $(this).attr("data_cat_id");
    var business_slug = $(this).attr("business-slug");

    $('ul.dl-tabs-list li.active').removeClass('active');
    $(this).parent().addClass('active');

    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

      $.ajax({

        type: "POST",
        url: ajaxurl,
        data: {catid:catid,business_slug:business_slug,action:'getbusinessbycategory'},
        cache: false,
        dataType:'json',
       success: function(res)
        {
          
         $('#demo').html('<div id="business-data-slide" class="owl-carousel owl-theme product-carousel"></div>');
            
          $("#business-data-slide").append(res.data);
            
            var owl = $("#business-data-slide");
            owl.owlCarousel({
                items: 3,
                margin:30,
                navigation: true
            });
       }
    
   });

 }); 

 /*-------------------consumer data click event-------------------*/
 $(".global-consumer-data a").on("click",function(){

    var consumer_slug = $(this).attr("consumer-data-slug");

    $('ul.consumer-list li.active').removeClass('active');
    $(this).parent().addClass('active');

    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

      $.ajax({

        type: "POST",
        url: ajaxurl,
        data: {consumer_slug:consumer_slug,action:'getconsumerbyslug'},
        cache: false,
        dataType:'json',
       success: function(res)
        {
          
         $('#demo-consumer').html('<div id="consumer-data-slide" class="owl-carousel owl-theme product-carousel"></div>');
            
          $("#consumer-data-slide").append(res.data);
            
            var owl = $("#consumer-data-slide");
            owl.owlCarousel({
                items: 3,
                margin:30,
                navigation: true
            });
       }
    
   });

 }); 

 /*------------------------Special Database-------------------*/
 $("ul.special-database li a").on("click",function(){

    var special_database_slug = $(this).attr("special-database-slug");

    $('ul.special-database li.active').removeClass('active');
    $(this).parent().addClass('active');

    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

      $.ajax({

        type: "POST",
        url: ajaxurl,
        data: {special_database_slug:special_database_slug,action:'getspecialdatabasebyslug'},
        cache: false,
        dataType:'json',
       success: function(res)
        {
          
         $('#demo-special-database').html('<div id="special-database-slide" class="owl-carousel owl-theme product-carousel"></div>');
            
          $("#special-database-slide").append(res.data);
            
            var owl = $("#special-database-slide");
            owl.owlCarousel({
                items: 3,
                margin:30,
                navigation: true
            });
       }
    
   });

 }); 
 </script> 



  <?php get_footer(); ?>

   <script>
$('#banner-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    dots:false,
    autoplay:true,
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
 </script>


