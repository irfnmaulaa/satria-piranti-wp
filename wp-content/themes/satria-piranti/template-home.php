<?php
/*
 Template Name: Home
*/
?>

<?php get_header('transparent') ?>

<!-- S: Hero Section -->
<?php
$hero = get_field('hero_with_carousel');
if ($hero && !empty($hero['items'])): 
  $active_index = 0;
?>
<section class="relative h-[500px] md:h-[751px] py-16 md:py-24 flex items-center overflow-hidden">
  <?php foreach(array_values($hero['items']) as $index => $item): ?>
    <div class="absolute inset-0 transition-opacity pointer-events-none duration-700 <?php echo $index === $active_index ? 'opacity-100' : 'opacity-0'; ?>" style="background: url('<?php echo wp_get_attachment_url($item['background_image']['ID'] ?? $item['background_image']); ?>') center/cover no-repeat;"></div>
  <?php endforeach; ?>

  <div class="max-w-[1448px] px-4 md:px-10 mx-auto w-full flex flex-col md:flex-row justify-between relative">
    <div class="w-full md:w-[716px] flex flex-col gap-4 md:gap-5">
      <div class="flex gap-2 md:gap-2.5 skew-x-[45deg]">
        <?php foreach(array_values($hero['items']) as $index => $item): ?>
          <div class="w-8 md:w-11 h-1.5 md:h-2 cursor-pointer transition-colors duration-300 <?php echo $index === $active_index ? 'bg-red-500' : 'bg-slate-200'; ?>" data-index="<?php echo $index; ?>"></div>
        <?php endforeach; ?>
      </div>

      <div class="carousel-content relative">
        <?php foreach(array_values($hero['items']) as $index => $item): ?>
          <div class="flex flex-col gap-8 md:gap-14 transition-all duration-700 absolute w-full <?php echo $index === $active_index ? 'translate-x-0 opacity-100' : 'translate-x-[-100%] opacity-0'; ?>">
            <div class="flex flex-col gap-4 md:gap-5">
              <h1 class="text-white text-2xl md:text-5xl font-semibold font-plus-jakarta leading-tight md:leading-[62px] transition-all duration-700 delay-100 <?php echo $index === $active_index ? 'translate-x-0 opacity-100' : 'translate-x-[100%] opacity-0'; ?>"><?php echo esc_html($item['title']); ?></h1>
              <p class="text-white text-base md:text-xl font-normal font-plus-jakarta leading-normal md:leading-7 transition-all duration-700 delay-200 <?php echo $index === $active_index ? 'translate-x-0 opacity-100' : 'translate-x-[100%] opacity-0'; ?>"><?php echo esc_html($item['description']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="hidden md:flex w-full md:w-[716px] flex-col gap-8 md:gap-14 mt-8 md:mt-0">
      <div class="flex flex-col gap-4 md:gap-5">
        <?php foreach(array_values($hero['links']) as $index => $link): ?>
          <a href="<?php echo esc_url($link['url']); ?>" class="group flex justify-end items-center gap-3 md:gap-5 transition-all duration-300 text-slate-200 hover:!text-white">
            <span class="text-lg md:text-xl font-plus-jakarta leading-normal md:leading-7"><?php echo esc_html($link['title']); ?></span>
            <i class="fas fa-arrow-down opacity-0 group-hover:opacity-100 transition duration-100"></i>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const dots = document.querySelectorAll('[data-index]');
  let currentIndex = 0;
  let interval;
  const slideInterval = 3000; // Change slide every 5 seconds
  
  const startAutoplay = () => {
    interval = setInterval(() => {
      currentIndex = (currentIndex + 1) % dots.length;
      updateCarousel(currentIndex);
    }, slideInterval);
  };

  const stopAutoplay = () => {
    clearInterval(interval);
  };

  // Start autoplay initially
  startAutoplay();

  // Handle dot clicks
  dots.forEach(dot => {
    dot.addEventListener('click', function() {
      const index = parseInt(this.dataset.index);
      currentIndex = index;
      updateCarousel(index);
      
      // Reset autoplay
      stopAutoplay();
      startAutoplay();
    });

    // Pause on hover
    dot.addEventListener('mouseenter', stopAutoplay);
    dot.addEventListener('mouseleave', startAutoplay);
  });
});

