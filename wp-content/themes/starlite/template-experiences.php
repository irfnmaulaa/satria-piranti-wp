<?php
/*
 Template Name: Experiences
*/
?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero'); ?>
<!-- E: Hero -->

<!-- S: Our Projects -->
<?php get_template_part('sections/section', 'our-projects'); ?>
<!-- E: Our Projects -->

<div class="container">
    <div class="w-full h-[1px] bg-[#C0C0C0]"></div>
</div>

<!-- S: Our Clients -->
<?php get_template_part('sections/section', 'our-clients'); ?>
<!-- E: Our Clients -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->

<?php get_footer(); ?>
