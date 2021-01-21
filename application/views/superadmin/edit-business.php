<div class="content-body">
    <div class="card card-block bg-white">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <?php
            $attributes = array('class' => 'card-body', 'id' => 'data_form');
            echo form_open('su/business/update/'.$business->id, $attributes);
        ?>
            <?php
                if ($this->session->flashdata('error')){
                    echo '<div class="alert alert-danger">';
                    echo $this->session->flashdata('error');
                    echo "</div>";
                }
            ?>
            <h5>
                Edit <?php echo $this->lang->line('Business Details') ?>
            </h5>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label" for="business_name"><?php echo $this->lang->line('Business Name') ?></label>
                        <input type="text" class="form-control margin-bottom required" value="<?php echo $business->business_name; ?>"  name="business_name" placeholder="business">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label" for="business_website">Business Website </label>
                        <input type="url" placeholder="Enter Website" class="form-control margin-bottom required" name="business_website" value="<?php echo $business->business_website; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label" for="owner_name">Owner Name</label>
                        <input type="text" placeholder="Enter Owner Name" class="form-control margin-bottom required" value="<?php echo $business->owner_name; ?>" name="owner_name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label" for="owner_email">Owner Email</label>
                        <input type="Email" placeholder="Enter Owner Email" class="form-control margin-bottom required" value="<?php echo $business->owner_email; ?>" name="owner_email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-sm-6 col-form-label" for="owner_mobno">Owner Mobile </label>
                        <input type="text" max="12" placeholder="Enter Owner Mobile" class="form-control margin-bottom required" value="<?php echo $business->owner_mobno; ?>" name="owner_mobno">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="col-sm-6 col-form-label" for="business_addr">Address</label>
                    <textarea placeholder="addresss" class="form-control margin-bottom required" name="business_addr"><?php echo $business->business_addr; ?></textarea>
                </div>
                <div class="col-md-4">
                    <label class="col-sm-6 col-form-label" for="status">Status</label>
                    <select class="form-control margin-bottom required" id="status" name="status">
                        <option value="<?php echo $business->status; ?>" <?php  ?>>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <button type="submit" id="submit" class="btn btn-success mt-3 mb-0"><?php echo $this->lang->line('Update') ?> <?php echo $this->lang->line('Business') ?></button>

        </form>
    </div>

</div>

<script type="text/javascript">
    /*$("#profile_add").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'user/submit_user';
        actionProduct1(actionurl);
    });*/
</script>

<script>

    function actionProduct1(actionurl) {

        $.ajax({

            url: actionurl,
            type: 'POST',
            data: $("#product_action").serialize(),
            dataType: 'json',
            success: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-warning").addClass("alert-success").fadeIn();


                $("html, body").animate({scrollTop: $('html, body').offset().top}, 200);
                $("#product_action").remove();
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);

            }

        });


    }
</script>