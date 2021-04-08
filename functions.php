<?php 

  function register_my_menus() {
      register_nav_menus (
          [
            'header-menu' => __( 'Hauptmenü' ),
            'extra-menu' => __( 'Zusatzmenü' )
          ]
      );
  }
  add_action( 'init', 'register_my_menus' );

  add_action( 'widgets_init', 'andrew_sidebar');
  function andrew_sidebar () {
      register_sidebar (
          [
            'name' => __('Footer', 'theme_slug'),
            'id' => 'footer',
            'description' => __('Am unteren Seitenrand', 'theme-slug'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' =>'</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' =>'</h2>',
          ]
      );
  } 

  /*
  *
  * Vorteile um nur Inhalte auf einer Seite anzugeigen,
  * die auf anderen Seiten nicht angezeigt werden.
  *
  */

  function the_andrew_page( $id ){
      $query = new WP_Query( 'page_id=' . $id );
      if( !$query->have_posts() ) {
        echo 'Page-ID ' . $id . ' ist nicht vergeben.';
        return false;
      }
      $query->the_post();
      the_content();
      wp_reset_query();
  }