<?php
/*
 Template Name: Error Page
*/

get_header();
?>

<main id="main" class="site-main">
  <section class="error-page bg-slate-50">
    <div class="container mx-auto px-8 py-28 flex flex-col gap-14">
      <div class="flex flex-col gap-5">
        <h1 class="text-5xl font-semibold font-plus-jakarta-sans leading-[62px]"><?php the_title(); ?></h1>
        <div class="text-base font-normal font-plus-jakarta-sans leading-normal">
          <?php the_content(); ?>
        </div>
      </div>
      <div>
        <a href="<?php echo get_front_page_url(); ?>" class="inline-flex items-center gap-3 px-6 py-3 bg-[#F26B4A] rounded-lg">
          <span class="text-white text-base font-bold font-plus-jakarta-sans">Back to Home</span>
          <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="arrow right">    
        </a>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();