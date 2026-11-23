<?php
/*Remove result count*/
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);

/*Remove shop sidebar*/
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);

/*Remove shop filter*/
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);


/*---------------Shop page into three columns------------*/

 add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );

    
    function wc_loop_shop_columns( $number_columns ) {
        return 3;
    }

/*--------------Global Business Data -----------------------*/

add_action( "wp_ajax_nopriv_getbusinessbycategory",'getfilterbusinessbycategory' );
add_action( "wp_ajax_getbusinessbycategory",'getfilterbusinessbycategory' );

function getfilterbusinessbycategory(){

    if(isset($_POST['catid']) && $_POST['catid']!='')
    {
        $current_cat_id = $_POST['catid'];
        $business_slug = $_POST['business_slug'];

        $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => -1,'product_cat' => $business_slug, 'orderby' =>'date','order' => 'ASC' );

        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        global $product; 
        $product = wc_get_product(get_the_id());
           
          $message .= '<div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">';
                    $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                        $message .= '';
                        endif;  
                     $message .= '<span class="database-updated">';

                     if(get_field('updated_data_year')):
                        $message .= WWDH_DATA_YEAR.' Updated</span>';
                     endif; 
                     $message .= '
                     <img src="'.wp_get_attachment_url( get_post_thumbnail_id()).'" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="'.site_url().'/?add-to-cart='.get_the_ID().'" class="cart-btn"> Add To Cart </a>
                      <a href="'.get_the_permalink() .'" class="prduct-view-btn"> View </a>
                      </div>
                    </div>
                    <div class="product-item-content">
                      <p> '.get_field('product_record',$product->id).' </p>
                      <h4> '.get_the_title().' </h4>';
                      if ( $price_html = $product->get_price_html() ) :
                      $message .= '<p class="price">'.$price_html.' USD </p>';
                        endif;
                    $message .= '</div>
                  </div>                
                </div>';

        endwhile;

        echo json_encode(array('data'=>$message));
        exit;
    }

}


/*--------------Consumer ajax here-----------*/

add_action( "wp_ajax_nopriv_getconsumerbyslug",'getfilterconsumerbyslug' );
add_action( "wp_ajax_getconsumerbyslug",'getfilterconsumerbyslug' );

function getfilterconsumerbyslug(){

    if(isset($_POST['consumer_slug']) && $_POST['consumer_slug']!='')
    {
        $consumer_slug = $_POST['consumer_slug'];

        $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => -1,'product_cat' => $consumer_slug, 'orderby' =>'date','order' => 'ASC' );

        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        global $product; 
        $product = wc_get_product(get_the_id());
           
          $message .= '<div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">';

                    $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                        $message .= '';
                        endif;  
                     $message .= '<span class="database-updated">';

                     if(get_field('updated_data_year')):
                        $message .= WWDH_DATA_YEAR.' Updated</span>';
                     endif; 

                      $message .= '<img src="'.wp_get_attachment_url( get_post_thumbnail_id()).'" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="'.site_url().'/?add-to-cart='.get_the_ID().'" class="cart-btn"> Add To Cart </a>
                      <a href="'.get_the_permalink() .'" class="prduct-view-btn"> View </a>
                      </div>
                    </div>
                    <div class="product-item-content">
                      <p> '.get_field('product_record',$product->id).' </p>
                      <h4> '.get_the_title().' </h4>';
                      if ( $price_html = $product->get_price_html() ) :
                      $message .= '<p class="price">'.$price_html.' USD </p>';
                        endif;
                    $message .= '</div>
                  </div>                
                </div>';

        endwhile;

        echo json_encode(array('data'=>$message));
         exit;
    }

}


/*--------------special database ajax here-----------*/

add_action( "wp_ajax_nopriv_getspecialdatabasebyslug",'getfilterspecialdatabasebyslug' );
add_action( "wp_ajax_getspecialdatabasebyslug",'getfilterspecialdatabasebyslug' );

