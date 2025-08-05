<?php
/*
 Template Name: Home
*/
?>

<?php get_header() ?>

<!-- S: Hero Section -->
<?php
$hero = get_field('hero_with_carousel');
if ($hero): 
?>
<section class="relative h-[643px] py-24 flex items-center">
  <div class="max-w-[1448px] px-10 mx-auto flex justify-between">
    <div class="w-[716px] flex flex-col gap-5">
      <div class="flex gap-2.5 skew-x-[45deg]">
        <div class="w-11 h-2 bg-red-500"></div>
        <div class="w-11 h-2 bg-slate-200"></div>
        <div class="w-11 h-2 bg-slate-200"></div>
      </div>
      <div class="flex flex-col gap-14">
        <div class="flex flex-col gap-5">
          <h1 class="text-white text-5xl font-semibold font-plus-jakarta leading-[62px]"><?php echo esc_html($hero['title']); ?></h1>
          <p class="text-white text-xl font-normal font-plus-jakarta leading-7"><?php echo esc_html($hero['description']); ?></p>
        </div>
      </div>
    </div>
    <?php if (!empty($hero['items'])): ?>
    <div class="w-[716px] flex flex-col gap-14">
      <div class="flex flex-col gap-5">
        <?php foreach($hero['items'] as $key => $item): ?>
        <div class="flex justify-end items-<?php echo $key === 0 ? 'center' : 'start'; ?> gap-5">
          <span class="text-<?php echo $key === 0 ? 'white' : 'slate-300'; ?> text-xl font-medium font-plus-jakarta leading-7"><?php echo esc_html($item['text']); ?></span>
          <div class="w-6 h-6 relative <?php echo $key === 0 ? '' : 'opacity-0'; ?> overflow-hidden">
            <div class="w-3.5 h-6 absolute left-[5px] top-0 border border-white"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
<!-- E: Hero Section -->

