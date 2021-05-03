<?php

if ( !function_exists( "visgo_pagination" ) ) {

	function visgo_pagination( $numpages = '' ) {

		global $wp_query;
    global $paged;

    if (empty( $paged ) ) {
      $paged = 1;
    }

    if( $numpages == '' ) {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if( !$numpages ) {
          $numpages = 1;
        }
    }

		$links = paginate_links( array(
			'current'  => max( 1, get_query_var( 'paged' ) ),
			'total'    => $numpages,
			'type'     => 'array',
			'mid_size' => 3,
			'prev_text'          => __( '<i class="icofont-simple-left"></i>', 'visgo' ),
			'next_text'          => __( '<i class="icofont-simple-right"></i>', 'visgo' ),
		) );

		$links = str_replace( "page-numbers", "page-link", $links );

		if( is_array( $links ) ) { ?>
      <div class="pagination-sec pt-5">
        <div class="container">
          <div class="row">
            <div class="col-md-11 mx-auto">
              <ul class="pagination" id="pagination-act">
          			   <?php
                   $current = (get_query_var('paged')) ? get_query_var('paged') : 1;
                   if($current > 2 && $current < $numpages+1 )
                    echo "<li class='disabled page-item-arrow'> <a href='".get_pagenum_link(1)."' class='page-item'> &larr;</a> </li>";
                  foreach ( $links as $page ) {
                    $class = ( $current == $page ) ?  'page-item active' : 'page-item';
          				  echo "<li class=\"$class\">$page</li>";
          			  }
                  if(  $current < $numpages  )
                      echo "<li class='page-item-arrow'> <a href='" .get_pagenum_link( $current + 1)."' class='page-link' > &rarr; </a> </li>";
                  if ( $current < $numpages-1 )
                    echo "<li class='page-item-arrow'> <a href='". get_pagenum_link($numpages)."' class='page-link'> &rarr; </a> </li>"; ?>
			       </ul>
            </div>
          </div>
        </div>
      </div>
      <?php
		}
	}
}


if( !function_exists( 'get_custom_post' ) ) {
	function get_custom_post( $post_type, $custom_args = [] ) {

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
          'post_type' => $post_type,
          'posts_per_page' => !empty( get_option( 'posts_per_page' ) ) ? get_option( 'posts_per_page' ): 10,
          'paged' => $paged
        );

        $args =  array_merge( $args, $custom_args );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post();
            get_template_part( 'template-parts/content', $post_type );
          endwhile;
        visgo_pagination( $query->max_num_pages );

          //pagination
          //reset
          wp_reset_postdata();
        else :
         get_template_part( 'template-parts/content', 'none' );
        endif;
	}
}


if( !function_exists( 'get_custom_featured_post' ) ) {
	function get_custom_featured_post( $post_type, $template, $custom_args = [] ) {
        $args = array(
          'post_type' => $post_type,
          'posts_per_page' => 4,
          'meta_query' => array(
            array(
              'key'     => 'is_post_featured',
              'value'   => '1'
            ),
          ),
        );

        // $args =  array_merge( $args, $custom_args );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
        	echo '<div class="row ">';
          	while ( $query->have_posts() ) : $query->the_post();
            	get_template_part( 'template-parts/content', $template );
          	endwhile;
          	wp_reset_postdata();
          	echo '<a href="'.get_post_type_archive_link( $post_type ) .'" class="all-city-btn mt-3"> Show all  </a>';
          	echo '</div>';
        else :
         get_template_part( 'template-parts/content', 'none' );
        endif;
	}
}


if( !function_exists( 'visgo_comment_rating_get_average_ratings' ) ) {

    function visgo_comment_rating_get_average_ratings( $id ) {
      $comments = get_approved_comments( $id );

      if ( $comments ) {
        $i = 0;
        $total = 0;
        foreach( $comments as $comment ){
          $rate = get_comment_meta( $comment->comment_ID, 'rating', true );
          if( isset( $rate ) && '' !== $rate ) {
            $i++;
            $total += $rate;
          }
        }

        if ( 0 === $i ) {
          return false;
        } else {
          return round( $total / $i, 1 );
        }
      } else {
        return false;
      }
    }
}

if( !function_exists( 'visgo_strip_shortcode_gallery' ) ) {

function visgo_strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }
    return $content;
  }

}


function visgo_get_taxonomy_archive_link( $taxonomy ) {
  $tax = get_taxonomy( $taxonomy ) ;
  return get_bloginfo( 'url' ) . '/' . $tax->rewrite['slug'];
}

function visgo_place_text() {
  echo get_theme_mod( 'place_text');
}

function visgo_city_text() {
  echo get_theme_mod( 'city_text');
}


function better_comments( $comment, $args, $depth ) {

  // Get correct tag used for the comments
  if ( 'div' === $args['style'] ) {
    $tag       = 'div';
    $add_below = 'comment';
  } else {
    $tag       = 'li';
    $add_below = 'div-comment';
  } ?>

  <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

  <?php
  // Switch between different comment types
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' : ?>
    <div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'textdomain' ); ?></span> <?php comment_author_link(); ?></div>
  <?php
    break;
    default :

    if ( 'div' != $args['style'] ) { ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php } ?>
      <div class="comment-author vcard">
        <?php
        // Display avatar unless size is set to 0
        if ( $args['avatar_size'] != 0 ) {
          $avatar_size = ! empty( $args['avatar_size'] ) ? $args['avatar_size'] : 70; // set default avatar size
            echo get_avatar( $comment, $avatar_size );
        }
        // Display author name
        printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'textdomain' ), get_comment_author_link() ); ?>
      </div><!-- .comment-author -->
      <div class="comment-details">
        <div class="comment-meta commentmetadata">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
            /* translators: 1: date, 2: time */
            printf(
              __( '%1$s at %2$s', 'textdomain' ),
              get_comment_date(),
              get_comment_time()
            ); ?>
          </a><?php
          edit_comment_link( __( '(Edit)', 'textdomain' ), '  ', '' ); ?>
        </div><!-- .comment-meta -->
        <div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
        <?php
        // Display comment moderation text
        if ( $comment->comment_approved == '0' ) { ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'textdomain' ); ?></em><br/><?php
        } ?>
        <div class="reply"><?php
        // Display comment reply link
        comment_reply_link( array_merge( $args, array(
          'add_below' => $add_below,
          'depth'     => $depth,
          'max_depth' => $args['max_depth']
        ) ) ); ?>
        </div>
      </div><!-- .comment-details -->
  <?php
    if ( 'div' != $args['style'] ) { ?>
      </div>
    <?php }
  // IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
    break;
  endswitch; // End comment_type check.
}