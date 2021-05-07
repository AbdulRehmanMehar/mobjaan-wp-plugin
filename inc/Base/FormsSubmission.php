<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;


use Mobjaan\Base\Constants;


class FormsSubmission
{

    function register()
    {
        add_action('init', array($this, 'addCorsHttpHeader'));
        add_action( 'wp_ajax_submit_review', array($this, 'submitReview') );
        add_action( 'wp_ajax_nopriv_submit_review', array($this, 'submitReview') );
    }

    function submitReview()
    {
        if (is_user_logged_in()){
            $review_title_Field = sanitize_text_field( $_POST['review_title_Field'] );
            $review_feedback = sanitize_textarea_field( $_POST['review_feedback'] );
            $price_rating_review = $_POST['price_rating_review'];
            $quality_rating_review = $_POST['quality_rating_review'];
            $contact_rating_review = $_POST['contact_rating_review'];
            $general_rating_review = $_POST['general_rating_review'];
            $listing_id = $_POST['listing_id'];
            $author_id = $_POST['author_id'];
            

            $args = array(
                'post_title' => $review_title_Field,
                'post_content' => $review_feedback,
                'post_author' => $author_id,
                'post_status' => 'publish',
                'post_type' => 'reviews',
                'meta_input' => array(
                    '_review_post_price_rating_key' => $price_rating_review,
                    '_review_post_quality_rating_key' => $quality_rating_review,
                    '_review_post_contact_rating_key' => $contact_rating_review,
                    '_review_post_general_rating_key' => $general_rating_review,
                    '_review_post_listing_id_key' => $listing_id
                )
            );

            $post_ID = wp_insert_post($args);

            if ($post_ID)
            {
                $return = array(
                    'status' => 'success',
                    'ID' => $post_ID,
                );

                wp_send_json( $return );
                wp_die();
            }
        }


        wp_send_json(array(
            'status' => 'error',
        ));

        wp_die();
    }

    function addCorsHttpHeader()
    {
        header("Access-Control-Allow-Origin: *");
    }

}