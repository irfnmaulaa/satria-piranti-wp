<?php
/*
 Template Name: Plain Text
*/
?>

<?php get_header(); ?>

<!-- S: Plain Text -->
<div id="plain-content">
    <div class="container custom-content py-10 lg:py-[60px] leading-[1.5] border-b">
        <?php echo get_field('plain_text_description'); ?>
    </div>
</div>
<!-- E: Plain Text -->

<?php get_footer(); ?>
