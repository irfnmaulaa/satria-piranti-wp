<?php
/*
 Template Name: Warehousing
*/
?>


<?php get_header(); ?>

<?php $section = get_field('hero'); ?>
<?php if($section): ?>
<section class="hero-section bg-slate-50">
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-28 flex flex-col gap-8 md:gap-14">
    <div class="flex flex-col gap-4 md:gap-5">
      <h1 class="text-3xl md:text-5xl font-semibold font-plus-jakarta-sans leading-tight md:leading-[62px]"><?php echo $section['title']; ?></h1>
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
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-24 flex flex-col items-center gap-8 md:gap-14">
    <div class="w-full flex items-center gap-8 md:gap-14">
      <div class="flex-1 flex flex-col gap-4 md:gap-6">
        <h2 class="text-2xl md:text-4xl font-semibold font-plus-jakarta-sans leading-tight md:leading-10"><?php echo $section['title']; ?></h2>
        <p class="text-lg md:text-xl font-normal font-plus-jakarta-sans leading-normal md:leading-7"><?php echo $section['description']; ?></p>
      </div>
    </div>
    
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-14">
      <?php if($gallery_images = $section['images']): ?>
        <?php foreach(array_values($gallery_images) as $index => $image): ?>
          <?php 
            $col = '';
            if($index == 1) {
              $col = 'md:col-[2/4]';
            } elseif($index == 2) {
              $col = 'md:col-[1/3]';
            }
          ?>
          <img 
            class="<?php echo $col; ?> <?php echo $index === 0 ? 'w-full md:w-96 h-64 md:h-96 object-cover' : 'w-full h-64 md:h-96 object-cover'; ?>"  
            src="<?php echo esc_url(wp_get_attachment_url($image['ID'])); ?>" 
            alt="<?php echo esc_attr($image['alt']); ?>" 
          />
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="bg-slate-50">
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-24 flex flex-col items-center gap-8 md:gap-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
      <?php if($features = $section['features']): ?>
        <?php foreach($features as $feature): ?>
          <div class="flex items-start gap-4 md:gap-6">
            <div class="w-12 h-12 md:w-14 md:h-14 bg-slate-200 flex items-center justify-center rounded-lg">
              <?php if($feature['image']): ?>
                <img 
                  class="w-6 h-6 md:w-8 md:h-8 object-contain" 
                  src="<?php echo esc_url(wp_get_attachment_url($feature['image']['ID'] ?? $feature['image'])); ?>" 
                  alt="<?php echo esc_attr($feature['image']['alt']); ?>" 
                />
              <?php endif; ?>
            </div>
            <div class="flex-1 flex flex-col gap-1 md:gap-2">
              <h3 class="text-lg md:text-xl font-medium font-inter leading-tight md:leading-7"><?php echo $feature['title']; ?></h3>
              <p class="text-sm md:text-base font-normal font-plus-jakarta-sans leading-normal text-slate-600"><?php echo $feature['description']; ?></p>
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
