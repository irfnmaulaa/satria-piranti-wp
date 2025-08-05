<?php
/*
 Template Name: Warehousing
*/
?>


<?php get_header(); ?>

<?php $section = get_field('hero'); ?>
<?php if($section): ?>
<section class="hero-section bg-slate-50">
  <div class="container mx-auto px-8 py-28 flex flex-col gap-14">
    <div class="flex flex-col gap-5">
      <h1 class="text-5xl font-semibold font-plus-jakarta-sans leading-[62px]"><?php echo $section['title']; ?></h1>
      <p class="text-base font-normal font-plus-jakarta-sans leading-normal"><?php echo $section['subtitle']; ?></p>
    </div>
    <?php if($link = $section['call_to_action']): ?>
    <div>
        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="inline-flex items-center gap-3 px-6 py-3 bg-[#F26B4A] rounded-lg">
            <span class="text-white text-base font-bold font-plus-jakarta-sans"><?php echo $link['title']; ?></span>
            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="arrow right">    
        </a>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php $section = get_field('warehouse'); ?>
<?php if($section): ?>
<section class="bg-white">
  <div class="container mx-auto px-8 py-24 flex flex-col items-center gap-14">
    <div class="w-full flex items-center gap-14">
      <div class="flex-1 flex flex-col gap-6">
        <h2 class="text-4xl font-semibold font-plus-jakarta-sans leading-10"><?php echo $section['title']; ?></h2>
        <p class="text-xl font-normal font-plus-jakarta-sans leading-7"><?php echo $section['description']; ?></p>
      </div>
    </div>
    
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-14">
      <?php if($gallery_images = $section['images']): ?>
        <?php foreach($gallery_images as $index => $image): ?>
          <img 
            class="<?php echo $index === 0 ? 'w-96 h-96 object-cover' : 'w-full h-96 object-cover'; ?>" 
            src="<?php echo esc_url(wp_get_attachment_url($image['ID'])); ?>" 
            alt="<?php echo esc_attr($image['alt']); ?>"
          />
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="bg-slate-50">
  <div class="container mx-auto px-8 py-24 flex flex-col items-center gap-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
      <?php if($features = $section['features']): ?>
        <?php foreach($features as $feature): ?>
          <div class="flex items-start gap-6">
            <div class="w-14 h-14 bg-slate-200 flex items-center justify-center rounded-lg">
              <?php if($feature['image']): ?>
                <img 
                  class="w-8 h-8 object-contain" 
                  src="<?php echo esc_url(wp_get_attachment_url($feature['image']['ID'] ?? $feature['image'])); ?>" 
                  alt="<?php echo esc_attr($feature['image']['alt']); ?>" 
                />
              <?php endif; ?>
            </div>
            <div class="flex-1 flex flex-col gap-2">
              <h3 class="text-xl font-medium font-inter leading-7"><?php echo $feature['title']; ?></h3>
              <p class="text-base font-normal font-plus-jakarta-sans leading-normal text-slate-600"><?php echo $feature['description']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer(); ?>
