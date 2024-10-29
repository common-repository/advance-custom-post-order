<?php
$acporder_options = get_option('acporder_options');
$acporder_objects = isset($acporder_options['objects']) ? $acporder_options['objects'] : array();
$acporder_tags = isset($acporder_options['tags']) ? $acporder_options['tags'] : array();
?>

<div class="wrap">
    <?php screen_icon('plugins'); ?>
    <h2><?php _e('Advance Custom Post Order Settings', 'acporder'); ?></h2>
    <?php if (isset($_GET['msg'])) : ?>
        <div id="message" class="updated below-h2">
            <?php if ($_GET['msg'] == 'update') : ?>
                <p><?php _e('Advance Custom Post Order Settings Updated.','acporder'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="post">

        <?php if (function_exists('wp_nonce_field')) wp_nonce_field('nonce_acporder'); ?>

        <div id="acporder_select_objects">

            <table class="form-table widefat fixed">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Sort Post Types :', 'acporder') ?></th> 
                        <td>
                            <label><input type="checkbox" id="acporder_allcheck_objects"> <?php _e('Check All Post Types', 'acporder') ?></label><br>
                            <?php
                            $post_types = get_post_types(array(
                                'show_ui' => true,
                                'show_in_menu' => true,
                                    ), 'objects');

                            foreach ($post_types as $post_type) {
                                if ($post_type->name == 'attachment')
                                    continue;
                                ?>
                                <label><input type="checkbox" name="objects[]" value="<?php echo $post_type->name; ?>" <?php
                                    if (isset($acporder_objects) && is_array($acporder_objects)) {
                                        if (in_array($post_type->name, $acporder_objects)) {
                                            echo 'checked="checked"';
                                        }
                                    }
                                    ?>>&nbsp;<?php echo $post_type->label; ?></label><br>
                                    <?php
                                }
                                ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>


        <div id="acporder_select_tags">
            <table class="form-table widefat fixed">
                <tbody>
                    <tr valign="top">
                        <th scope="row"><?php _e('Sort Taxonomies :', 'acporder') ?></th> 
                        <td>
                            <label><input type="checkbox" id="acporder_allcheck_tags"> <?php _e('Check All Taxonomies', 'acporder') ?></label><br>
                            <?php
                            $taxonomies = get_taxonomies(array(
                                'show_ui' => true,
                                    ), 'objects');

                            foreach ($taxonomies as $taxonomy) {
                                if ($taxonomy->name == 'post_format')
                                    continue;
                                ?>
                                <label><input type="checkbox" name="tags[]" value="<?php echo $taxonomy->name; ?>" <?php
                                    if (isset($acporder_tags) && is_array($acporder_tags)) {
                                        if (in_array($taxonomy->name, $acporder_tags)) {
                                            echo 'checked="checked"';
                                        }
                                    }
                                    ?>>&nbsp;<?php echo $taxonomy->label ?></label><br>
                                    <?php
                                }
                                ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div> 
        <p class="submit">
            <input type="submit" class="button-primary" name="acporder_submit" value="<?php _e('Update Order', 'acporder'); ?>">
        </p>
	
    </form>
    
</div>

<script>
    (function ($) {

        $("#acporder_allcheck_objects").on('click', function () {
            var items = $("#acporder_select_objects input");
            if ($(this).is(':checked'))
                $(items).prop('checked', true);
            else
                $(items).prop('checked', false);
        });

        $("#acporder_allcheck_tags").on('click', function () {
            var items = $("#acporder_select_tags input");
            if ($(this).is(':checked'))
                $(items).prop('checked', true);
            else
                $(items).prop('checked', false);
        });

    })(jQuery)
</script>

<?php wp_enqueue_style('acporder-css', ACPORDER_URL . '/assets/css/admin_acporder.css', array(), null); ?>
