<?php
/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Base;

use Mobjaan\Base\Constants;


class InjectContactFields 
{
    private $post_type;

    function __construct()
    {
        $this->post_type = 'contact';
    }

    function register()
    {
        add_action( 'add_meta_boxes', array($this, 'addMetaBoxes') );
        add_action( 'save_post', array($this, '__mobjaan_contact_cpt_listing_custom_meta_box'));
        add_action( 'save_post', array($this, '__mobjaan_contact_cpt_user_data_custom_meta_box'));
    }

    function addMetaBoxes() 
    {
        add_meta_box( 'mobjaan-contact-listing', 'Lisitng', array($this, 'listingDialogueBox'), $this->post_type);
        add_meta_box( 'mobjaan-contact-data', 'User Data', array($this, 'contactDialogueBox'), $this->post_type);
    }

    function listingDialogueBox($post)
    {
        global $post;

        wp_nonce_field( '__mobjaan_contact_cpt_listing_custom_meta_box', 'listing_meta_box_nonce' );
        $listing_id = get_post_meta( $post->ID, '_contact_post_listing_id_key', true );
        $posts = get_posts( array('post_type' => 'listings') );
        if (!empty($posts)) 
        {   
            echo '<label for="mobjaan_contact_cpt_listing_id">Listing: </label>&nbsp; &nbsp; &nbsp; &nbsp;' ;
            echo '<select id="mobjaan_contact_cpt_listing_id" name="mobjaan_contact_cpt_listing_id" required="true">';
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

    function __mobjaan_contact_cpt_listing_custom_meta_box($post_id)
    {
        if (!isset($_POST['listing_meta_box_nonce'])) {
            return;
        }
        
        if (!wp_verify_nonce( $_POST['listing_meta_box_nonce'], '__mobjaan_contact_cpt_listing_custom_meta_box' ))
        {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
        
        if (!isset($_POST['mobjaan_contact_cpt_listing_id'])) return;
        $listing_id_key = $_POST['mobjaan_contact_cpt_listing_id'];
        update_post_meta( $post_id, '_contact_post_listing_id_key', $listing_id_key);
    }

    function contactDialogueBox($post)
    {
        
        wp_nonce_field('__mobjaan_contact_cpt_user_data_custom_meta_box', 'contact_user_data_meta_box_nonce');
        $user_name = get_post_meta( $post->ID, '_contact_post_user_name_key', true );
        $user_email = get_post_meta( $post->ID, '_contact_post_user_email_key', true );

        $this->generateTextField("User Name", $user_name);
        $this->generateTextField("User Email", $user_email);
        
    }

    function __mobjaan_contact_cpt_user_data_custom_meta_box($post_id) 
    {
        
        if (!isset($_POST['contact_user_data_meta_box_nonce'])) {
            return;
        }
        
        if (!wp_verify_nonce( $_POST['contact_user_data_meta_box_nonce'], '__mobjaan_contact_cpt_user_data_custom_meta_box' ))
        {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }


        if (!isset($_POST['mobjaan_contact_cpt_user_data_User_Name'])) return;
        $user_name = $_POST['mobjaan_contact_cpt_user_data_User_Name'];
        update_post_meta( $post_id, '_contact_post_user_name_key', $user_name);


        if (!isset($_POST['mobjaan_contact_cpt_user_data_User_Email'])) return;
        $user_email = $_POST['mobjaan_contact_cpt_user_data_User_Email'];
        update_post_meta( $post_id, '_contact_post_user_email_key', $user_email);
       
    }  
    private function generateTextField(string $fieldname, $value)
    {
        $fieldname_name = str_replace(" ", "_", $fieldname);
        echo "<div style='margin: 10px 0;'>";
        echo '<label for="mobjaan_contact_cpt_user_data_'.$fieldname_name.'" style="display: inline-block; width: 150px">'.$fieldname.': </label>' ;
        echo '<input style="display: inline-block; width: 400px" type="text" name="mobjaan_contact_cpt_user_data_'.$fieldname_name.'" id="mobjaan_contact_cpt_user_data_'.$fieldname_name.'" value="'. esc_attr( $value ) .'" placeholder="'.$fieldname.'"/>';
        echo '</div>';
    }
}