function getfilterspecialdatabasebyslug(){

    if(isset($_POST['special_database_slug']) && $_POST['special_database_slug']!='')
    {
        $special_database_slug = $_POST['special_database_slug'];

        $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => -1,'product_cat' => $special_database_slug, 'orderby' =>'date','order' => 'ASC' );

        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        global $product; 
        $product = wc_get_product(get_the_id());
           
          $message .= '<div class="item">
                  <div class="product-item-wraper ">
                    <div class="product-item-image">';
                    $regularPrice = $product->get_regular_price();
                        $salePrice = $product->get_sale_price();
                        $price = $product->get_price();

                        $profit_price = $regularPrice-$salePrice;

                        $profit_per = number_format(($profit_price/$regularPrice)*100,2);

                        if ( $product->is_on_sale() ) :
                        $message .= '';
                        endif;  
                     $message .= '<span class="database-updated">';

                     if(get_field('updated_data_year')):
                        $message .= WWDH_DATA_YEAR.' Updated</span>';
                     endif; 
                      $message .= '<img src="'.wp_get_attachment_url( get_post_thumbnail_id()).'" alt="" class="img-responsive">
                      <div class="product-actions-overlay">
                      <a href="'.site_url().'/?add-to-cart='.get_the_ID().'" class="cart-btn"> Add To Cart </a>
                      <a href="'.get_the_permalink() .'" class="prduct-view-btn"> View </a>
                      </div>
                    </div>
                    <div class="product-item-content">
                      <p> '.get_field('product_record',$product->id).' </p>
                      <h4> '.get_the_title().' </h4>';
                      if ( $price_html = $product->get_price_html() ) :
                      $message .= '<p class="price">'.$price_html.' USD </p>';
                        endif;
                    $message .= '</div>
                  </div>                
                </div>';

        endwhile;

        echo json_encode(array('data'=>$message));
         exit;
    }

}


/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {

  $cols = 12;
  return $cols;
}


/*--------Remove woocommerce_breadcrumb-------------------------*/

remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

/*-------------Product details page gallery support function------------*/
add_action( 'after_setup_theme', 'worldwidedatabase_product_details_gallery' );

function worldwidedatabase_product_details_gallery() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}


//remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

/*----------------------Product title-----------------------*/

function woocommerce_template_loop_product_title() {
?>
<span> <?php the_field('product_record',$product->id); ?> </span>
<?php
        echo '<h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h4>'; 
    }
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title');   

/*---------------------Product image src get url-----------*/

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );


function woocommerce_template_loop_product_thumbnail(){

     global $product;
     ?>
    <a href="<?php the_permalink(); ?>"><img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="<?php the_title(); ?>"/></a>
    <?php
}
add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');

/*------------------sale discount offer here-------------------*/

function worldwidedatabase_discount_offer(  ) { 
    global $product;
    $regularPrice = $product->get_regular_price();
    $salePrice = $product->get_sale_price();
    $price = $product->get_price();

    $profit_price = $regularPrice-$salePrice;

    $profit_per = number_format(($profit_price/$regularPrice)*100,0);

    if ( $product->is_on_sale() ) :
    ?>
    <?php endif; ?>
    

<?php 
}
add_filter( 'woocommerce_sale_flash', 'worldwidedatabase_discount_offer' );

/*---------------Content product add updated field--------------------------*/
function worldwidedatabase_updated_data_year(){ ?>
    
    <div class="updated-2020"> <span> <?php echo WWDH_DATA_YEAR . " Updated"; ?></span> </div>
<?php }
add_action('woocommerce_before_shop_loop_item_title','worldwidedatabase_updated_data_year',9);

/*--------------------Single product updated field------------------------------*/
function worldwidedatabase_single_updated_data_year(){ ?>
    
    <div class="single-product-updated-2020"> <span> <?php echo WWDH_DATA_YEAR . " Updated"; ?></span> </div>
<?php }
add_action('woocommerce_before_single_product_summary','worldwidedatabase_single_updated_data_year',9);


