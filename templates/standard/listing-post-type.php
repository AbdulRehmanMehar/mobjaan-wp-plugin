<?php

/*
    Template Name: Layout for Listings

*/

get_header();
the_post();


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
    $review_count = 0;
    $review_average = 0;
}
wp_reset_postdata();


// Custom META FIELDS
$tag_line = get_post_meta( get_the_ID(), '_listings_company_details_tag_line_key', true );
$phone = get_post_meta( get_the_ID(), '_listings_company_details_phone_key', true );
$whatsapp = get_post_meta( get_the_ID(), '_listings_company_details_whatsapp_key', true );
$twitter = get_post_meta( get_the_ID(), '_listings_company_details_twitter_key', true );
$facebook = get_post_meta( get_the_ID(), '_listings_company_details_facebook_key', true );
$linkedin = get_post_meta( get_the_ID(), '_listings_company_details_linkedin_key', true );
$youtube = get_post_meta( get_the_ID(), '_listings_company_details_youtube_key', true );
$insta = get_post_meta( get_the_ID(), '_listings_company_details_insta_key', true );
$address = get_post_meta( get_the_ID(), '_listings_company_details_business_address_key', true );
$price = get_post_meta( get_the_ID(), '_listings_company_details_pricing_key', true );

$major_check_show_contact_info_tab = false;

if (
    !empty($phone) ||
    !empty($whatsapp) ||
    !empty($twitter) ||
    !empty($facebook) ||
    !empty($linkedin) ||
    !empty($youtube) ||
    !empty($insta) ||
    !empty($address) 
) $major_check_show_contact_info_tab = true;



$company_sunday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_sunday_check_in_key', true );
$company_sunday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_sunday_check_out_key', true );
$company_monday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_monday_check_in_key', true );
$company_monday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_monday_check_out_key', true );
$company_tuesday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_tuesday_check_in_key', true );
$company_tuesday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_tuesday_check_out_key', true );
$company_wednesday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_wednesday_check_in_key', true );
$company_wednesday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_wednesday_check_out_key', true );
$company_thursday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_thursday_check_in_key', true );
$company_thursday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_thursday_check_out_key', true );
$company_friday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_friday_check_in_key', true );
$company_friday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_friday_check_out_key', true );
$company_saturday_check_in = get_post_meta( get_the_ID(), '_listings_company_details_saturday_check_in_key', true );
$company_saturday_check_out = get_post_meta( get_the_ID(), '_listings_company_details_saturday_check_out_key', true );


