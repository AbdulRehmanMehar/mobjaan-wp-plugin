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
    }

    function loadTemplate($template)
    {
        global $post;

        if (isset($post)) 
        {

            if ($post->post_type == 'listings') 
            {
                return $this->validateFileAndReturn('templates/standard/listing-post-type.php');
            }
        }


        if (is_front_page())
        {
            return $this->validateFileAndReturn('templates/standard/home-page.php');
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
}