function updateCarousel(activeIndex) {
  // Update dots
  document.querySelectorAll('[data-index]').forEach((dot, i) => {
    dot.classList.toggle('bg-red-500', i === activeIndex);
    dot.classList.toggle('bg-slate-200', i !== activeIndex);
  });

  // Update backgrounds with fade effect
  document.querySelectorAll('.absolute.inset-0').forEach((bg, i) => {
    bg.classList.toggle('opacity-0', i !== activeIndex);
    bg.classList.toggle('opacity-100', i === activeIndex);
  });

  // Update content with slide and fade effect
  document.querySelectorAll('.carousel-content > div').forEach((content, i) => {
    if (i === activeIndex) {
      content.classList.remove('translate-x-[-100%]', 'opacity-0');
      content.classList.add('translate-x-0', 'opacity-100');
      
      // Animate new content from left
      const title = content.querySelector('h1');
      const description = content.querySelector('p');
      
      title.classList.remove('translate-x-[100%]', 'opacity-0');
      title.classList.add('translate-x-0', 'opacity-100');
      
      description.classList.remove('translate-x-[100%]', 'opacity-0');
      description.classList.add('translate-x-0', 'opacity-100');
    } else {
      // Fade out old content to right
      content.classList.add('translate-x-[-100%]', 'opacity-0');
      content.classList.remove('translate-x-0', 'opacity-100');
      
      const title = content.querySelector('h1');
      const description = content.querySelector('p');
      
      title.classList.add('translate-x-[100%]', 'opacity-0');
      title.classList.remove('translate-x-0', 'opacity-100');
      
      description.classList.add('translate-x-[100%]', 'opacity-0');
      description.classList.remove('translate-x-0', 'opacity-100');
    }
  });

  // Update right side items
  document.querySelectorAll('.flex.justify-end').forEach((item, i) => {
    item.classList.toggle('items-center', i === activeIndex);
    item.classList.toggle('items-start', i !== activeIndex);
    
    const textSpan = item.querySelector('span');
    textSpan.classList.toggle('text-white', i === activeIndex);
    textSpan.classList.toggle('text-slate-300', i !== activeIndex);
    
    const indicator = item.querySelector('.relative');
    indicator.classList.toggle('opacity-0', i !== activeIndex);
  });
}
</script>
<?php endif; ?>
<!-- E: Hero Section -->

