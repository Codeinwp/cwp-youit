
   </div>
    <div class="clear"></div>
  <footer>

    <div class="mobile">
      <div class="container">
        <div class="mobile-wrapper">
            <div class="clear"></div>
        </div>
      </div><!-- .container -->
    </div>

    <div class="footer-wrapper">
      <div class="container">
       	<?php if ( is_active_sidebar( 'sidebar-first-footer' ) ) : ?>
      			<?php dynamic_sidebar( 'sidebar-first-footer' ); ?>
      	<?php endif; ?>
      </div><!-- .container -->
    </div>

    <div class="copyright">
      <div class="container">
        <div class="copyright-wrapper">
  		<?php
  			if(get_theme_mod('footer_logo')):
  				echo ' <div class="logo">';
  					echo '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"><img src="'.get_theme_mod('footer_logo').'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"></a>';
  				echo '</div>';
  			else:
  				echo ' <div class="span3 main-title-footer">';
  					echo '<h1><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></h1>';
  					echo '<h2><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'description' ).'</a></h2>';
  				echo '</div>';
  			endif;
  		?>
         
          <div class="links">
            <ul>
  			<?php wp_nav_menu( array( 'container'	=>	false, 'fallback_cb'=>false, 'depth' =>1, 'theme_location' => 'footer',  'menu_class' => 'nav-menu',  'items_wrap' => '%3$s') ); ?>
            </ul>
          </div>
        </div>
      </div><!-- .container -->
    </div>

  </footer>
<?php wp_footer(); ?>
</body>
</html>