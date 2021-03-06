<?php


/*
    Template Name: Mobjaan Homepage

*/

get_header();
?>

<?php

    if (is_category()) {
        $args = array(
                    'post_type' => array('listings'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'name',
                            'terms' => get_the_category()[0]->name,
                            'include_children' => true
                        ),
                    )
                );
    } else if ( is_tax() ) {
        $args = array(
                    'post_type' => array('listings'),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'mobjaan_plugin_location_taxonomy',
                            'field' => 'name',
                            'terms' => get_queried_object()->name,
                            'include_children' => true
                        ),
                    )
                );
    } else {
        $args = array(
            'post_type' => array('listings'),
        );
    }

    wp_reset_query();
    query_posts($args);

    if (have_posts()): 
    
    ?>
        <div class="container">
            <div class="row">

                <div class="col-12 text-center my-5">
                    <?php if (get_queried_object() == NULL): ?>
                        <h3>partner</h3>
                        <h6 class="strong-0">Our TOP partners for you!</h6>
                    <?php elseif (is_category()): ?>
                        <h3><?php echo get_the_category()[0]->name; ?></h3>
                        <h6 class="strong-0">Listings in <?php echo get_the_category()[0]->name; ?> and child categories</h6>
                    <?php elseif (is_tax()): ?>
                        <h3><?php echo get_queried_object()->name; ?></h3>
                        <h6 class="strong-0">Listings in <?php echo get_queried_object()->name; ?> and sub locations</h6>
                    <?php endif; ?>
                </div>

                <?php  while(have_posts()):  the_post(); ?>
                    <div class="col-md-4">
                        
                        <div class="card my-2 w-100" onclick="window.location.href = ('<?php the_permalink(); ?>');">
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
                                        $review_count = 0; 
                                    }
                                    wp_reset_postdata();
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <a href="<?php the_permalink(); ?>"><?php the_title( '<h4 class="mb-0 card-title">', '</h4>'); ?></a>
                                    </div>
                                    <div class="col" style="text-align: right;">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="Stars" style="--rating: <?php echo $review_average; ?>" aria-label="Rating"></div>
                                            </div>
                                            <div class="col-4">
                                                <div style="font-size: 12px;">
                                                    (<?php echo $review_count; ?>)
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="col-12">
                                        <small class="d-inline-block mb-2" style="font-size: 12px;">
                                            <?php
                                                $term_list = get_the_terms(get_the_ID(), 'category');
                                                $location_list = get_the_terms(get_the_ID(), 'mobjaan_plugin_location_taxonomy');
                                                if ($term_list) 
                                                {
                                                    $types ='';
                                                    foreach($term_list as $term_single) {
                                                        $types .= ucfirst('<a href="/'.$term_single->slug.'"> <i class="fa fa-list-ul" aria-hidden="true"></i> '.$term_single->name.'</a>'). ', ';
                                                    }
                                                    $typesz = rtrim($types, ', ');
                                                    echo $typesz;

                                                    // if ($location_list) echo ' - ';
                                                }
                                            ?>
                                        </small>  

                                        <small class="d-inline-block mb-2"  style="font-size: 12px;">
                                            <?php
                                                $term_list = $location_list;
                                                // var_dump($term_list);
                                                if ($term_list) 
                                                {
                                                    $types ='';
                                                    foreach($term_list as $term_single) {
                                                        $types .= ucfirst('<a href="/location/'.$term_single->slug.'"> <i class="fa fa-map-marker" aria-hidden="true"></i> '.$term_single->name.'</a>'). ', ';
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

       
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>


    <!-- Other POSTs TYPES -->
    <?php
        $bool = get_queried_object() == NULL;
        wp_reset_query();
       
            $args = array(
                'post_type' => array('post'),
            );
        
        query_posts(  $args  );
    
        if (have_posts() && $bool): 
    ?>

        <div class="container">
            <div class="row">

                <div class="col-12 text-center my-5">
                    <h3>News and Tips</h3>
                    <h6 class="strong-0">So That You Can Find The Right Craftsmen!</h6>
                </div>

                <?php  while(have_posts()):  the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card my-2 w-100">

                            <?php if(has_post_thumbnail()): ?>
                                <div class="bg-img" style="height: 300px; background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                                    <a class="view" href="<?php echo get_the_post_thumbnail_url(); ?>" target="_blank">&#128065;</a>
                                </div>
                            <?php endif; ?>

                            <div class="card-body p-1 pt-3 px-5">
                                <div class="row">
                                    <div class="col-12 text-center mb-1">
                                        <small class="d-block text-muted" style="font-size: 11px;">
                                            <?php
                                                $term_list = get_the_terms(get_the_ID(), 'category');
                                                if ($term_list) 
                                                {
                                                    $types ='';
                                                    foreach($term_list as $term_single) {
                                                        $types .= ucfirst('<a href="/'.$term_single->slug.'">  <i class="fa fa-list-ul" aria-hidden="true"></i> '.$term_single->name.'</a>'). ', ';
                                                    }
                                                    $typesz = rtrim($types, ', ');
                                                    echo $typesz;
                                                }
                                            ?>
                                        </small>
                                        <a href="<?php the_permalink(); ?>"><?php the_title( '<h5 class="mt-1 card-title">', '</h5>'); ?></a>
                                    </div>

                                    <div class="col"  style="font-size: 11px;">
                                        <i class="fa fa-user" aria-hidden="true"></i> 
                                        <span><?php the_author(); ?></span>
                                    </div>

                                    <div class="col"  style="font-size: 11px;">
                                        <i class="fa fa-calendar-alt" aria-hidden="true"></i> 
                                        <span><?php the_date(); ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    <?php  endif; ?>

<script>
let searchbar = $('.lp-search-bar')[0];
    searchbar.innerHTML = (`
        <form>
            <div class="row">
                <div class="col">
                    <input type="text" name="listing" class="form-control" placeholder="Listing" required>
                </div>
                <div class="col">
                    <select name="location" class="form-control">
                        <option selected value="">Location</option>
                        <?php
                            $terms = get_terms( array(
                                'taxonomy' => 'mobjaan_plugin_location_taxonomy',
                                'hide_empty' => true,
                            ));
                            
                            foreach($terms as $term) {
                                echo '<option value="'.$term->term_id.'">'. $term->name .'</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="col">
                    <input type="hidden" name="lp_s_tag" id="lp_s_tag">
                    <input type="hidden" name="lp_s_cat" id="lp_s_cat">
                    <input type="hidden" name="s" value="home">
                    <input type="hidden" name="post_type" value="listings">	

                    <button type="submit" class="btn btn-info form-control"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </form>
    `);
</script>


<?php get_footer(); ?>
