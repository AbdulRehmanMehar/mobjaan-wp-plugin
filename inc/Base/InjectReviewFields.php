<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;

use Mobjaan\Base\Constants;


class InjectReviewFields 
{
    private $post_type;

    function __construct()
    {
        $this->post_type = 'reviews';
    }

    function register()
    {
        add_action( 'add_meta_boxes', array($this, 'addMetaBoxes') );
    }

    function addMetaBoxes() {
        add_meta_box( 'mobjaan-review', 'Rating', array($this, 'ratingField'), $this->post_type);
    }

    function ratingField($post) {
        wp_nonce_field( 'save', 'rating_meta_box_nonce');
        // $value = get_post_meta( $post->ID, '_rating_key', true );
        
        echo 'it works';
    }

    function saveRating() {
        //
    }
}