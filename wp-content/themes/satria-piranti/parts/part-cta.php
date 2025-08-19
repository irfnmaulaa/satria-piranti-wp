<?php
/*
 Template Name: Call to Action
 Template Post Type: part
*/
?>

<?php
$data = get_cta_data();
$section = get_field('cta', $data->ID);  
?>

<div class="flex items-start justify-center gap-2.5">
  <?php for($i = 0; $i < 80; $i++): ?>
    <div class="flex items-start gap-2.5 transform skew-x-[45deg]">
      <div class="h-2 w-11 bg-red-500"></div>
      <div class="h-2 w-11 bg-emerald-400"></div>
    </div>
  <?php endfor; ?>
</div>

<section class="bg-[#1A6250] py-12 md:py-20">
  <div class="container mx-auto px-4">
    <div class="flex flex-col items-center gap-6 md:gap-10 p-4 md:p-8">
      <div class="flex flex-col items-center gap-6 text-center">
        <h4 class="text-slate-200 text-sm md:text-base font-semibold font-figtree">
          <?php echo esc_html($section['title']); ?>
        </h4>
        <h2 class="text-white text-2xl md:text-4xl font-semibold font-plus-jakarta leading-tight">
          <?php echo esc_html($section['subtitle']); ?>
        </h2>
        <p class="text-white text-base md:text-xl font-normal font-plus-jakarta leading-relaxed">
          <?php echo esc_html($section['description']); ?>
        </p>
      </div>

      <?php if ($section['cta_link']): ?> 
      <div class="flex justify-center">
        <a href="<?php echo esc_url($section['cta_link']['link']['url']); ?>" 
           target="<?php echo esc_attr($section['cta_link']['link']['target']); ?>"
           class="inline-flex items-center gap-2 md:gap-3 px-4 md:px-6 py-2 md:py-3 bg-[#F26B4A] rounded-lg text-white text-base md:text-xl font-semibold font-plus-jakarta transition-colors">
          <img src="<?php echo wp_get_attachment_url($section['cta_link']['icon']['ID'] ?? $section['cta_link']['icon']); ?>" 
                 alt="<?php echo esc_attr($section['cta_link']['icon']['alt']); ?>"
                 class="w-full h-full object-contain">
          <?php echo esc_html($section['cta_link']['link']['title']); ?>
        </a>
      </div>
      <?php endif; ?>

      <?php if ($section['other_links']): ?>
      <div class="flex flex-wrap justify-center gap-4 md:gap-10">
        <?php foreach ($section['other_links'] as $link): ?>
        <a href="<?php echo esc_url($link['link']['url']); ?>"
           target="<?php echo esc_attr($link['link']['target']); ?>"
           class="inline-flex items-center gap-2 md:gap-3 px-4 md:px-6 py-2 md:py-3 rounded-lg text-white text-base md:text-xl font-medium font-plus-jakarta hover:bg-white/10 transition-colors">
          <?php if ($link['icon']): ?>
          <span class="w-6 h-6">
            <img src="<?php echo wp_get_attachment_url($link['icon']['ID'] ?? $link['icon']); ?>" 
                 alt="<?php echo esc_attr($link['icon']['alt']); ?>"
                 class="w-full h-full object-contain">
          </span>
          <?php endif; ?>
          <?php echo esc_html($link['link']['title']); ?>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