?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-12">
            <div class="header mb-5">
                <div class="bg-img" style=" background-color: #F8F8F8; height: 300px; background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                    <a class="view" href="<?php echo get_the_post_thumbnail_url(); ?>" target="_blank">&#128065;</a>
                </div>
                <div class="py-4" style="background-color: #E8E8E8">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-10 col-sm-12 offset-md-1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
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

                                            <?php the_title( '<h4 class="mb-0 display-5">', '</h4>'); ?>
                                            <small class="ex-small"><?php echo $tag_line; ?></small>
                                        </div>

                                        <div class="col-md-6 col-sm-12 text-right ">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-12">
                                                    <div class="my-1">
                                                        <div class="Stars" style="--rating: <?php echo $review_average; ?>" aria-label="Rating"></div>
                                                    </div>
                                                    <?php if($review_count > 0): ?>
                                                        <div class="my-1">
                                                            
                                                            <span class="badge badge-primary"><?php echo $review_average . ' / 5'; ?></span>
                                                            <small class="ex-small">
                                                                
                                                                <?php
                                                                    if($review_count == 1) {
                                                                        echo '1 review';
                                                                    } else {
                                                                        echo $review_count . ' reviews';
                                                                    }
                                                                ?>
                                                            </small>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="my-1">
                                                            <small class="ex-small">No Review was left.</small>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-md-4 col-sm-12 text-left">
                                                    <?php if (is_user_logged_in()): ?>
                                                        <button type="button" class="d-block my-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#add_review_modal">
                                                            Leave a Review
                                                        </button>
                                                        <!-- <button type="button" class="d-block my-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#add_message_modal">
                                                            Write a Mesage
                                                        </button> -->
                                                    <?php else: ?>
                                                        <a href="<?php echo wp_login_url($_SERVER['REQUEST_URI']); ?>" class="d-block btn btn-sm btn-primary">
                                                            Login to leave review or message
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Top Tile Ends -->

                            </div>
                        </div>
                    </div>
                </div> <!-- Top Tile Container -->
            </div><!-- Header ends -->

            <div class="body my-5">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-9 col-sm-12">

                            <div class="card p-2 my-4 w-100">
                                <div class="card-body">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <?php if($review_count > 0): ?>

                                
                                <div class="card my-4 w-100">
                                    <div class="card-body">
                                        <div id="carouselExampleIndicators" class="testimonial carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php for($i=0; $i < $review_count; $i++): ?>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php echo ($i == 0 ? "class='active'" : "") ?> ></li>
                                                <?php endfor; ?>
                                            </ol>
                                            <div class="carousel-inner">
                                            <?php
                                
                                                $query = new WP_Query(array(
                                                    'post_type' => 'reviews',
                                                    'meta_key' => '_review_post_listing_id_key',
                                                    'meta_value' => get_the_ID()
                                                ));
                                                $count = 0;
                                                while ($query->have_posts()):
                                                    $query->the_post();
                                                    $review_id = get_the_ID();
                                                    $price_value = get_post_meta( $review_id, '_review_post_price_rating_key', true );
                                                    $quality_value = get_post_meta( $review_id, '_review_post_quality_rating_key', true );
                                                    $contact_value = get_post_meta( $review_id, '_review_post_contact_rating_key', true );
                                                    $general_value = get_post_meta( $review_id, '_review_post_general_rating_key', true );
                                                    $avg = (($price_value?$price_value:0) + ($quality_value?$quality_value:0) + ($contact_value?$contact_value:0) + ($general_value?$general_value:0)) / 4;
                                                    
                                            ?>
                                                <div class="carousel-item testimonial-item <?php echo ($count == 0 ? 'active': ''); ?>">
                                                    <div class="col-md-6 offset-md-3">
                                                        
                                                                <div class="carousel-txt">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <h6 class="ex-small">@<?php the_author(); ?></h6>
                                                                            <div class="Stars" style="--rating: <?php echo $avg; ?>" aria-label="Rating"></div>   
                                                                            <?php the_title( '<h4>', '</h4>'); ?>
                                                                        </div>
                                                                        <div class="col">
                                                                            <p class="ex-small">
                                                                                <span class="d-block my-1">
                                                                                    <span class="d-inline-block mx-2">  <span style="width: 20px">Price:</span> <span class="badge badge-secondary"><?php echo $price_value . ' / 5'; ?></span></span>
                                                                                    <span class="d-inline-block mx-4">  <span style="width: 20px">Quality:</span> <span class="badge badge-secondary"><?php echo $quality_value . ' / 5'; ?></span></span>
                                                                                </span>
                                                                                <span class="d-block my-1">
                                                                                    <span class="d-inline-block mx-2">  <span style="width: 20px">Contact:</span> <span class="badge badge-secondary"><?php echo $contact_value . ' / 5'; ?></span></span>
                                                                                    <span class="d-inline-block mx-2">  <span style="width: 20px">General:</span> <span class="badge badge-secondary"><?php echo $general_value . ' / 5'; ?></span></span>
                                                                                </span>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <p class="testimonial-txt ex-small"><?php echo get_the_content(); ?></p>
                                                                    
                                                                </div>
                                                        
                                                    </div>
                                                </div>
                                            
                                            <?php
                                                $count++;
                                                endwhile;
                                                wp_reset_postdata();
                                            ?>
                                            
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="col-md-3 col-sm-12">
                            <?php if ($major_check_show_contact_info_tab): ?>
                                <div class="card my-4 w-100">
                                    <div class="card-body">
                                        <div class="links-list">
                                            <?php if(!empty($phone)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fas fa-phone-volume"></i> <?php echo $phone; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($whatsapp)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-whatsapp"></i> <?php echo $whatsapp; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($twitter)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-twitter"></i> <?php echo $twitter; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($facebook)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-facebook"></i> <?php echo $facebook; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($linkedin)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-linkedin"></i> <?php echo $linkedin; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($youtube)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-youtube"></i> <?php echo $youtube; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($insta)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fab fa-instagram"></i> <?php echo $insta; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(!empty($address)): ?>
                                                <a class="ex-small d-block my-2" target="_blank" href="#">
                                                    <i class="fas fa-map-pin"></i> <?php echo $address; ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div> <!-- Contact Info -->
                            <?php endif; ?>
                            <div class="card my-4 w-100">
                                <div class="card-body" style="overflow-x: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sunday</td>
                                                <td><?php echo $company_sunday_check_in; ?></td>
                                                <td><?php echo $company_sunday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Monday</td>
                                                <td><?php echo $company_monday_check_in; ?></td>
                                                <td><?php echo $company_monday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tuesday</td>
                                                <td><?php echo $company_tuesday_check_in; ?></td>
                                                <td><?php echo $company_tuesday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Wednesday</td>
                                                <td><?php echo $company_wednesday_check_in; ?></td>
                                                <td><?php echo $company_wednesday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Thursday</td>
                                                <td><?php echo $company_thursday_check_in; ?></td>
                                                <td><?php echo $company_thursday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Friday</td>
                                                <td><?php echo $company_friday_check_in; ?></td>
                                                <td><?php echo $company_friday_check_out; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Saturday</td>
                                                <td><?php echo $company_saturday_check_in; ?></td>
                                                <td><?php echo $company_saturday_check_out; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- Timings... -->


                        </div>

                    </div>

                </div>

            </div>                            
        </div>
    </div>
</div>

<?php if (is_user_logged_in()): ?>
    <!-- Review Modal -->
    <div class="modal fade" id="add_review_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave a review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form method="post" action="#" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>" id="review_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="review_title_Field">Title</label>
                            <input type="text" class="form-control" name="review_title_Field" id="review_title_Field" placeholder="It's Superb" required>
                        </div>
                        <div class="form-group">
                            <label for="review_feedback">Feedback</label>
                            <textarea class="form-control" name="review_feedback" id="review_feedback" rows="3" required></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="price_rating_review">Price</label>
                                <select class="form-control" name="price_rating_review" id="price_rating_review">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="quality_rating_review">Quality</label>
                                <select class="form-control" name="quality_rating_review" id="quality_rating_review">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="contact_rating_review">Contact</label>
                                <select class="form-control" name="contact_rating_review" id="contact_rating_review">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="general_rating_review">General</label>
                                <select class="form-control" name="general_rating_review" id="general_rating_review">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="listing_id" value="<?php echo get_the_ID(); ?>">
                        <input type="hidden" name="author_id" value="<?php echo get_current_user_id(); ?>">
                        <input type="hidden" name="action" value="submit_review">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                    <script>
                        // let review_form = document.getElementById('review_form');
                        // review_form.addEventListener('submit', function () {
                        //     $event.preventDefault();
                            // 
                        //     console.log(data);
                        // });
                    </script>
                </form>
        </div>
    </div>

    <!-- Write Message Modal -->
<?php endif; ?>

<?php get_footer(); ?>