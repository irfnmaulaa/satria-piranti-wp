<?php
/*
 Template Name: About Us
*/
?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero'); ?>
<!-- E: Hero -->

<!-- S: About Company -->
<?php get_template_part('sections/section', 'about-company'); ?>
<!-- E: About Company -->

<!-- S: About - Quality Commitment -->
<?php get_template_part('sections/section', 'quality-commitment'); ?>
<!-- E: About - Quality Commitment -->

<!-- S: About - Innovation and Precision -->
<?php get_template_part('sections/section', 'innovation-and-precision'); ?>
<!-- E: About - Innovation and Precision -->

<!-- S: About - Certification and Standard -->
<?php get_template_part('sections/section', 'certification-and-standard'); ?>
<!-- E: About - Certification and Standard -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->

<?php get_footer(); ?>
