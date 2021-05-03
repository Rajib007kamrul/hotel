<?php
    if ( post_password_required() ) {
        return;
    }
?>
<div class="commnets-area">
    <h3 class="pb-3"> Comments </h3>
    <?php
    if ( $comments ) {
        // wp_list_comments( array(
        //     'style'       => 'div',
        //     'callback' => 'better_comments'
        // ) );
        
        wp_list_comments(
            array(
                'walker'      => new WP_Bootstrap_Comments_Walker,
                'avatar_size' => 65,
                'style'       => 'div',
                'format'      => 'html5',
            )
        );
        // wp_list_comments(
        //     array(
        //         // 'walker'      => new Visgo_Walker_Comment,
        //         'avatar_size' => 65,
        //         'style'       => 'div',
        //         'format'      => 'html5',
        //     )
        // );
    }

    paginate_comments_links();

        comment_form(
            array(
                'class_form'         => 'pt-0 pt-md-4',
                'title_reply_before' => '<h3>',
                'title_reply_after'  => '</h3>',
                'label_submit'       => __( 'Submit' ),
                'title_reply'        =>__( 'Write your comment here' ),
                'title_reply_to'        =>__( 'Leave a Comment to %s' ),
                'comment_field' => '<div class="form-group pt-3 pt-md-5 "> <textarea id="comment" name="comment" aria-required="true"
                class="form-control" rows="5"></textarea> </div>',
                'submit_button' => '<button type="submit" class="btn btn-pink btn-submit mt-3 float-right">
            Submit <img src="'. get_template_directory_uri() .'/assets/img/Arrow.svg" class="pl-2" alt="">
        </button>'
            )
        );
    ?>
</div>