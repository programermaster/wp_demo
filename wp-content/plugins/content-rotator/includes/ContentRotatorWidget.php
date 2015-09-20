<?php
/**
 * ContentRotatorWidget extends WP_Widget
 *
 * This implements a WordPress widget designed to randomize chunks
of content.
 */
class ContentRotatorWidget extends WP_Widget
{
    public $name = 'Content Rotator';
    public $description = 'Rotates chunks of content on a periodic basis';

    /* List all controllable options here along with a
    default value.
    The values can be distinct for each instance of the
    widget. */
    public $control_options = array(
        'title' => 'Content Rotator',
        'seconds_shelf_life' => 86400, // 86400 seconds in a day
        );

//!!! Magic Functions
// The constructor.
    function __construct()
    {
        $widget_options = array(
            'classname'  => __CLASS__,
            'description' => $this->description,
        );
        parent::__construct( __CLASS__, $this->name, $widget_options, $this->control_options);
    }
//!!! Static Functions
    static function register_this_widget()
    {
        register_widget(__CLASS__);
    }

    /**
     * Displays content to the front-end.
     *
     * @param array
    $args
    Display arguments
     * @param array
    $instance
    The settings for the particular instance
    of the widget
     * @return none No direct output. This should instead print output
    directly.
     */
    function widget($args, $instance)
    {

        if ( !isset($instance['manufacture_date'])  || time() >= ($instance['manufacture_date'] + $instance['seconds_shelf_life'] ) ) {
            $instance['content'] = ContentRotator::get_random_content($instance);
            $instance['manufacture_date'] = time();

            $all_instances = $this->get_settings();
            $all_instances[$this->number] = $instance;
            //die($this->number."a");
            $this->save_settings($all_instances);
        }
       // print "Hi, I'm a sneezing unicorn.";
        $placeholders = array_merge($args, $instance);

        $tpl = file_get_contents( dirname(dirname(__FILE__)) .'/tpls/widget.tpl');

        print ContentRotator::parse($tpl, $placeholders);
    }

    /**
     * Displays the widget form in the manager, used for editing its
    settings
     *
     * @param
    array
    $instance
    The settings for the particular
    instance of the widget
     * @return none
    No value is returned directly, but form elements
    are printed.
     */
    function form( $instance )
    {
        $placeholders = array();
        foreach ( $this->control_options as $key => $val )
        {
            $placeholders[ $key .'.id' ] = $this->get_field_id( $key);
            $placeholders[ $key .'.name' ] = $this->get_field_name( $key );
// This helps us avoid "Undefined index" notices.
            if ( isset($instance[ $key ] ) )
            {
                $placeholders[ $key .'.value' ] = esc_attr( $instance[ $key ] );
            }
// Use the default (for new instances)
            else
            {
                $placeholders[ $key .'.value' ] = $this->control_options[ $key ];
            }
        }

        $tpl = file_get_contents( dirname(dirname(__FILE__)) .'/tpls/widget_controls.tpl');

        print ContentRotator::parse($tpl, $placeholders);
    }
}