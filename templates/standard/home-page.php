<?php


/*
    Template Name: Mobjaan Homepage

*/

get_header();
?>

<?php
    wp_reset_query();
    query_posts( array('post_type' => array('listings')) );

    if (have_posts()): 
    
    ?>
        <div class="container">
            <div class="row">

                <?php  while(have_posts()):  the_post(); ?>
                    <div class="col-md-4">
                    
                        <div class="card" style="width: 100%;">
                            <?php if(has_post_thumbnail()): ?>
                                
                            <?php endif; ?>
                            <div class="card-body">
                                <a href="<?php the_permalink(); ?>"><?php the_title( '<h5 class="card-title">', '</h5>'); ?></a>
                                <p class="card-text"><?php the_excerpt(); ?></p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>

                    </div>
                        
                        

                <?php endwhile; ?>

            </div>
        </div>

       
    <?php endif; ?>

<?php get_footer(); ?>
