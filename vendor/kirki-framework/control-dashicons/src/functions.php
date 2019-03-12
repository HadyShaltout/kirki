<?php
/**
 * Class aliases for backwards-compatibility.
 *
 * @package    Kirki
 * @copyright  Copyright (c) 2019, Ari Stathopoulos (@aristath)
 * @license    https://opensource.org/licenses/MIT
 * @since      4.0
 */

add_action(
    'customize_register',
    function() {
        class_alias( 'Kirki\Control\Dashicons', 'Kirki_Control_Dashicons' );
    }
);
class_alias( 'Kirki\Field\Dashicons', 'Kirki_Field_Dashicons' );
