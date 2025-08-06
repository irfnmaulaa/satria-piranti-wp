<?php
/*
 Template Name: Car Rental
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

<section class="car-types-section">
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-24 flex flex-col items-center gap-8 md:gap-14">
    <div class="flex items-center gap-4 md:gap-8 w-full overflow-x-auto pb-2" id="category-filters">
      <button class="p-3 md:p-4 bg-[#F26B4A] rounded-full text-white text-sm md:text-base font-semibold font-plus-jakarta-sans category-filter active whitespace-nowrap" data-category="all">
        Semua
      </button>
      <?php
        $categories = get_terms([
          'taxonomy' => 'car-category',
          'hide_empty' => false
        ]);
        
        if(!empty($categories) && !is_wp_error($categories)):
          foreach($categories as $category):
      ?>
        <button class="p-3 md:p-4 bg-slate-100 rounded-full text-black text-sm md:text-base font-normal font-plus-jakarta-sans category-filter whitespace-nowrap" data-category="<?php echo $category->slug; ?>">
          <?php echo $category->name; ?>
        </button>
      <?php
          endforeach;
        endif;
      ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8" id="car-grid">
      <?php foreach(get_car_rentals() as $car): ?>
        <?php 
          if($item = get_field('car_rental_item', $car->ID)):
          $car_categories = get_the_terms($car->ID, 'car-category');
          $category_slugs = [];
          if($car_categories) {
            foreach($car_categories as $cat) {
              $category_slugs[] = $cat->slug;
            }
          }
        ?>
        <div class="bg-white flex flex-col gap-4 md:gap-6 car-item p-4 md:p-0" data-categories='<?php echo json_encode($category_slugs); ?>'>
          <img class="w-full h-56 md:h-72 rounded-xl object-cover" src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" alt="image" />
          <div class="flex flex-col gap-2 md:gap-4">
            <div class="flex flex-col">
              <div class="text-black text-xs md:text-sm font-semibold font-plus-jakarta-sans"><?php echo get_the_terms($car->ID, 'car-brand')[0]->name; ?></div>
              <div class="text-black text-xl md:text-2xl font-semibold font-plus-jakarta-sans"><?php echo $car->post_title; ?></div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
      <div id="no-cars-message" class="hidden col-span-4 text-center py-8">
        <p class="text-gray-500 text-lg font-plus-jakarta-sans">No available car in this type</p>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const filters = document.querySelectorAll('.category-filter');
  const carItems = document.querySelectorAll('.car-item');
  const noCarsMessage = document.getElementById('no-cars-message');

  filters.forEach(filter => {
    filter.addEventListener('click', function() {
      // Remove active class from all filters
      filters.forEach(f => {
        f.classList.remove('active')
        f.classList.remove('bg-[#F26B4A]', 'text-white', 'font-semibold');
        f.classList.add('bg-slate-100', 'text-black', 'font-normal'); 
      }); 
      
      // Add active class to clicked filter
      this.classList.add('active');
      this.classList.remove('bg-slate-100', 'text-black', 'font-normal');
      this.classList.add('bg-[#F26B4A]', 'text-white', 'font-semibold');

      const selectedCategory = this.dataset.category;
      let visibleItems = 0;

      carItems.forEach(item => {
        const categories = JSON.parse(item.dataset.categories);
        
        if (selectedCategory === 'all' || categories.includes(selectedCategory)) {
          item.style.display = 'flex';
          visibleItems++;
        } else {
          item.style.display = 'none';
        }
      });

      // Show/hide no cars message
      if (visibleItems === 0) {
        noCarsMessage.classList.remove('hidden');
      } else {
        noCarsMessage.classList.add('hidden');
      }
    });
  });
});
</script>

<section class="services-section">
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-24 flex flex-col items-center gap-8 md:gap-14">
    <div class="text-center">
      <h2 class="text-2xl md:text-4xl font-semibold font-plus-jakarta-sans leading-tight md:leading-10 mb-4 md:mb-6"><?php echo get_field('title'); ?></h2>
      <p class="text-lg md:text-xl font-normal font-plus-jakarta-sans leading-normal md:leading-7"><?php echo get_field('subtitle'); ?></p>
    </div>

    <?php if($services = get_field('items')): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach($services as $service): ?>
      <div class="flex flex-col items-center gap-4 md:gap-6">
        <div class="w-24 h-24 md:w-32 md:h-32 bg-slate-50 flex justify-center items-center">
          <img src="<?php echo wp_get_attachment_url($service['image']['ID'] ?? $service['image']); ?>" alt="<?php echo $service['title']; ?>" class="w-12 h-12 md:w-14 md:h-14" />
        </div>
        <div class="text-center">
          <h3 class="text-lg md:text-xl font-medium font-inter mb-2 md:mb-4"><?php echo $service['title']; ?></h3>
          <p class="text-sm md:text-base font-normal font-plus-jakarta-sans"><?php echo $service['description']; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- S: Trusted -->
<?php get_template_part('parts/part-trusted-by-company', null, ['section' => $section]); ?>
<!-- E: Trusted -->

<!-- S: Testimonials -->
<?php get_template_part('parts/part-testimonial', null, ['section' => $section]); ?>
<!-- E: Testimonials -->

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer(); ?>