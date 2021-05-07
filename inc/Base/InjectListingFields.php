<?php
/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Base;

use Mobjaan\Base\Constants;


class InjectListingFields 
{
    private $post_type;

    function __construct()
    {
        $this->post_type = 'listings';
    }

    function register()
    {
        add_action('admin_init', array($this, 'registerFileUpload'));
        add_action( 'add_meta_boxes', array($this, 'addMetaBoxes') );
        add_action( 'save_post', array($this, '__mobjaan_listing_cpt_company_details_custom_meta_box'));
    }

    function registerFileUpload()
    {
        register_setting('registerFileUpload', 'mobjaan_listing_cpt_company_Company_Logo');
        register_setting('registerFileUpload', 'mobjaan_listing_cpt_company_Branding_Video');
    }

    function addMetaBoxes() 
    {
        add_meta_box( 'mobjaan-listing-company-details', 'Company Detials', array($this, 'companyDetailsDialogueBox'), $this->post_type);
    }

    function companyDetailsDialogueBox($post)
    {
        global $post;

        wp_nonce_field( '__mobjaan_listing_cpt_company_details_custom_meta_box', 'listings_cpt_company_details_meta_box_nonce' );
        // $company_first_name = get_post_meta( $post->ID, '_listings_company_details_fname_key', true );
        // $company_last_name = get_post_meta( $post->ID, '_listings_company_details_lname_key', true );
        $company_tag_line = get_post_meta( $post->ID, '_listings_company_details_tag_line_key', true );
        // $company_city = get_post_meta( $post->ID, '_listings_company_details_city_key', true );
        $company_address = get_post_meta( $post->ID, '_listings_company_details_address_key', true );
        $company_phone = get_post_meta( $post->ID, '_listings_company_details_phone_key', true );
        $company_whatsapp = get_post_meta( $post->ID, '_listings_company_details_whatsapp_key', true );
        $company_twitter = get_post_meta( $post->ID, '_listings_company_details_twitter_key', true );
        $company_facebook = get_post_meta( $post->ID, '_listings_company_details_facebook_key', true );
        $company_linkedin = get_post_meta( $post->ID, '_listings_company_details_linkedin_key', true );
        $company_youtube = get_post_meta( $post->ID, '_listings_company_details_youtube_key', true );
        $company_insta = get_post_meta( $post->ID, '_listings_company_details_insta_key', true );
        $company_business_address = get_post_meta( $post->ID, '_listings_company_details_business_address_key', true );
        $company_website = get_post_meta( $post->ID, '_listings_company_details_website_key', true );
        // $company_category = get_post_meta( $post->ID, '_listings_company_details_category_key', true );
        // $company_description = get_post_meta( $post->ID, '_listings_company_details_description_key', true );
        // $company_video_url = get_post_meta( $post->ID, '_listings_company_details_video_url_key', true );
        $company_branding_video = get_post_meta( $post->ID, '_listings_company_details_branding_video_key', true );
        // $company_featured_image = get_post_meta( $post->ID, '_listings_company_details_featured_image_key', true );
        $company_business_logo = get_post_meta( $post->ID, '_listings_company_details_business_logo_key', true );
        $company_pricing = get_post_meta( $post->ID, '_listings_company_details_pricing_key', true );
        $company_sunday_check_in = get_post_meta( $post->ID, '_listings_company_details_sunday_check_in_key', true );
        $company_sunday_check_out = get_post_meta( $post->ID, '_listings_company_details_sunday_check_out_key', true );
        $company_monday_check_in = get_post_meta( $post->ID, '_listings_company_details_monday_check_in_key', true );
        $company_monday_check_out = get_post_meta( $post->ID, '_listings_company_details_monday_check_out_key', true );
        $company_tuesday_check_in = get_post_meta( $post->ID, '_listings_company_details_tuesday_check_in_key', true );
        $company_tuesday_check_out = get_post_meta( $post->ID, '_listings_company_details_tuesday_check_out_key', true );
        $company_wednesday_check_in = get_post_meta( $post->ID, '_listings_company_details_wednesday_check_in_key', true );
        $company_wednesday_check_out = get_post_meta( $post->ID, '_listings_company_details_wednesday_check_out_key', true );
        $company_thursday_check_in = get_post_meta( $post->ID, '_listings_company_details_thursday_check_in_key', true );
        $company_thursday_check_out = get_post_meta( $post->ID, '_listings_company_details_thursday_check_out_key', true );
        $company_friday_check_in = get_post_meta( $post->ID, '_listings_company_details_friday_check_in_key', true );
        $company_friday_check_out = get_post_meta( $post->ID, '_listings_company_details_friday_check_out_key', true );
        $company_saturday_check_in = get_post_meta( $post->ID, '_listings_company_details_saturday_check_in_key', true );
        $company_saturday_check_out = get_post_meta( $post->ID, '_listings_company_details_saturday_check_out_key', true );

        echo "<p><b>General Information</b></p>";
        // $this->generateTextField('First Name', $company_first_name);
        // $this->generateTextField('Last Name', $company_last_name);
        $this->generateTextField('Tag Line', $company_tag_line);
        echo "<p><b>Contact Information</b></p>";
        $this->generateTextField('Phone', $company_phone);
        $this->generateTextField('Whatsapp', $company_whatsapp);
        $this->generateTextField('Twitter', $company_twitter);
        $this->generateTextField('Facebook', $company_facebook);
        $this->generateTextField('Linkedin', $company_linkedin);
        $this->generateTextField('Youtube', $company_youtube);
        $this->generateTextField('Instagram', $company_insta);
        $this->generateTextField('Business Address', $company_business_address);
        // echo "<p><b>Identity Information</b></p>";
        // $this->generateMediaField('Company Logo', 'image/*', $company_business_logo);
        // $this->generateMediaField('Branding Video', 'video/*', $company_branding_video);
        echo "<p><b>Pricing and Business Hours</b></p>";
        $this->generateTextField('Price', $company_pricing);
        $this->generateCheckInCheckOutField('Sunday', $company_sunday_check_in, $company_sunday_check_out);
        $this->generateCheckInCheckOutField('Monday', $company_monday_check_in, $company_monday_check_out);
        $this->generateCheckInCheckOutField('Tuesday', $company_tuesday_check_in, $company_tuesday_check_out);
        $this->generateCheckInCheckOutField('Wednesday', $company_wednesday_check_in, $company_wednesday_check_out);
        $this->generateCheckInCheckOutField('Thursday', $company_thursday_check_in, $company_thursday_check_out);
        $this->generateCheckInCheckOutField('Friday', $company_friday_check_in, $company_friday_check_out);
        $this->generateCheckInCheckOutField('Saturday', $company_saturday_check_in, $company_saturday_check_out);
       
        
    }

