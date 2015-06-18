<?php
    /*
        Plugin Name: Foundation Button Widget
        Plugin URI: http://www.admirecreative.co.uk
        Description: Adds Foundation buttons to widgets
        Version: 1.0
        Author: Tom Hopcraft
        Author URI: http://www.chewx.co.uk
        License: GNU General Public License v2.0
        License URI: http://www.opensource.org/licenses/gpl-license.php
    */

    class Admire_Foundation_Buttons extends WP_Widget {

        /**
         * Sets up the widgets name etc
         */
        public function __construct() {
            parent::__construct(
                'admire_buttons_widget', // Base ID
                __( 'Button', 'admire' ), // Name
                array( 'description' => __( 'Foundation Buttons', 'admire' ), ) // Args
            );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {

            extract( $args );

            $title = $instance['title'];
            $link = $instance['link'];
            $style = ($instance['style'] == 'default') ? 'default' : $instance['style'];
            $size = ($instance['size'] == 'default') ? 'default' : $instance['size'];
            $centered = isset( $instance['centered'] ) ? true : false;

            // outputs the content of the widget
            echo $args['before_widget'];

                if($centered)
                    echo '<div style="text-align: center;">';

                if($title && $link && $style && $size)
                    printf( '<a href="%s" class="button %s %s">%s</a>', $link, $style, $size, $title );

                if($centered)
                    echo '</div>';

            echo $args['after_widget'];

        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {

            // outputs the options form on admin
            $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
            $link  = ! empty( $instance['link'] ) ? $instance['link'] : '';
            ?>
            <p>

                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat" style="width:100%;">
                    <option <?php if ( 'default' == $instance['style'] ) echo 'selected="selected"'; ?>>default</option>
                    <option <?php if ( 'success' == $instance['style'] ) echo 'selected="selected"'; ?>>success</option>
                    <option <?php if ( 'secondary' == $instance['style'] ) echo 'selected="selected"'; ?>>secondary</option>
                    <option <?php if ( 'alert' == $instance['style'] ) echo 'selected="selected"'; ?>>alert</option>
                    <option <?php if ( 'info' == $instance['style'] ) echo 'selected="selected"'; ?>>info</option>
                    <option <?php if ( 'disabled' == $instance['style'] ) echo 'selected="selected"'; ?>>disabled</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size:' ); ?></label>
                <select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat" style="width:100%;">
                    <option <?php if ( 'default' == $instance['size'] ) echo 'selected="selected"'; ?>>default</option>
                    <option <?php if ( 'tiny' == $instance['size'] ) echo 'selected="selected"'; ?>>tiny</option>
                    <option <?php if ( 'small' == $instance['size'] ) echo 'selected="selected"'; ?>>small</option>
                    <option <?php if ( 'disabled' == $instance['size'] ) echo 'selected="selected"'; ?>>disabled</option>
                    <option <?php if ( 'large' == $instance['size'] ) echo 'selected="selected"'; ?>>large</option>
                    <option <?php if ( 'expand' == $instance['size'] ) echo 'selected="selected"'; ?>>expand</option>
                    <option <?php if ( 'round' == $instance['size'] ) echo 'selected="selected"'; ?>>round</option>
                    <option <?php if ( 'radius' == $instance['size'] ) echo 'selected="selected"'; ?>>radius</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'centered' ); ?>"><?php _e( 'Centered:' ); ?></label>
                <input type="checkbox" class="checkbox" <?php checked( $instance['centered'], on ); ?> id="<?php echo $this->get_field_id( 'centered' ); ?>" name="<?php echo $this->get_field_name( 'centered' ); ?>" />
            </p>

            <?php
        }

        /**
         * Processing widget options on save
         *
         * @param array $new_instance The new options
         * @param array $old_instance The previous options
         */
        public function update( $new_instance, $old_instance ) {

            // processes widget options to be saved
            $instance = array();
            $instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['link']     = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'], '/#?' ) : '';
            $instance['style']    = $new_instance['style'];
            $instance['size']     = $new_instance['size'];
            $instance['centered'] = $new_instance['centered'];

            return $instance;

        }

    }

    add_action( 'widgets_init', function() {

        register_widget( 'Admire_Foundation_Buttons' );

    } );