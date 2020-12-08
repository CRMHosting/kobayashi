<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package styledstore
 */

?>
<footer id="footer">
	<!-- get sidebar footer top for  -->
	<?php get_sidebar( 'footer-top');?>	
	<!-- add payment links  -->	
	<div class="footer-bottom">
		<?php do_action( 'styledstore_add_payment_links' ); ?>
	</div>	
		<div class="footer-bottombar">
			<div class="container">

					<div class="copyright">
						<a href="http://styledthemes.com/" target="_blank">StyledThemes</a> - <a href="http://flowertimes.ru/" title="Цветы и домашние растения" target="_blank">Комнатные растения и цветы</a>
					</div>

				<div class="footer-menu">
						
					<?php $styledstore_primary_nav = array(
						'theme_location'	=> 'footer',
						'container'	=> false,
						'menu_class'	=> 'sm',
						'menu_id'	=> 'footer-menu',
						'depth'	=> 1,
						'fallback_cb' => false
					);
					wp_nav_menu( $styledstore_primary_nav ); ?>
					
				</div>
			</div>
		</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