    function __mobjaan_listing_cpt_company_details_custom_meta_box($post_id)
    {
        if (!isset($_POST['listings_cpt_company_details_meta_box_nonce'])) {
            return;
        }
        
        if (!wp_verify_nonce( $_POST['listings_cpt_company_details_meta_box_nonce'], '__mobjaan_listing_cpt_company_details_custom_meta_box' ))
        {
            return;
        }
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        
        if (!current_user_can( 'edit_post', $post_id )) {
            return;
        }
        
        // if (!isset($_POST['mobjaan_listing_cpt_company_First_Name'])) return;
        // $c_fname = $_POST['mobjaan_listing_cpt_company_First_Name'];
        // update_post_meta( $post_id, '_listings_company_details_fname_key', $c_fname);

        // if (!isset($_POST['mobjaan_listing_cpt_company_Last_Name'])) return;
        // $c_lname = $_POST['mobjaan_listing_cpt_company_Last_Name'];
        // update_post_meta( $post_id, '_listings_company_details_lname_key', $c_lname);

        if (!isset($_POST['mobjaan_listing_cpt_company_Tag_Line'])) return;
        $c_lname = $_POST['mobjaan_listing_cpt_company_Tag_Line'];
        update_post_meta( $post_id, '_listings_company_details_tag_line_key', $c_lname);

        if (!isset($_POST['mobjaan_listing_cpt_company_Phone'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Phone'];
        update_post_meta( $post_id, '_listings_company_details_phone_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Whatsapp'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Whatsapp'];
        update_post_meta( $post_id, '_listings_company_details_whatsapp_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Twitter'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Twitter'];
        update_post_meta( $post_id, '_listings_company_details_twitter_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Facebook'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Facebook'];
        update_post_meta( $post_id, '_listings_company_details_facebook_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Linkedin'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Linkedin'];
        update_post_meta( $post_id, '_listings_company_details_linkedin_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Youtube'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Youtube'];
        update_post_meta( $post_id, '_listings_company_details_youtube_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Instagram'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Instagram'];
        update_post_meta( $post_id, '_listings_company_details_insta_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Business_Address'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Business_Address'];
        update_post_meta( $post_id, '_listings_company_details_business_address_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Price'])) return;
        $the_key = $_POST['mobjaan_listing_cpt_company_Price'];
        update_post_meta( $post_id, '_listings_company_details_pricing_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Sunday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Sunday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_sunday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Sunday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Sunday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_sunday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Monday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Monday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_monday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Monday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Monday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_monday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Tuesday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Tuesday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_tuesday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Tuesday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Tuesday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_tuesday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Wednesday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Wednesday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_wednesday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Wednesday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Wednesday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_wednesday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Thursday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Thursday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_thursday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Thursday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Thursday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_thursday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Friday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Friday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_friday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Friday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Friday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_friday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Saturday_check_in'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Saturday_check_in'];
        update_post_meta( $post_id, '_listings_company_details_saturday_check_in_key', $the_key);

        if (!isset($_POST['mobjaan_listings_cpt_company_business_hours_Saturday_check_out'])) return;
        $the_key = $_POST['mobjaan_listings_cpt_company_business_hours_Saturday_check_out'];
        update_post_meta( $post_id, '_listings_company_details_saturday_check_out_key', $the_key);

        if (!isset($_POST['mobjaan_listing_cpt_company_Company_Logo'])) return;
        // $the_key = $_POST['mobjaan_listing_cpt_company_Company_Logo'];
        $attach_id = media_handle_upload( 'mobjaan_listing_cpt_company_Company_Logo', $post_id );
        var_dump($attach_id);
        die;
        if (is_numeric($attach_id)) {
            update_option('option_image', $attach_id);
            update_post_meta( $post_id, '_listings_company_details_business_logo_key', $attach_id);
        }

        if (!isset($_POST['mobjaan_listing_cpt_company_Branding_Video'])) return;
        // $the_key = $_POST['mobjaan_listing_cpt_company_Branding_Video'];
        $attach_id = media_handle_upload( 'mobjaan_listing_cpt_company_Branding_Video', $post_id );
        if (is_numeric($attach_id)) {
            update_option('option_image', $attach_id);
            update_post_meta( $post_id, '_listings_company_details_branding_video_key', $attach_id);
        }
    }


    private function generateTextField(string $fieldname, $value)
    {
        $fieldname_name = str_replace(" ", "_", $fieldname);
        echo "<div style='margin: 10px 0;'>";
        echo '<label for="mobjaan_listing_cpt_company_'.$fieldname_name.'" style="display: inline-block; width: 150px">'.$fieldname.': </label>' ;
        echo '<input style="display: inline-block; width: 400px" type="text" name="mobjaan_listing_cpt_company_'.$fieldname_name.'" id="mobjaan_listing_cpt_company_'.$fieldname_name.'" value="'. esc_attr( $value ) .'" placeholder="'.$fieldname.'"/>';
        echo '</div>';
    }

    public function generateMediaField(string $fieldname, $type, $value)
    {
        $fieldname_name = str_replace(" ", "_", $fieldname);
        echo "<div style='margin: 10px 0;'>";
        echo '<label for="mobjaan_listing_cpt_company_'.$fieldname_name.'" style="display: inline-block; width: 150px">'.$fieldname.': </label>' ;
        echo '<input style="display: inline-block; width: 400px" type="file" accept="'. $type .'" name="mobjaan_listing_cpt_company_'.$fieldname_name.'" id="mobjaan_listing_cpt_company_'.$fieldname_name.'" placeholder="'.$fieldname.'" aria-required="true" multiple="false"/>';
        if (isset($value) && !empty($value)) echo '<a href="'. $value .'" target="_blank" style="display: inline-block;">Preview</a>';
        echo '</div>';
    }

    private function generateCheckInCheckOutField(string $filedname, $check_in, $check_out) 
    {
        $fieldname_name = str_replace(" ", "_", $filedname);
        echo "<div style='margin: 10px 0;'>";
        echo '<label for="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_in" style="display: inline-block; width: 150px">'.$filedname.': </label>' ;
        echo '<label for="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_in"  style="display: inline-block; width: 50px">From: </label>';
        echo '<select style="display: inline-block; width: 150px" id="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_in" name="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_in" required="true">';
        $this->generateTimeOptions($check_in);
        echo '</select>';

        echo '<label for="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_out"  style="display: inline-block; width: 35px; text-align: right; margin-right: 15px;">To: </label>';
        echo '<select style="display: inline-block; width: 150px" id="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_out" name="mobjaan_listings_cpt_company_business_hours_'.$fieldname_name.'_check_out" required="true">';
        $this->generateTimeOptions($check_out);
        echo '</select></div>';
    }

    private function generateTimeOptions($current)
    {
        for ($i = 0; $i <= 24; $i++){
            for ($j = 0; $j <= 45; $j+=30){

                $ct = ($i < 10 ? '0'.$i : $i) . ':' . ($j < 10 ? '0'.$j : $j);
                echo '<option value="'. $ct .'"';
                if ($ct == $current)
                {
                    echo ' selected="selected"';
                }
                echo '>';
                echo $ct;
                echo '</option>';
            }
        }
    }
}