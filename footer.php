<?php 
	///Initialize options
	$options = cwp_get_theme_options();

?>
   </div>
    <div class="clear"></div>
  <footer>
    <div class="mobile">
      <div class="mobile-wrapper">
         
          <div class="clear"></div>
      </div>
    </div>
    <div class="footer-wrapper">
 	<?php if ( is_active_sidebar( 'sidebar-first-footer' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-first-footer' ); ?>
	<?php endif; ?>
    </div>
    <div class="copyright">
      <div class="copyright-wrapper">
        <div class="logo">
          <a href="" title=""><img src="<?php echo $options['footer_logo']; ?>" alt=""></a>
        </div>
        <div class="links">
          <ul>
			<?php wp_nav_menu( array( 'container'	=>	false, 'fallback_cb'=>false, 'depth' =>1, 'theme_location' => 'footer',  'menu_class' => 'nav-menu',  'items_wrap' => '%3$s') ); ?>
          </ul>
        </div>
      </div>
    </div>
  </footer>
<?php wp_footer(); ?>
</body>
</html>