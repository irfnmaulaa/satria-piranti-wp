<?php
/*
 Template Name: Contact Us
*/
?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php if($section = get_field('hero')): ?> 
<section class="px-[124px] py-[120px] bg-white">
    <div class="container">
        <h1 class="text-[48px] leading-[62px] font-semibold">
            <?php echo $section['title']; ?>
        </h1>
    </div>
</section> 
<?php endif; ?>
<!-- E: Hero -->

<?php if($section = get_field('contact')): ?>

<?php if($head_quarter = $section['head_quarter']): ?>
<section class="relative bg-slate-50 px-32 py-24 ">
  <div class="container">
    <div class="flex flex-col items-center gap-14 overflow-hidden">
      <div class="w-full flex flex-col items-start gap-8">
        <div class="w-full flex items-center gap-8">
          <div class="flex-1">
            <?php echo $head_quarter['map_embed']; ?>
          </div>
          
          <div class="flex-1 flex flex-col items-start gap-8">
            <h2 class="w-full text-4xl font-semibold font-plus-jakarta leading-10 text-black">
              <?php echo $head_quarter['title']; ?>
            </h2>
            <p class="w-full text-xl font-normal font-plus-jakarta leading-7 text-black">
              <?php echo $head_quarter['address']; ?>
            </p>
            <?php if($link = $head_quarter['link']): ?>
            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="w-full px-6 py-3 bg-[#1A6250] rounded-[10px] flex justify-center items-center gap-3">
              <span class="text-base font-bold font-plus-jakarta text-white">
                <?php echo $link['title']; ?>
              </span>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow-right.svg" alt="image">
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>


<?php if($opens = $section['opens']): ?>
<section class="border-b border-slate-200">
  <div class="container">
    <div class="py-10 flex flex-col items-center">
      <div class="p-8 flex flex-col items-center gap-10">
        <div class="w-full flex justify-center items-start gap-14">
            <?php foreach($opens as $open): ?>
                <div class="flex flex-col items-center gap-2.5">
                    <p class="text-xl font-normal font-plus-jakarta leading-7 text-black text-center">
                    <?php echo $open['day']; ?>
                    </p>
                    <p class="text-2xl font-semibold font-plus-jakarta leading-loose text-black text-center">
                    <?php echo $open['clock']; ?>
                    </p>
                </div>
            <?php endforeach; ?> 
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php endif; ?>

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->


<?php get_footer(); ?>