<!-- S: Products Section -->
<?php 
$products = get_field('products_section');
if ($products):
?>
<section class="py-14">
  <div class="container mx-auto px-32">
    <div class="flex justify-between items-center mb-14">
      <div class="flex-1">
        <h2 class="text-3xl font-bold font-plus-jakarta leading-9 mb-6"><?php echo esc_html($products['title']); ?></h2>
        <?php if (!empty($products['description'])): ?>
        <p class="text-base font-normal font-plus-jakarta"><?php echo esc_html($products['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php if ($link = $products['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-slate-200 rounded-[10px]">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
      </a>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-5 gap-8">
      <?php foreach($products['displayed_products'] as $product): ?>
      <?php $item = get_field('product_details', $product->ID); ?>
      <div class="flex flex-col gap-6 items-center">
        <a href="<?php echo get_permalink($product->ID); ?>" class="h-56 p-5 bg-slate-100 rounded-xl flex items-center">
          <?php if (!empty($item['image'])): ?>
          <img class="w-full" src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
          <?php endif; ?>
        </a>
        <a href="<?php echo get_permalink($product->ID); ?>" class="text-center text-base font-medium font-plus-jakarta"><?php echo esc_html($item['name']); ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: Products Section -->

<!-- S: Spare Parts Section -->
<?php
$spare_parts = get_field('spare_parts_section');
if ($spare_parts):
?>
<section class="py-14">
  <div class="container mx-auto px-32">
    <div class="flex justify-between items-center mb-14">
      <div class="flex-1">
        <h2 class="text-3xl font-bold font-plus-jakarta leading-9 mb-6"><?php echo esc_html($spare_parts['title']); ?></h2>
        <?php if (!empty($spare_parts['description'])): ?>
        <p class="text-base font-normal font-plus-jakarta"><?php echo esc_html($spare_parts['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php if ($link = $spare_parts['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-slate-200 rounded-[10px]">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
      </a>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-2 gap-8">
      <?php foreach($spare_parts['items'] as $item): ?>
      <div class="flex flex-col gap-6">
        <?php if (!empty($item['image'])): ?>
        <img class="h-80 rounded-xl object-cover" src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
        <?php endif; ?>
        <div class="px-4">
          <h3 class="text-xl font-bold font-plus-jakarta leading-7 mb-2"><?php echo esc_html($item['title']); ?></h3>
          <?php if (!empty($item['description'])): ?>
          <p class="text-base font-normal font-plus-jakarta"><?php echo esc_html($item['description']); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: Spare Parts Section -->

<!-- S: Logistics Section -->
<?php
$logistics = get_field('logistics_section');
if ($logistics && !empty($logistics['title'])):
?>
<section class="py-14">
  <div class="container mx-auto px-32">
    <div class="flex justify-between items-center mb-14">
      <div class="flex-1">
        <h2 class="text-3xl font-bold font-plus-jakarta leading-9 mb-6"><?php echo esc_html($logistics['title']); ?></h2>
        <?php if (!empty($logistics['description'])): ?>
        <p class="text-xl font-normal font-plus-jakarta leading-7"><?php echo esc_html($logistics['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php if ($link = $logistics['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-slate-200 rounded-[10px]">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
      </a>
      <?php endif; ?>
    </div>

    <?php if (!empty($logistics['image'])): ?>
    <img class="w-full h-96 rounded-xl object-cover mb-14" src="<?php echo wp_get_attachment_url($logistics['image']['ID'] ?? $logistics['image']); ?>" alt="Logistics Service" />
    <?php endif; ?>

    <?php if (!empty($logistics['items'])): ?>
    <div class="grid grid-cols-3 gap-8">
      <?php foreach($logistics['items'] as $feature): ?>
      <div>
        <h3 class="text-xl font-medium font-inter leading-7 mb-2"><?php echo esc_html($feature['title']); ?></h3>
        <?php if (!empty($feature['description'])): ?>
        <p class="text-base font-normal font-plus-jakarta"><?php echo esc_html($feature['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
<!-- E: Logistics Section -->

<!-- S: About Section -->
<?php
$about = get_field('about_section');
if ($about && !empty($about['title'])):
?>
<section class="py-24 bg-[#DDFFF7] relative">
  <div class="container mx-auto px-32 relative">
    <div class="absolute opacity-20 bg-emerald-400 w-[537px] h-16 right-0 bottom-0 translate-y-[calc(100%_+_31px)] skew-x-[45deg]"></div>
    <div class="absolute opacity-20 bg-[#F26B4A] w-[500px] h-20 left-[0px] top-[0] translate-x-[-50px] translate-y-[-50%] skew-x-[45deg]"></div>

    <div class="flex justify-between items-center mb-14 relative">
      <div class="flex-1">
        <h2 class="text-3xl font-bold font-plus-jakarta leading-9"><?php echo esc_html($about['title']); ?></h2>
      </div>
      <?php if ($link = $about['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-teal-800 rounded-[10px] text-white flex items-center gap-3">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="image">
      </a>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-2 gap-8">
      <?php if (!empty($about['image'])): ?>
      <img class="rounded-xl" src="<?php echo wp_get_attachment_url($about['image']['ID'] ?? $about['image']); ?>" alt="About Us" />
      <?php endif; ?>
      
      <?php if (!empty($about['items'])): ?>
      <div class="flex flex-col justify-center gap-8">
        <?php foreach($about['items'] as $feature): ?>
        <div class="border-b border-slate-200 pb-8">
          <h3 class="text-2xl font-medium font-plus-jakarta leading-loose mb-4"><?php echo esc_html($feature['title']); ?></h3>
          <?php if (!empty($feature['description'])): ?>
          <p class="text-base font-normal font-plus-jakarta"><?php echo esc_html($feature['description']); ?></p>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: About Section -->

<!-- S: Trusted by Company -->
<?php get_template_part('parts/part-trusted-by-company', null, ['section' => $section]); ?>
<!-- E: Trusted by Company -->

<!-- S: Testimonial --> 
<?php get_template_part('parts/part-testimonial', null, ['section' => $section]); ?>
<!-- E: Testimonial -->

<!-- S: Blog Section -->
<?php
$blog = get_field('blog_section');
if ($blog):
?>
<section class="py-20 bg-white">
  <div class="container mx-auto">
    <div class="flex justify-between items-center mb-16">
      <div class="w-[812px]">
        <h2 class="text-3xl font-bold font-plus-jakarta leading-9"><?php echo esc_html($blog['title']); ?></h2>
      </div>
      <div class="flex gap-6">
        <button class="p-4 rounded-xl border border-slate-200 flex items-center blog-prev">
          <span class="w-4 h-4 rotate-180">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
        <button class="p-4 rounded-xl border border-slate-200 flex items-center blog-next">
          <span class="w-4 h-4">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
      </div>
    </div>

    <?php 
    if($blog['setting'] == 'latest') {
        $posts = get_posts([
          'numberposts' => $blog['count'],
          'orderby' => 'date',
          'order' => 'DESC'
        ]);
    } else {
        $posts = $blog['selected_articles'];
    }
    
    ?>

    <div class="grid grid-cols-4 gap-10">
      <?php foreach($posts as $post): ?>
      <article class="flex flex-col gap-6">
        <?php if (has_post_thumbnail($post->ID)): ?>
        <a href="<?php echo get_permalink($post->ID); ?>" class="w-full h-52">
          <img class="w-full h-full rounded-xl object-cover" 
               src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" 
               alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
        </a>
        <?php endif; ?>
        <div class="px-4 pb-4">
          <a href="<?php echo get_permalink($post->ID); ?>">
            <h3 class="text-xl font-medium font-plus-jakarta leading-7 mb-4">
            <?php echo esc_html(get_the_title($post->ID)); ?>
          </h3>
          </a>
          <p class="text-base font-normal font-figtree">
            <?php echo wp_trim_words(get_the_excerpt($post->ID), 20); ?>
          </p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: Blog Section -->
 
<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer() ?>