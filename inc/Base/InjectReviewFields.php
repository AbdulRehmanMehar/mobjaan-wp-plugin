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
        add_action( 'save_post', array($this, '__mobjaan_review_cpt_listing_custom_meta_box'));
        add_action( 'save_post', array($this, '__mobjaan_review_cpt_rating_custom_meta_box'));
    }

    function addMetaBoxes() 
    {
        add_meta_box( 'mobjaan-review-listing', 'Lisitng', array($this, 'listingDialogueBox'), $this->post_type);
        add_meta_box( 'mobjaan-review-rating', 'Rating', array($this, 'ratingDialogueBox'), $this->post_type);
    }

    function listingDialogueBox($post)
    {
        global $post;

        wp_nonce_field( '__mobjaan_review_cpt_listing_custom_meta_box', 'listing_meta_box_nonce' );
        $listing_id = get_post_meta( $post->ID, '_review_post_listing_id_key', true );
        $posts = get_posts( array('post_type' => 'listings') );
        if (!empty($posts)) 
        {   
            echo '<label for="mobjaan_review_cpt_listing_id">Listing: </label>&nbsp; &nbsp; &nbsp; &nbsp;' ;
            echo '<select id="mobjaan_review_cpt_listing_id" name="mobjaan_review_cpt_listing_id" required="true">';
            echo '<option value="">None</option>';

            foreach($posts as $p)
            {
                echo '<option value="'. $p->ID .'"';
                if ($p->ID ==  $listing_id ) 
                {
                    echo ' selected="selected">';
                }
                else
                {
                    echo ">";
                }
                echo $p->post_title;
                echo '</option>';
            }

            echo '</select>';
        }
        else 
        {
            echo '<b>There is no listing available!</b>';
        }
    }

    function __mobjaan_review_cpt_listing_custom_meta_box($post_id)
    {
        if (!isset($_POST['listing_meta_box_nonce'])) {
            return;
        }
        
        if (!wp_verify_nonce( $_POST['listing_meta_box_nonce'], '__mobjaan_review_cpt_listing_custom_meta_box' ))
        {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
        
        if (!isset($_POST['mobjaan_review_cpt_listing_id'])) return;
        $listing_id_key = $_POST['mobjaan_review_cpt_listing_id'];
        update_post_meta( $post_id, '_review_post_listing_id_key', $listing_id_key);
    }

    function ratingDialogueBox($post)
    {
        
        wp_nonce_field('__mobjaan_review_cpt_rating_custom_meta_box', 'rating_meta_box_nonce');
        $price_value = get_post_meta( $post->ID, '_review_post_price_rating_key', true );
        $quality_value = get_post_meta( $post->ID, '_review_post_quality_rating_key', true );
        $contact_value = get_post_meta( $post->ID, '_review_post_contact_rating_key', true );
        $general_value = get_post_meta( $post->ID, '_review_post_general_rating_key', true );
        
        $avg = (($price_value?$price_value:0) + ($quality_value?$quality_value:0) + ($contact_value?$contact_value:0) + ($general_value?$general_value:0)) / 4;
        echo "<p><b>Average</b>: $avg</p>";

        $this->addSelectField('Price', $price_value);
        $this->addSelectField('Quality', $quality_value);
        $this->addSelectField('Contact', $contact_value);
        $this->addSelectField('General', $general_value);
    }

    function __mobjaan_review_cpt_rating_custom_meta_box($post_id) 
    {
        
        if (!isset($_POST['rating_meta_box_nonce'])) {
            return;
        }
        
        if (!wp_verify_nonce( $_POST['rating_meta_box_nonce'], '__mobjaan_review_cpt_rating_custom_meta_box' ))
        {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
        
        if (!isset($_POST['mobjaan_review_cpt_Price_rating'])) return;
        $price_data = $_POST['mobjaan_review_cpt_Price_rating'];
        update_post_meta( $post_id, '_review_post_price_rating_key', $price_data);
        
        if (!isset($_POST['mobjaan_review_cpt_Quality_rating'])) return;
        $quality_data = $_POST['mobjaan_review_cpt_Quality_rating'];
        update_post_meta( $post_id, '_review_post_quality_rating_key', $quality_data);

        if (!isset($_POST['mobjaan_review_cpt_Contact_rating'])) return;
        $contact_data = $_POST['mobjaan_review_cpt_Contact_rating'];
        update_post_meta( $post_id, '_review_post_contact_rating_key', $contact_data);

        if (!isset($_POST['mobjaan_review_cpt_General_rating']) ) return;
        $general_data = $_POST['mobjaan_review_cpt_General_rating'];
        update_post_meta( $post_id, '_review_post_general_rating_key', $general_data);
    }  

    private function addSelectField(string $filedname, $value)
    {
        echo "<div style='margin: 10px;'>";
        echo '<label for="mobjaan_review_cpt_'.$filedname.'_rating">'.$filedname.': </label>&nbsp; &nbsp; &nbsp; &nbsp;' ;
        echo '<select id="mobjaan_review_cpt_'.$filedname.'_rating" name="mobjaan_review_cpt_'.$filedname.'_rating" required="true">';
        
        for($i=0; $i<=5; $i++) 
        {
            echo '<option value="'.$i.'"';
            if( $i == esc_attr( $value ) ) 
            {
                echo "selected='selected'";
            } 
            echo '" >'; echo $i; echo '</option>';
        }
        echo '</select></div>';
    }
}