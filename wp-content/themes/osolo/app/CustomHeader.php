<?php

class Add_button_of_Sublevel_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='sub-menu'><span class='menu-back'>
        </span>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}
