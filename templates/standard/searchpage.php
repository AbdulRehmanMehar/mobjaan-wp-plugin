<?php 
    get_header();
?>


<?php
    wp_reset_query();
    query_posts( array(
        'post_type' => (isset($_GET['post_type'])) ? $_GET['post_type'] . 's': 'post',
        's' => (isset($_GET['select'])) ? $_GET['select']: $_GET['s'],
        'post_status' => 'publish',
        'orderby'     => 'title', 
        'order'       => 'ASC'  
        
        ) );

    if (have_posts()): 
    
    ?>
        <div class="container">
            <div class="row">

                <?php  while(have_posts()):  the_post(); ?>
                    <div class="col-md-4">
                    
                        <div class="card my-2 w-100">
                            <?php if(has_post_thumbnail()): ?>
                                <div class="bg-img" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                                    <a class="view" href="<?php echo get_the_post_thumbnail_url(); ?>" target="_blank">&#128065;</a>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <?php
                                    $query = new WP_Query(array(
                                        'post_type' => 'reviews',
                                        'meta_key' => '_review_post_listing_id_key',
                                        'meta_value' => get_the_ID()
                                    ));
                                    if ($query->have_posts()) 
                                    {
                                        $review_count = 0; 
                                        $review_sum = 0;
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                            $review_id = get_the_ID();
                                            $price_value = get_post_meta( $review_id, '_review_post_price_rating_key', true );
                                            $quality_value = get_post_meta( $review_id, '_review_post_quality_rating_key', true );
                                            $contact_value = get_post_meta( $review_id, '_review_post_contact_rating_key', true );
                                            $general_value = get_post_meta( $review_id, '_review_post_general_rating_key', true );
                                            $avg = (($price_value?$price_value:0) + ($quality_value?$quality_value:0) + ($contact_value?$contact_value:0) + ($general_value?$general_value:0)) / 4;
                                            $review_sum+= $avg;
                                            $review_count++;
                                        }

                                        $review_average = $review_sum / $review_count;
                                    }
                                    else
                                    {
                                        $review_average = 0;
                                    }
                                    wp_reset_postdata();
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <a href="<?php the_permalink(); ?>"><?php the_title( '<h4 class="mb-0 card-title">', '</h4>'); ?></a>
                                    </div>
                                    <div class="col">
                                        <div class="Stars right" style="--rating: <?php echo $review_average; ?>" aria-label="Rating"></div>
                                    </div>

                                    <div class="col-12">
                                        <small class="d-block mb-2" style="font-size: 12px;">
                                            <?php
                                                $term_list = get_the_terms(get_the_ID(), 'category');
                                                if ($term_list) 
                                                {
                                                    $types ='';
                                                    foreach($term_list as $term_single) {
                                                        $types .= ucfirst('<a href="'.$term_single->slug.'">'.$term_single->name.'</a>'). ', ';
                                                    }
                                                    $typesz = rtrim($types, ', ');
                                                    echo $typesz;
                                                }
                                            ?>
                                        </small>
                                            
                                        

                                        <p class="card-text"><small><?php echo substr(get_the_excerpt(), 0, 84); ?></small></p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                        
                        

                <?php endwhile; ?>

            </div>
        </div>

    <?php else: ?>

        <div class="container my-4">
            <h6>Nothing found!</h6>
        </div>

    <?php endif; ?>

<?php wp_reset_postdata(); ?>

<style>
.search-page-header .container .col-md-6.col-sm-6.text-right,
.form-inline.lp-filter-inner {
    display: none !important;
}
 
</style>

<?php get_footer(); ?>