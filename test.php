<?php
/**
 * Template Name: Test
 */
get_header();
?>
<div>

<?php

    if(isset($wp_query->query_vars['hello'])) {
        $hello = urldecode($wp_query->query_vars['hello']);
        echo $hello;
    }
    
    // $hello = sanitize_text_field(get_query_var('hello'));

    // if($hello == 'abc') {
    //     echo "ABC";
    // } else {
    //     echo "Blah";
    // }
?>

</div>
<?php get_footer(); ?>