/*---------------product Image below content------------------*/
function worldwidedatabase_below_product_image_content(){
?>


<div class="product-detail-features">
    <div class="pd-features-item">
        <span> <i class="ico fa fa-recycle"></i> </span>
        <h4> Latest Update </h4>
    </div>
    <div class="pd-features-item">
        <span> <i class="ico fa fa-thumbs-up"></i> </span>
        <h4> Good Quality </h4>
    </div>  
    <div class="pd-features-item">
        <span> <i class="ico fa fa-briefcase"> </i> </span>
        <h4> Reasonable price </h4>
    </div>
    <div class="pd-features-item">
        <span> <i class="ico fa fa-upload"></i> </span>
        <h4> Instant Download </h4>
    </div>
    <div class="pd-features-item">
        <span> <i class="ico fa fa-support"></i> </span>
        <h4> Instant Customer Suppor </h4>
    </div>
    <div class="clearfix"></div>                
</div>
<?php 
}
add_action('woocommerce_after_single_product_summary','worldwidedatabase_below_product_image_content',9);


/*---------------single product title below Records level---------------*/
function worldwidedatabase_database_records(){
    ?>
<span class="pd-rcords-count"> (<?php the_field('product_record',$product->id); ?>) </span>
    <?php
}
add_action('woocommerce_single_product_summary','worldwidedatabase_database_records',6);


/*=============Custom tab in product page==================*/
/*------------Remove Review tab in product page-----------------*/
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
function wcs_woo_remove_reviews_tab($tabs) {
unset($tabs['reviews']);
return $tabs;
}

// ADD ATTRIBUTE DESCRIPTION TAB

add_filter( 'woocommerce_product_tabs', 'worldwidedatabase_woo_attrib_desc_tab' );

function worldwidedatabase_woo_attrib_desc_tab( $tabs ) {

    // Adds the Attribute Description tab

    $tabs['additional'] = array(

        'title'     => __( 'Additional', 'woocommerce' ),

        'priority'  => 100,

        'callback'  => 'worldwidedatabase_woo_attrib_desc_tab_content'

    );

    return $tabs;

}

function worldwidedatabase_woo_attrib_desc_tab_content(){
     global $product;
    echo '<div class="wrapper-additional_worldwidedatabase">' . $product->get_meta( '_additional' ) . '</div>';
}



// Add custom Meta box to admin products pages
add_action( 'add_meta_boxes', 'create_product_additional_meta_box' );
function create_product_additional_meta_box() {
    add_meta_box(
        'additonal_product_meta_box',
        __( 'Additional Information', 'woocommerce' ),
        'add_additonal_content_meta_box',
        'product',
        'normal',
        'default'
    );
}

// Custom metabox content in admin product pages
function add_additonal_content_meta_box( $post ){
    $product = wc_get_product($post->ID);
    $content = $product->get_meta( '_additional' );

    echo '<div class="product_additional_worldwidedatabase">';

    wp_editor( $content, '_additional', ['textarea_rows' => 10]);

    echo '</div>';
}

// Save WYSIWYG field value from product admin pages
add_action( 'woocommerce_admin_process_product_object', 'save_product_custom_wysiwyg_field', 10, 1 );
function save_product_custom_wysiwyg_field( $product ) {
    if (  isset( $_POST['_additional'] ) )
         $product->update_meta_data( '_additional', wp_kses_post( $_POST['_additional'] ) );
}

/*woocommerce_template_single_meta*/
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);


/*------------------  Single product bredcrumbs banner function ----------------------------*/

function my_parent_product_cat(){
global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ($terms as $term) {
  if($term->parent == 0){
      $product_cat_name = $term->name;
      return $product_cat_name;
      break;
  }  
}
}

function my_sub_product_cat(){
global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );

foreach ($terms as $term) {
  if($term->parent != 0){
      $product_cat_name = $term->name; 
    
        $cat_link_name = '<a href="'.site_url().'/product-category/'.$term->slug.'"> '.$product_cat_name.' </a>';
        
      return $cat_link_name;
      break;
  }  
}
}
/*------------------ End Single product bredcrumbs banner function ----------------------------*/

/**
Remove all possible fields
**/
function wc_remove_checkout_fields( $fields ) {
// Billing fields
unset( $fields['billing']['billing_postcode'] );
return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );