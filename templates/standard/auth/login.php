
<div class="menu menu--closed">

    <div class="button">
        <span> </span>
        <span> </span>
        <span> </span>
    </div>

    <div class="tools tools--hidden">
        <?php if (is_user_logged_in()): ?>
            <a href="<?php echo wp_logout_url( $_SERVER['REQUEST_URI'] ); ?>" title="Logout" class="mt-4">
                <i class="fas fa-sign-out-alt fa-2x"></i>
            </a>

            <a href="#" data-toggle="modal" data-target="#listings_Add_Modal" title="Add Listing">
                <i class="fas fa-th-list fa-2x"></i>
            </a>
        <?php else: ?>
            <a class="mt-5" href="<?php echo wp_login_url($_SERVER['REQUEST_URI']); ?>" title="Login">
                <i class="fas fa-sign-in-alt fa-2x"></i>
            </a>
        <?php endif; ?>
    </div>

</div>

<?php if (is_user_logged_in()): ?>
    <!-- Modal -->
    <div class="modal fade" id="listings_Add_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Listing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" enctype="multipart/form-data" method="post" id="add_lisitng_modal_form" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <h4>General Information</h4>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="f_name">First Name</label>
                                <input type="text" class="form-control" name="f_name" id="f_name" aria-describedby="emailHelp" placeholder="My Cool" required>
                            </div>
                            <div class="form-group col">
                                <label for="l_name">Last Name</label>
                                <input type="text" class="form-control" name="l_name" id="l_name" aria-describedby="emailHelp" placeholder="Hotel" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="tag_line">Tag Line</label>
                                <input type="text" class="form-control" name="tag_line" id="tag_line" aria-describedby="emailHelp" placeholder="We're the best!" required>
                            </div>
                            <div class="form-group col">
                                <label for="customFile">Banner</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="featured_image" accept="image/*" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="content"></label>
                            <textarea class="form-control" name="content" id="content" rows="10" cols="80" required>
                            </textarea>
                            <script>
                                CKEDITOR.replace( 'content' );
                            </script>

                        </div>

                    
                        <div class="form-group">
                            <h4>Contact Information</h4>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" aria-describedby="emailHelp" placeholder="Phone">
                            </div>
                            <div class="form-group col">
                                <label for="whatsapp">Whatsapp</label>
                                <input type="text" class="form-control" name="whatsapp" id="whatsapp" aria-describedby="emailHelp" placeholder="Whatsapp">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="emailHelp" placeholder="Twitter">
                            </div>
                            <div class="form-group col">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="emailHelp" placeholder="Facebook">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="emailHelp" placeholder="Linkedin">
                            </div>
                            <div class="form-group col">
                                <label for="youtube">Youtube</label>
                                <input type="text" class="form-control" name="youtube" id="youtube" aria-describedby="emailHelp" placeholder="Youtube">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" aria-describedby="emailHelp" placeholder="Instagram">
                            </div>
                            <div class="form-group col">
                                <label for="business_address">Business Address</label>
                                <input type="text" class="form-control" name="business_address" id="business_address" aria-describedby="emailHelp" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <h4>Pricing and Schedule</h4>
                        </div>
                        <div class="form-group ">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" aria-describedby="emailHelp" placeholder="$100">
                        </div>

                        <?php
                            $days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                            foreach($days as $day):
                        ?>

                        <div class="form-group ">
                            <label class="text-center d-block w-100" for="<?php echo $day; ?>_check_in"><?php echo $day; ?></label>
                            <div class="row">
                                <div class="col">
                                    <label class="ex-small" for="<?php echo $day; ?>_check_in">Check In</label>
                                    <select class="form-control" name="<?php echo $day; ?>_check_in" id="<?php echo $day; ?>_check_in">
                                        <option value="00:00">00:00</option>
                                        <option value="00:30">00:30</option>
                                        <option value="01:00">01:00</option>
                                        <option value="01:30">01:30</option>
                                        <option value="02:00">02:00</option>
                                        <option value="02:30">02:30</option>
                                        <option value="03:00">03:00</option>
                                        <option value="03:30">03:30</option>
                                        <option value="04:00">04:00</option>
                                        <option value="04:30">04:30</option>
                                        <option value="05:00">05:00</option>
                                        <option value="05:30">05:30</option>
                                        <option value="06:00">06:00</option>
                                        <option value="06:30">06:30</option>
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                        <option value="21:30">21:30</option>
                                        <option value="22:00">22:00</option>
                                        <option value="22:30">22:30</option>
                                        <option value="23:00">23:00</option>
                                        <option value="23:30">23:30</option>
                                        <option value="24:00">24:00</option>
                                        <option value="24:30">24:30</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="ex-small" for="<?php echo $day; ?>_check_out">Check Out</label>
                                    <select class="form-control" name="<?php echo $day; ?>_check_out" id="<?php echo $day; ?>_check_out" required>
                                        <option value="00:00">00:00</option>
                                        <option value="00:30">00:30</option>
                                        <option value="01:00">01:00</option>
                                        <option value="01:30">01:30</option>
                                        <option value="02:00">02:00</option>
                                        <option value="02:30">02:30</option>
                                        <option value="03:00">03:00</option>
                                        <option value="03:30">03:30</option>
                                        <option value="04:00">04:00</option>
                                        <option value="04:30">04:30</option>
                                        <option value="05:00">05:00</option>
                                        <option value="05:30">05:30</option>
                                        <option value="06:00">06:00</option>
                                        <option value="06:30">06:30</option>
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                        <option value="21:30">21:30</option>
                                        <option value="22:00">22:00</option>
                                        <option value="22:30">22:30</option>
                                        <option value="23:00">23:00</option>
                                        <option value="23:30">23:30</option>
                                        <option value="24:00">24:00</option>
                                        <option value="24:30">24:30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        
                        <input type="hidden" name="author_id" value="<?php echo get_current_user_id(); ?>">
                        <input type="hidden" name="action" value="submit_listing">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>