<?php
/*
 Template Name: Testimonial
 Template Post Type: part
*/

$data = get_testimonial_data();
$testimonial = get_field('testimonial', $data->ID); 
$title = $testimonial['title'];
$items = $testimonial['items'];
?>

<section class="bg-white border-b border-slate-200">
  <div class="container mx-auto py-12 md:py-24 px-4 md:px-0">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0 mb-6 md:mb-10">
      <div>
        <h2 class="text-2xl md:text-4xl font-semibold font-plus-jakarta-sans leading-8 md:leading-10 text-black text-center md:text-left">
          <?php echo esc_html($title); ?>
        </h2>
      </div>
      <div class="flex gap-4 md:gap-6">
        <button class="p-3 md:p-4 rounded-xl border border-slate-200 flex items-center testimonial-prev">
          <span class="w-4 h-4 rotate-180">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
        <button class="p-3 md:p-4 rounded-xl border border-slate-200 flex items-center testimonial-next">
          <span class="w-4 h-4">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
      </div>
    </div>

    <div class="testimonial-carousel -ms-3 w-[calc(100%_+_24px)]">
      <?php if ($items) : ?>
        <?php foreach ($items as $item) : ?>
        <?php if(!empty($item['user']['full_name'])): ?>
          <div class="px-3">
            <div class="rounded-[20px] border border-white flex flex-col gap-6">
              <div class="flex items-start gap-6">
                <img 
                  class="w-14 h-14 rounded-full object-cover" 
                  src="<?php echo wp_get_attachment_url($item['user']['image']); ?>" 
                  alt="<?php echo esc_attr($item['user']['full_name']); ?>"
                />
                <div class="flex flex-col gap-0.5">
                  <h3 class="text-lg md:text-xl font-medium font-inter leading-6 md:leading-7 text-black">
                    <?php echo esc_html($item['user']['full_name']); ?>
                  </h3>
                  <p class="text-sm md:text-base font-normal font-inter text-black">
                    <?php echo esc_html($item['user']['company']); ?>
                  </p>
                </div>
              </div>
              <p class="text-base md:text-lg font-normal font-inter leading-6 md:leading-7 text-black">
                <?php echo esc_html($item['message']); ?>
              </p>
            </div>
          </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <script>
      function updateTestimonial() {
        const testimonialCarousel = new Siema({
          selector: '.testimonial-carousel',
          perPage: {  
            0: 1,      // For mobile: 1 item per page
            768: 2,    // For tablets: 2 items per page
            1024: 3    // For desktop: 3 items per page
          },
          loop: true,
          duration: 200,
        });

        document.querySelector('.testimonial-prev').addEventListener('click', () => testimonialCarousel.prev());
        document.querySelector('.testimonial-next').addEventListener('click', () => testimonialCarousel.next());
      }

      document.addEventListener('DOMContentLoaded', updateTestimonial);
    </script>
  </div>
</section>
