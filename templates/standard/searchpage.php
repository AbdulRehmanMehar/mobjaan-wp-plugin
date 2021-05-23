<?php 
    get_header();
?>


<?php




    if (isset($_GET['listing']) && !empty($_GET['listing'])) {
        $post_search_query = $_GET['listing'];
    } else if (isset($_GET['select']) && !empty($_GET['select'])) {
        $post_search_query = $_GET['select'];
    } else {
        $post_search_query = $_GET['s'];
    }

    $args = array(
        'post_type' => (isset($_GET['post_type'])) ? $_GET['post_type'] : 'post',
        's' => $post_search_query,
        'post_status' => 'publish',
        'orderby'     => 'title', 
        'order'       => 'ASC',  
    );

    if (isset($_GET['location']) && !empty($_GET['location'])) {
// 		$sb_args = array('tax_query' => )
//         array_push($args, $sb_args);
        $args['tax_query'][] = array(
            array(
                'taxonomy' => 'mobjaan_plugin_location_taxonomy',
                'field'    => 'term_id',
                'terms'    => $_GET['location']
            )
        );
    }
if (isset($_GET['category']) && !empty($_GET['category'])) {
        $args['tax_query'][] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $_GET['category']
            )
        );
    }

    if (isset($_GET['general_rating']) && !empty($_GET['general_rating'])) {
        $args['meta_query'][] = array(
            array(
                'key' => '_review_post_general_rating_key',
                'value'    => $_GET['general_rating']
            )
        );
    }
    wp_reset_query();
    query_posts( $args );
//     wp_reset_query();
//     query_posts( array(
//         'post_type' => (isset($_GET['post_type'])) ? $_GET['post_type'] . 's': 'post',
//         's' => (isset($_GET['select'])) ? $_GET['select']: $_GET['s'],
//         'post_status' => 'publish',
//         'orderby'     => 'title', 
//         'order'       => 'ASC'  
        
//         ) );

    
    ?>
		<div class="page-heading listing-page" style="position: relative;">
            <div class="page-heading-inner-container text-center" style="top: 30%;">
                <h1 style="font-size : 22px;">
					Search for "<span><?php echo $post_search_query; ?></span>" in
					
					<?php
						if ($_GET['post_type'] == 'listings') {
							echo " Partners";
						} else {
							echo "News and Tips";
						}
					
						if (isset($_GET['location']) && !empty($_GET['location'])) {
							echo " , ";
							echo "In Location \"<span>" . get_term($_GET['location'])->name . "</span>\"";
						}
					
						if (isset($_GET['category']) && !empty($_GET['category'])) {
							echo " , ";
							echo "In Category \"<span>" . get_term($_GET['category'])->name . "</span>\"";
						}
					?>
					
				</h1>
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><span>Search</span></li>
                </ul>						
            </div>
			
			
            <div class="page-header-overlay"></div>
			
			<div id="injected_search_form" style="position: absolute; right: 10px; bottom: 10px; left: 10px; color: #f1f3f5;">
				<form>
					<div class="row">
						<div class="col">
							<label for="listing">Search</label>
							<input type="text" id="listing" name="listing" class="form-control form-control-sm" placeholder="Listing" required value="<?php echo $post_search_query; ?>">
						</div>
						<div class="col">
							<label for="location">Location</label>
							<select id="location" name="location" class="form-control form-control-sm">
								<option value="">Location</option>
								<?php
									$terms = get_terms( array(
										'taxonomy' => 'mobjaan_plugin_location_taxonomy',
										'hide_empty' => true,
									));

									foreach($terms as $term) { ?>
										<option value="<?php echo $term->term_id; ?>" <?php if ($term->term_id == $_GET['location']) { echo "selected"; } ?> ><?php echo $term->name; ?> </option>;
								<?php	}
								?>
							</select>
						</div>
						
						<div class="col">
							<label for="category">Category</label>
							<select id="category" name="category" class="form-control form-control-sm">
								<option value="">Category</option>
								<?php
									$terms = get_terms( array(
										'taxonomy' => 'category',
										'hide_empty' => true,
									));

									foreach($terms as $term) { ?>
										<option value="<?php echo $term->term_id; ?>" <?php if ($term->term_id == $_GET['category']) { echo "selected"; } ?> ><?php echo $term->name; ?> </option>;
								<?php	}
								?>
							</select>
						</div>
						
						<div class="col">
							<label for="post_type">Search In</label>
							<select id="post_type" name="post_type" class="form-control form-control-sm">
								<option value="listings" <?php if($_GET['post_type'] == 'listings') {echo "selected";} ?>>Partners</option>
								<option value="post" <?php if($_GET['post_type'] == 'post') {echo "selected";} ?>>News and Tips</option>
							</select>
						</div>

						<div class="col">
<!-- 							<input type="hidden" name="lp_s_tag" id="lp_s_tag">
							<input type="hidden" name="lp_s_cat" id="lp_s_cat"> -->
							<input type="hidden" name="s" value="home">
<!-- 							<input type="hidden" name="post_type" value="listing">	 -->
							<label for="go">Go!</label>
							<button id="go" type="submit" class="btn btn-info form-control form-control-sm"><i class="fa fa-search"></i> Search</button>
						</div>
					</div>
				</form>
			</div>
        </div>
<?php    if (have_posts()):  ?>
        <div class="container my-5">
            <div class="row">

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
									<?php if ($_GET['post_type'] == 'listings'): ?>
										<div class="col">
											
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
									<?php endif; ?>

                                    <div class="col-12">
                                        <small class="d-inline-block mb-2" style="font-size: 12px;">
                                            <?php
                                                $term_list = get_the_terms(get_the_ID(), 'category');
                                                $location_list = get_the_terms(get_the_ID(), 'mobjaan_plugin_location_taxonomy');
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

    <?php else: ?>

        <div class="container my-4">
            <h6>Nothing found!</h6>
        </div>

    <?php endif; ?>

<?php wp_reset_postdata(); ?>


<style>
	#injected_search_form label {
		color: #f1f3f5;
	}
</style>

<?php get_footer(); ?>