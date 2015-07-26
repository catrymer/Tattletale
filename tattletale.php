<?php
/*
Plugin Name: Tattletale
Description: Your "friend" deleted your post! HOW DARE (S)HE?? Count on Tattletale to report to you immediately on his/her deviousness!
Version:     1.0
Author:      Cat Rymer
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function post_trashed( $new_status, $old_status, $post ) {
    if ( $old_status != 'trash' && $new_status == 'trash' ) {
        $trashy_user = wp_get_current_user();
        if ( $trashy_user->ID != $post->post_author) {
            $author = get_user_by( 'id', $post->post_author);
            $author_email = $author->user_email;
            wp_mail( $author_email, 'Caught Red Handed!!', "$trashy_user->user_login trashed your post. Bastard!" );
        }
    }
}
add_action( 'transition_post_status', 'post_trashed', 10, 3);
