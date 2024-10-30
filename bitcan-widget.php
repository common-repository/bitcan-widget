<?php
/**
 * Plugin Name: Bitcan Widget
 * Plugin URI: https://bitcan.pl
 * Description: Widget and shortcode of a secure platform for buying bitcoin - bitcan.pl.
 * Version: 1.1
 * Author: Litpay
 * Text Domain: bitcan-widget
 * Domain Path: /languages/
 * Author URI: https://litpay.pl
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class Bitcan_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('bitcan', __('Bitcan Widget', 'bitcan-widget'), ['description' => __('Bitcan.pl currency exchange widget', 'bitcan-widget')] );
    }

    public function widget($arguments, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $arguments['before_widget'];

        if (!empty($title)) {
            echo $arguments['before_title'] . $title . $arguments['after_title'];
        }

        echo sdk($instance);

        echo $arguments['after_widget'];
    }

    public function form($instance)
    {
        $title      = ! empty($instance['title']) ? $instance['title'] : '';
        $partner_id = ! empty($instance['partner_id']) ? $instance['partner_id'] : '';
        $default_amount = ! empty($instance['default_amount']) ? $instance['default_amount'] : 100;
        $header_text = ! empty($instance['header_text']) ? $instance['header_text'] : esc_html__('A fast and secure Bitcoin exchange', 'bitcan-widget');
        $type = ! empty($instance['type']) ? $instance['type'] : 'small';
		$css_path      = ! empty($instance['css_path']) ? $instance['css_path'] : '' ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'bitcan-widget'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            <small><?php _e( 'The widget panel title.', 'bitcan-widget' ); ?></small>
    	</p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('partner_id')); ?>">
                <?php esc_attr_e('Partner ID:', 'bitcan-widget'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('partner_id')); ?>" name="<?php echo esc_attr($this->get_field_name('partner_id')); ?>" type="text" value="<?php echo esc_attr($partner_id); ?>">
            <small><?php _e( 'Affiliate Code.', 'bitcan-widget' ); ?></small>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('header_text')); ?>">
                <?php esc_attr_e('Headline text:', 'bitcan-widget'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('header_text')); ?>" name="<?php echo esc_attr($this->get_field_name('header_text')); ?>" type="text" value="<?php echo esc_attr($header_text); ?>">
            <small><?php _e('Header text placed inside the widget.', 'bitcan-widget'); ?></small>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('default_amount')); ?>">
                <?php esc_attr_e('Default amount:', 'bitcan-widget'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('default_amount')); ?>" name="<?php echo esc_attr($this->get_field_name('default_amount')); ?>" type="number" value="<?php echo esc_attr($default_amount); ?>" min="50" max="1000" >
            <small><?php _e('Default exchange amount. It cannot be less than 50 or greater than 1000.', 'bitcan-widget'); ?></small>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>">
                <?php esc_attr_e('Size:', 'bitcan-widget'); ?>
            </label>

            <select class='widefat' id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" type="text">
                <option value='small'<?php echo ($type=='small')?'selected':''; ?>>
                    <?php esc_attr_e('Small', 'bitcan-widget'); ?>
                </option>
                <option value='big'<?php echo ($type=='big')?'selected':''; ?>>
                    <?php esc_attr_e('Big:', 'bitcan-widget'); ?>
                </option>
            </select>
            <small><?php _e('The change will only be visible if the place where the widget is placed is large enough. Otherwise it doesnt matter what is chosen here.', 'bitcan-widget'); ?></small>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('css_path')); ?>">
                <?php esc_attr_e('Own styles:', 'bitcan-widget'); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('css_path')); ?>" name="<?php echo esc_attr($this->get_field_name('css_path')); ?>" type="text" value="<?php echo esc_attr($css_path); ?>" >
            <small><?php _e('Relative or absolute style sheet address for the given widget.', 'bitcan-widget'); ?></small>
        </p>

    	<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = [];

        $instance['title'] = $new_instance['title'];
        $instance['partner_id'] = $new_instance['partner_id'];
        $instance['default_amount'] = $new_instance['default_amount'];
        $instance['header_text'] = $new_instance['header_text'];
        $instance['type'] = $new_instance['type'];
		$instance['css_path'] = $new_instance['css_path'];

        return $instance;
    }
}


function sdk($instance) {
    $random = array();

    for ($i = 0; $i < 9; $i++) {
        $random[$i] = rand(0, 9);
    }

    $id = join($random);

    if ($instance['css_path'] && filter_var($instance['css_path'], FILTER_VALIDATE_URL) === FALSE) {
        $instance['css_path'] = get_site_url(null, $instance['css_path']);
    }

    $instance['css_path'] = urlencode($instance['css_path']);

    wp_enqueue_script('bitcan-purchase-box-sdk-'.$id, 'https://bitcan.pl/purchase-box/v2/sdk.js?language='.get_locale().'&partner_id='.$instance['partner_id'].'&default_amount='.$instance['default_amount'].'&header_text='.$instance['header_text'].'&type='.$instance['type'].'&css_path='.$instance['css_path'].'&div_id='.$id, array(), '1', true);

    return '<div id="bitcan-widget'.$id.'">';
}

function bitcan_shortcode($arguments)
{
    $instance = shortcode_atts([
        'partner_id' => '',
        'default_amount' => 100,
        'header_text' => __('A fast and secure Bitcoin exchange', 'bitcan-widget'),
        'type' => 'small',
		'css_path' => ''
    ], $arguments);

    echo sdk($instance);
}

function bitcan_widget_load_text_domain() {
    load_plugin_textdomain('bitcan-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function wpb_load_widget()
{
    register_widget('Bitcan_Widget');
}

add_action('widgets_init', 'wpb_load_widget');
add_action('plugins_loaded', 'bitcan_widget_load_text_domain');
add_shortcode('bitcan-widget', 'bitcan_shortcode');

?>