<!-- S: Products Section -->
<?php 
$products = get_field('products_section');
if ($products):
?>
<section class="py-10 md:py-14" id="products-section">
  <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-32">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 mb-8 md:mb-14">
      <div class="flex-1">
        <h2 class="text-2xl md:text-3xl font-bold font-plus-jakarta leading-tight md:leading-9 mb-3 md:mb-6"><?php echo esc_html($products['title']); ?></h2>
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

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-8">
      <?php foreach($products['displayed_products'] as $product): ?>
      <div class="flex flex-col gap-4 md:gap-6 items-center">
        <a href="<?php echo get_permalink($product->ID); ?>" class="h-40 md:h-56 p-3 md:p-5 bg-slate-100 rounded-xl flex items-center w-full">
          <?php if (has_post_thumbnail($product->ID)): ?>
          <img class="w-full" src="<?php echo get_the_post_thumbnail_url($product->ID); ?>" alt="<?php echo esc_attr($product->post_title); ?>" />
          <?php endif; ?>
        </a>
        <a href="<?php echo get_permalink($product->ID); ?>" class="text-center text-sm md:text-base font-medium font-plus-jakarta"><?php echo esc_html($product->post_title); ?></a>
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
<section class="py-10 md:py-14" id="spare-parts-section">
  <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-32">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 mb-8 md:mb-14">
      <div class="flex-1">
        <h2 class="text-2xl md:text-3xl font-bold font-plus-jakarta leading-tight md:leading-9 mb-3 md:mb-6"><?php echo esc_html($spare_parts['title']); ?></h2>
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
      <?php foreach($spare_parts['items'] as $item): ?>
      <div class="flex flex-col gap-4 md:gap-6">
        <?php if (!empty($item['image'])): ?>
        <img class="h-60 md:h-80 rounded-xl object-cover w-full" src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" />
        <?php endif; ?>
        <div class="px-2 md:px-4">
          <h3 class="text-lg md:text-xl font-bold font-plus-jakarta leading-tight md:leading-7 mb-2"><?php echo esc_html($item['title']); ?></h3>
          <?php if (!empty($item['description'])): ?>
          <p class="text-sm md:text-base font-normal font-plus-jakarta"><?php echo esc_html($item['description']); ?></p>
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
<section class="py-10 md:py-14" id="logistics-section">
  <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-32">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 mb-8 md:mb-14">
      <div class="flex-1">
        <h2 class="text-2xl md:text-3xl font-bold font-plus-jakarta leading-tight md:leading-9 mb-3 md:mb-6"><?php echo esc_html($logistics['title']); ?></h2>
        <?php if (!empty($logistics['description'])): ?>
        <p class="text-lg md:text-xl font-normal font-plus-jakarta leading-normal md:leading-7"><?php echo esc_html($logistics['description']); ?></p>
        <?php endif; ?>
      </div>
      <?php if ($link = $logistics['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-slate-200 rounded-[10px]">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
      </a>
      <?php endif; ?>
    </div>

    <?php if (!empty($logistics['image'])): ?>
    <img class="w-full h-64 md:h-96 rounded-xl object-cover mb-8 md:mb-14" src="<?php echo wp_get_attachment_url($logistics['image']['ID'] ?? $logistics['image']); ?>" alt="Logistics Service" />
    <?php endif; ?>

    <?php if (!empty($logistics['items'])): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <?php foreach($logistics['items'] as $feature): ?>
      <div>
        <h3 class="text-lg md:text-xl font-medium font-inter leading-tight md:leading-7 mb-2"><?php echo esc_html($feature['title']); ?></h3>
        <?php if (!empty($feature['description'])): ?>
        <p class="text-sm md:text-base font-normal font-plus-jakarta"><?php echo esc_html($feature['description']); ?></p>
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
<section class="py-16 md:py-24 bg-[#DDFFF7] relative" id="about-section">
  <div class="container mx-auto px-4 md:px-8 lg:px-16 xl:px-32 relative">
    <div class="absolute opacity-20 bg-emerald-400 w-[300px] md:w-[537px] h-10 md:h-16 right-0 bottom-0 translate-y-[calc(100%_+_31px)] skew-x-[45deg]"></div>
    <div class="absolute opacity-20 bg-[#F26B4A] w-[250px] md:w-[500px] h-12 md:h-20 left-[0px] top-[0] translate-x-[-30px] md:translate-x-[-50px] translate-y-[-50%] skew-x-[45deg]"></div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 mb-8 md:mb-14 relative">
      <div class="flex-1">
        <h2 class="text-2xl md:text-3xl font-bold font-plus-jakarta leading-tight md:leading-9"><?php echo esc_html($about['title']); ?></h2>
      </div>
      <?php if ($link = $about['link']): ?>
      <a href="<?php echo $link['url'] ?>" target="<?php echo $link['target'] ?>" class="px-6 py-3 bg-teal-800 rounded-[10px] text-white flex items-center gap-3">
        <span class="text-base font-bold font-plus-jakarta"><?php echo esc_html($link['title']); ?></span>
        <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="image">
      </a>
      <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <?php if (!empty($about['image'])): ?>
      <img class="rounded-xl" src="<?php echo wp_get_attachment_url($about['image']['ID'] ?? $about['image']); ?>" alt="About Us" />
      <?php endif; ?>
      
      <?php if (!empty($about['items'])): ?>
      <div class="flex flex-col justify-center gap-6 md:gap-8">
        <?php foreach($about['items'] as $feature): ?>
        <div class="border-b border-slate-200 pb-6 md:pb-8">
          <h3 class="text-xl md:text-2xl font-medium font-plus-jakarta leading-tight md:leading-loose mb-3 md:mb-4"><?php echo esc_html($feature['title']); ?></h3>
          <?php if (!empty($feature['description'])): ?>
          <p class="text-sm md:text-base font-normal font-plus-jakarta"><?php echo esc_html($feature['description']); ?></p>
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
<section class="py-12 md:py-20 bg-white">
  <div class="container mx-auto px-4 md:px-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0 mb-8 md:mb-16">
      <div class="w-full md:w-[812px]">
        <h2 class="text-2xl md:text-3xl font-bold font-plus-jakarta leading-tight md:leading-9"><?php echo esc_html($blog['title']); ?></h2>
      </div>
      <div class="flex gap-4 md:gap-6">
        <button class="p-3 md:p-4 rounded-xl border border-slate-200 flex items-center blog-prev">
          <span class="w-3 md:w-4 h-3 md:h-4 rotate-180">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
        <button class="p-3 md:p-4 rounded-xl border border-slate-200 flex items-center blog-next">
          <span class="w-3 md:w-4 h-3 md:h-4">
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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-10">
      <?php foreach($posts as $post): ?>
      <article class="flex flex-col gap-4 md:gap-6">
        <?php if (has_post_thumbnail($post->ID)): ?>
        <a href="<?php echo get_permalink($post->ID); ?>" class="w-full h-40 md:h-52">
          <img class="w-full h-full rounded-xl object-cover" 
               src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" 
               alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" />
        </a>
        <?php endif; ?>
        <div class="px-2 md:px-4 pb-2 md:pb-4">
          <a href="<?php echo get_permalink($post->ID); ?>">
            <h3 class="text-lg md:text-xl font-medium font-plus-jakarta line-clamp-2 leading-tight md:leading-7 mb-2 md:mb-4">
            <?php echo esc_html(get_the_title($post->ID)); ?>
          </h3>
          </a>
          <p class="text-sm md:text-base font-normal font-figtree line-clamp-2">
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