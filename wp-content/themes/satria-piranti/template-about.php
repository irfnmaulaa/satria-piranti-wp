<?php
/*
 Template Name: About Us
*/
?>

<?php get_header() ?>

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

<!-- S: Short History and Value -->
<?php if($section = get_field(selector: 'short_history')): ?> 
<section class="relative bg-cover bg-center" style="background-image: url('<?php echo wp_get_attachment_url($section['media']['ID']); ?>');">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/80 to-black/80"></div>
    <div class="relative px-[124px] py-[120px]">
        <div class="container">
            <div class="grid grid-cols-2">
                <div class="col-span-1"></div>
                <div class="col-span-1">
                    <h2 class="text-4xl font-semibold text-white mb-6">
                        <?php echo $section['title']; ?>
                    </h2>
                    <p class="text-xl text-white whitespace-pre-line">
                        <?php echo $section['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- E: Short History and Value -->

<!-- S: Focus & Goals -->
<?php if($section = get_field(selector: 'focus_and_goals')): ?> 
<section class="px-[124px] py-[120px] bg-white">
    <div class="container text-center">
        <h2 class="text-4xl font-semibold text-black mb-4">
            <?php echo $section['title']; ?>
        </h2>
        <p class="text-xl font-normal text-black mb-16">
            <?php echo $section['description']; ?>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if($section['items']): foreach($section['items'] as $item): ?>
            <div class="flex flex-col items-center">
                <img 
                    src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" 
                    alt="<?php echo $item['title']; ?>"
                    class="w-[128px] h-[128px] object-cover mb-6"
                >
                <h3 class="text-lg font-medium text-black mb-4">
                    <?php echo $item['title']; ?>
                </h3>
                <p class="text-base font-normal text-black">
                    <?php echo $item['description']; ?>
                </p>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- E: Focus & Goals --> 

<!-- S: Our Advantages -->
<?php if($section = get_field('advantages')): ?>
<section class="px-32 py-24 bg-slate-50">
  <div class="container">
    <div class="flex flex-col items-center gap-14 w-full">
      <div class="flex items-center gap-14 w-full">
        <div class="flex flex-col items-start gap-6 flex-1">
          <h2 class="w-full font-semibold text-center text-black text-4xl leading-10">
            <?php echo $section['title']; ?>
          </h2>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-10 w-full">
        <?php if($section['items']): foreach($section['items'] as $item): ?>
        <div class="flex items-start gap-6">
          <div class="w-14 h-14">
            <img 
              src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>"
              alt="<?php echo $item['title']; ?>"
              class="w-full h-full object-cover"
            >
          </div>
          <div class="flex flex-col gap-2">
            <h3 class="text-black font-medium text-xl leading-7"><?php echo $item['title']; ?></h3>
            <p class="text-black text-base"><?php echo $item['description']; ?></p>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: Our Advantages -->

<!-- S: Trusted by Company -->
<?php get_template_part('parts/part-trusted-by-company', null, ['section' => $section]); ?>
<!-- E: Trusted by Company -->

<!-- S: Testimonial --> 
<?php get_template_part('parts/part-testimonial', null, ['section' => $section]); ?>
<!-- E: Testimonial -->

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer() ?>
