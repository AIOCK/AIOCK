<?php
function stm_lms_term_meta_field_color($field_key, $value)
{
	?>
    <div class="stm_lms_image_field">
        <input type="color"
               value="<?php echo sanitize_text_field($value); ?>"
               name="<?php echo esc_attr($field_key) ?>"/>
    </div>

<?php }