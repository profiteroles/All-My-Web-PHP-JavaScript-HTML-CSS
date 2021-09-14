<div class="alert alert-success" id="success_message" style="display: none"></div>
<div class="alert alert-success" id="success_message" style="display: none"></div>
<form id="enquiry">
    <h2>Reach us out</h2>
    <div class="form-group row">
        <div class="col-lg-6 mb-3">
            <input type="text" name="fname" placeholder="Full Name" class="form-control" required>
        </div>
        <div class="col-lg-6 mb-3">
            <select name="subject" id="subject" class="form-select">
                <option value="null" selected disabled>Please Select Subject</option>
                <option value="price">Price</option>
                <option value="career">Career</option>
                <option value="book">Book</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6 mb-3">
            <input type="email" name="email" placeholder="Email Address" class="form-control " required>
        </div>
        <div class="col-lg-6 mb-3">
            <input type="tel" name="phone" placeholder="Phone Number" class="form-control" required>
        </div>
    </div>

    <div class="form-group mb-3">
        <textarea name="enquiry" class="form-control" cols="30" rows="10" placeholder="Your Enquiry"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success align-self-lg-end">Send</button>
    </div>
</form>

<script>
    jQuery('#enquiry').submit(function (event) {
        event.preventDefault();
        var endPoint = '<?php echo admin_url('admin-ajax.php'); ?>';
        var form = jQuery('#enquiry').serialize();
        var formData = new FormData;

        formData.append('action', 'enquiry');
        formData.append('nonce',<?php  echo wp_create_nonce('ajax-nonce'); ?>);
        formData.append('enquiry', form);

        jQuery.ajax(endPoint, {
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                jQuery('#enquiry').fadeOut(200);
                jQuery('#success_message').text('We\'ve received your enquiry.').show();
                jQuery('#enquiry').trigger('reset');
            },
            error: function (err) {
                alert(err.responseJSON.data);
            }
        })
    })
</script>