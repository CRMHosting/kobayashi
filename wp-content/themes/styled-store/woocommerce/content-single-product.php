<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" <?php post_class('clearfix'); ?>>
	<div class="col-sm-6 col-md-6 st-product-image">
		<?php
			/**
			 * product gallery Images
			 */
			global $product;
			$attachment_ids = $product->get_gallery_attachment_ids();
			$EmptyTestgallery = array_filter($attachment_ids);
			if (!empty($EmptyTestgallery))
			  {
		?>
			<div class="st-product-image-gallery">
				<ul class="st-gallery-main-images">
					<?php
						foreach( $attachment_ids as $attachment_id ) 
						{
							$image_link = wp_get_attachment_image_src( $attachment_id, 'styledstoreblog-image' )[0];
					?>
						  	<li>
						  		<a href="<?php echo $image_link; ?>" itemprop="image" class="woocommerce-main-image zoom" data-rel="prettyPhoto[product-gallery]" > + </a>
						  			<img src="<?php echo $image_link; ?>" />
						  		<!-- </a> -->

						  	</li>
					<?php }	?>
				</ul>
			<?php
				/**
				 * product gallery thumb
				 */
				 global $product;
				 $attachment_ids = $product->get_gallery_attachment_ids();
			?>	
				<!-- <div class="pager-thumb"> -->
					<ul id="st-product-gallery-thumb">
					<?php
						$counter = 0;
						foreach( $attachment_ids as $attachment_id ) 
						{
							$counter++;
							$count = count($attachment_ids);
							$thumbnail_url = wp_get_attachment_image_src( $attachment_id, 'styledstore-product-thumb' )[0];
					?>	
						<li data-slide-index="<?php echo $counter-1; ?>">
							<a href="#" class="product-gallery-thumb" >
								<img src="<?php echo $thumbnail_url; ?>" />
							</a>
						</li>
					<?php }	?>
					</ul>
				<!-- </div> -->
			</div>

			<?php
				} else {
			?>
				<a href="<?php the_post_thumbnail_url(); ?>" itemprop="image" class="woocommerce-main-image zoom" data-rel="prettyPhoto[product-gallery]" > + </a>
					<?php the_post_thumbnail(); ?>
			<?php }
			?>
	</div>
	<div class="col-sm-6 col-md-6 st-product-detail">
			<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			// remove woocommerce_template_single_meta hook
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', '40' );
			do_action( 'woocommerce_single_product_summary' );
		?>
		<?php
			/**
			 * Product Description
			 * woocommerce product review
			 *
			 * @hooked woocommerce_output_related_products - 20
			 */
		?>
			<!-- product description -->
			<div class="st-toggle-section st-product-description">
				<h3>Description</h3>
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
				<div class="detail-description"><?php the_content(); ?></div>
			</div>

			<!-- product review -->
			<div class="st-toggle-section st-product-description">
				<h3>Reviews</h3>
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
				<?php comments_template( 'woocommerce/single-product-reviews' ); ?>
			</div>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div><!-- .summary -->

</div><!-- #product-<?php the_ID(); ?> -->

<div class="st-woocommerce-related-product">
	<?php
		// display related products
		if ( ! function_exists( 'woocommerce_output_related_products' ) ) { 
		    require_once '/includes/wc-template-functions.php'; 
		} 

		$result = woocommerce_output_related_products(); 
	?>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>