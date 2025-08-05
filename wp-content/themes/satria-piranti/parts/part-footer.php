<?php
/*
 Template Name: Footer
 Template Post Type: part
*/
?>

<?php if($data = get_footer_data()): ?>
<?php if($section = get_field('footer', $data->ID)): ?>

<section class="footer-section relative w-full">
  <div class="container mx-auto">
    <div class="py-14 flex flex-col gap-10">
      <div class="grid grid-cols-[440px,1fr,1fr,1fr] gap-8">
        <div class="col-span-1">
          <div class="w-40 h-14 relative overflow-hidden">
            <?php if($logo = $section['logo']): ?>
              <img src="<?php echo wp_get_attachment_url($logo['ID'] ?? $logo); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="w-full h-full object-contain">
            <?php else: ?>
              <!-- Fallback logo elements -->
              <div class="w-14 h-2 absolute left-0 top-[38.72px] bg-emerald-400"></div>
              <div class="w-2 h-9 absolute left-0 top-0 bg-emerald-400"></div>
              <!-- ... other logo elements ... -->
            <?php endif; ?>
          </div>
          <div class="mt-4 text-black text-lg font-normal font-figtree leading-7">
            <?php echo $section['about']; ?>
          </div>
        </div>
        
        <?php if($link_items = $section['link_items']): ?> 
            <?php foreach($link_items as $link_item): ?>
                <div class="col-span-1">
                    <h3 class="text-black text-xl font-semibold font-plus-jakarta-sans leading-7 mb-4">
                        <?php echo $link_item['title']; ?>
                    </h3>
                    <div class="flex flex-col">
                        <?php if($links = $link_item['links']): ?>
                        <?php foreach($links as $link): ?>
                            <?php if($link): ?>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="text-black text-lg font-normal font-inter leading-7 mb-2">
                                    <?php echo $link['title']; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?> 
      </div>
    </div>

    <div class="py-5">
      <div class="text-center text-black text-lg font-medium font-figtree leading-7">
        <?php echo $section['copyright']; ?>
      </div>
    </div>
  </div>

  <?php if($section['whatsapp_floating_button']): ?>
    <a href="<?php echo $section['whatsapp_floating_button']['link']['url']; ?>" target="<?php echo $section['whatsapp_floating_button']['link']['target']; ?>" class="scroll-to-top fixed bottom-8 right-8 w-16 h-16 bg-teal-800 rounded-full flex items-center justify-center">
      <img src="<?php echo wp_get_attachment_url($section['whatsapp_floating_button']['icon']['ID'] ?? $section['whatsapp_floating_button']['icon']); ?>" alt="" class="w-8 h-8">
    </a>
  <?php endif; ?>
</section>
<?php endif; ?>
<?php endif; ?>
