<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;

use Mobjaan\Base\Constants;


class Templates 
{


    function register() 
    {
        add_filter( 'template_include', array($this, 'loadTemplate') );
        add_action( 'pre_get_posts', array($this, 'namespace_add_custom_types') );
    }

    function loadTemplate($template)
    {
        global $post;

        if (is_front_page() || is_category() || is_tax())
        {
            return $this->validateFileAndReturn('templates/standard/home-page.php');
        }

        if (isset($post)) 
        {

            if ($post->post_type == 'listings') 
            {
                return $this->validateFileAndReturn('templates/standard/listing-post-type.php');
            }
        }


        

        if (is_search())
        {
            return $this->validateFileAndReturn('templates/standard/searchpage.php');
        }

        return $template;
    }

    protected function validateFileAndReturn(string $filename)
    {
        $file = Constants::getPluginPath() . $filename;

        if (file_exists($file))
        {
            return $file;
        }
    }

    function namespace_add_custom_types( $query ) {
        if( (is_category() || is_tag() || is_tax() ) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
          $query->set( 'post_type', array(
            'post', 'listings'
            ));
        }
    }
}