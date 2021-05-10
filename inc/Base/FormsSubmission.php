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
        add_action( 'wp_ajax_submit_listing', array($this, 'submitListing') );
        add_action( 'wp_ajax_nopriv_submit_listing', array($this, 'submitListing') );
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


    function submitListing()
    {
        if (is_user_logged_in())
        {
            $f_name = sanitize_text_field( $_POST['f_name'] );
            // $l_name = sanitize_text_field( $_POST['l_name'] );
            $content = sanitize_textarea_field( $_POST['content'] );
            $tag_line = sanitize_text_field( $_POST['tag_line'] );
            $phone = sanitize_text_field( $_POST['phone'] );
            $whatsapp = sanitize_text_field( $_POST['whatsapp'] );
            $twitter = sanitize_text_field( $_POST['twitter'] );
            $facebook = sanitize_text_field( $_POST['facebook'] );
            $linkedin = sanitize_text_field( $_POST['linkedin'] );
            $youtube = sanitize_text_field( $_POST['youtube'] );
            $insta = sanitize_text_field( $_POST['instagram'] );
            $business_address = sanitize_text_field( $_POST['business_address'] );
            $price = sanitize_text_field( $_POST['price'] );

            $Sunday_check_in = $_POST['Sunday_check_in'];
            $Sunday_check_out = $_POST['Sunday_check_out'];
            $Monday_check_in = $_POST['Monday_check_in'];
            $Monday_check_out = $_POST['Monday_check_out'];
            $Tuesday_check_in = $_POST['Tuesday_check_in'];
            $Tuesday_check_out = $_POST['Tuesday_check_out'];
            $Wednesday_check_in = $_POST['Wednesday_check_in'];
            $Wednesday_check_out = $_POST['Wednesday_check_out'];
            $Thursday_check_in = $_POST['Thursday_check_in'];
            $Thursday_check_out = $_POST['Thursday_check_out'];
            $Friday_check_in = $_POST['Friday_check_in'];
            $Friday_check_out = $_POST['Friday_check_out'];
            $Saturday_check_in = $_POST['Saturday_check_in'];
            $Saturday_check_out = $_POST['Saturday_check_out'];


            $author_id = $_POST['author_id'];
            $featured_image = $_FILES['featured_image'];
            $file = $featured_image['tmp_name'];


            if (file_exists($file)) {
                if (getimagesize($file) !== FALSE) { 
                    $args = array(
                        'post_title' => $f_name,
                        'post_content' => $content,
                        'post_author' => $author_id,
                        'post_status' => 'publish',
                        'post_type' => 'listings',
                        'meta_input' => array(
                            '_listings_company_details_tag_line_key' => $tag_line,
                            '_listings_company_details_phone_key' => $phone,
                            '_listings_company_details_whatsapp_key' => $whatsapp,
                            '_listings_company_details_twitter_key' => $twitter,
                            '_listings_company_details_facebook_key' => $facebook,
                            '_listings_company_details_linkedin_key' => $linkedin,
                            '_listings_company_details_youtube_key' => $youtube,
                            '_listings_company_details_insta_key' => $insta,
                            '_listings_company_details_business_address_key' => $business_address,
                            '_listings_company_details_pricing_key' => $price,


                            '_listings_company_details_sunday_check_in_key' => $Sunday_check_in,
                            '_listings_company_details_sunday_check_out_key' => $Sunday_check_out,
                            '_listings_company_details_monday_check_in_key' => $Monday_check_in,
                            '_listings_company_details_monday_check_out_key' => $Monday_check_out,
                            '_listings_company_details_tuesday_check_in_key' => $Tuesday_check_in,
                            '_listings_company_details_tuesday_check_out_key' => $Tuesday_check_out,
                            '_listings_company_details_wednesday_check_in_key' => $Wednesday_check_in,
                            '_listings_company_details_wednesday_check_out_key' => $Wednesday_check_out,
                            '_listings_company_details_thursday_check_in_key' => $Thursday_check_in,
                            '_listings_company_details_thursday_check_out_key' => $Thursday_check_out,
                            '_listings_company_details_friday_check_in_key' => $Friday_check_in,
                            '_listings_company_details_friday_check_out_key' => $Friday_check_out,
                            '_listings_company_details_saturday_check_in_key' => $Saturday_check_in,
                            '_listings_company_details_saturday_check_out_key' => $Saturday_check_out,
                            
                        )
                    );
                    $post_ID = wp_insert_post( $args);
                    if ($post_ID) {
                        $movefile = wp_handle_upload($_FILES['featured_image'], array('test_form' => false));
                        $filename = $movefile['url'];
                        $parent_post_id = $post_ID;
                        $filetype = wp_check_filetype( basename( $filename ), null );
                        $wp_upload_dir = wp_upload_dir();
                        $attachment = array(
                            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
                            'post_mime_type' => $filetype['type'],
                            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        );

                        $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        
                        set_post_thumbnail( $parent_post_id, $attach_id );

                        wp_send_json( array('status' => 'success', 'content' => $content, 'n_s_c' => $_POST['content']));
                        wp_die();
                    }
                    
                }
            }

        }

        wp_send_json( array(
            'status' => 'error'
        ) );
        wp_die();
    }

    function addCorsHttpHeader()
    {
        header("Access-Control-Allow-Origin: *");
    }

}