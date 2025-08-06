<?php
/**
 * The template for displaying single product posts
 *
 * @package Satria-Piranti
 */
get_header();
?>
<?php 
$details = get_field('product_details'); 
$specifications = explode("\n", $details['spesification']);
?>
<section class="product-detail"></section>
  <div class="container mx-auto px-8 py-14 flex justify-center items-start gap-14">
    <div class="flex-1 h-[602px] p-5 bg-slate-100 rounded-xl flex items-center gap-2.5 overflow-hidden">
      <?php if (has_post_thumbnail()) : ?>
        <img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
      <?php else : ?>
        <img class="w-full h-full object-cover" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="Product Image" />
      <?php endif; ?>
    </div>
    <div class="flex-1 flex flex-col gap-10">
      <?php 
        // Get all product categories for current post
        $categories = get_the_terms(get_the_ID(), 'product-category');
        $category_name = '';

      
        if ($categories) {
          foreach ($categories as $category) {
            // Get parent term
            $parent = get_term($category->parent, 'product-category');
            
            // Check if parent slug is 'capital'
            if ($parent && $parent->slug === 'category') {
              $category_name = $category->name;
              break;
            }
          }
        }
      ?>
      <span class="text-slate-500 text-sm font-semibold font-plus-jakarta leading-tight"><?php echo esc_html($category_name); ?></span>
      <h1 class="text-black text-3xl font-semibold font-plus-jakarta leading-9"><?php echo get_the_title(); ?></h1>
      <div class="flex gap-4">
        <div class="flex-1 flex flex-col gap-2">
          <span class="text-slate-500 text-sm font-semibold font-plus-jakarta leading-tight">Kapasitas</span>
          <span class="text-black text-xl font-semibold font-plus-jakarta leading-7"><?php echo esc_html($details['capacity']); ?></span>
        </div>
        <div class="flex-1 flex flex-col gap-2">
          <span class="text-slate-500 text-sm font-semibold font-plus-jakarta leading-tight">Load Center</span>
          <span class="text-black text-xl font-semibold font-plus-jakarta leading-7"><?php echo esc_html($details['load_center']); ?></span>
        </div>
      </div>
      <div class="text-black text-base font-normal font-plus-jakarta leading-normal">
        <?php echo wp_kses_post($details['description']); ?>
      </div>
      <div class="flex gap-5">
        <?php
        // Get product options assigned to current product
        $product_options = wp_get_post_terms(get_the_ID(), 'product-option', [
            'hide_empty' => false
        ]); 

        // Function to find and render option by slug
        function render_product_option($options, $slug) {
            foreach ($options as $option) {
                if ($option->slug === $slug) {
                    // Get ACF fields for this term
                    $option_fields = get_field('product_option', $option);
                    ?>
                    <div class="flex-1 p-5 rounded-xl border border-slate-200 flex flex-col gap-5">
                        <div class="flex flex-col gap-5">
                            <h3 class="text-black text-base font-semibold font-plus-jakarta">
                                <?php echo esc_html($option_fields['title'] ?? ''); ?>
                            </h3>
                            <p class="text-black text-base font-normal font-plus-jakarta">
                                <?php echo esc_html($option_fields['description'] ?? ''); ?>
                            </p>
                        </div>
                        <?php if ($link = $option_fields['link']): ?>
                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="w-full px-6 py-3 bg-[#1A6250] rounded-lg flex justify-center items-center gap-3">
                            <span class="text-white text-base font-bold font-plus-jakarta">
                                <?php echo $link['title'] ?>
                            </span>
                            <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="arrow">
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php
                    break;
                }
            }
        }

        foreach ($product_options as $product_option) {
            render_product_option($product_options, $product_option->slug);
        }  
        ?>
      </div>
      <?php if(!empty($specifications)): ?>
      <div class="flex flex-col">
        <h3 class="text-black text-xl font-semibold font-plus-jakarta leading-7 pb-2.5">Spesifikasi</h3>
        <div class="divide-y divide-slate-200">
          <?php foreach($specifications as $spec): 
            $spec_parts = explode(':', $spec);
            if(count($spec_parts) === 2):
          ?>
          <div class="py-2.5 flex justify-between">
            <span class="text-black text-base font-normal font-plus-jakarta"><?php echo esc_html(trim($spec_parts[0])); ?></span>
            <span class="text-black text-base font-normal font-plus-jakarta"><?php echo esc_html(trim($spec_parts[1])); ?></span>
          </div>
          <?php endif; endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
// Get current product category
$current_categories = get_the_terms(get_the_ID(), 'product-category');
$current_category_id = $current_categories ? $current_categories[0]->term_id : 0;

// Query related products
$args = array(
  'post_type' => 'product',
  'posts_per_page' => 8,
  'post__not_in' => array(get_the_ID()),
  'tax_query' => array(
    array(
      'taxonomy' => 'product-category',
      'field' => 'term_id',
      'terms' => $current_category_id
    )
  )
);

$related_products = new WP_Query($args);

// Only display section if there are related products
if($related_products->have_posts()) :
?>
<section class="related-products">
  <div class="container mx-auto px-8 py-24 flex flex-col gap-14">
    <div class="flex items-center gap-14">
      <h2 class="flex-1 text-black text-4xl font-semibold font-plus-jakarta leading-10">Produk Lainnya</h2>
      <div class="flex gap-6">
        <button class="p-4 rounded-xl border border-slate-200 flex items-center related-products-prev">
          <span class="w-4 h-4 rotate-180">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
        <button class="p-4 rounded-xl border border-slate-200 flex items-center related-products-next">
          <span class="w-4 h-4">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
      </div>
    </div>
    <div class="related-products-slider" style="margin-right: -32px;">
      <?php
        while($related_products->have_posts()) : $related_products->the_post();
          $details = get_field('product_details');
          if (!empty($details)) :
      ?>
      <div class="flex flex-col gap-6" style="margin-right: 32px;">
        <a href="<?php the_permalink(); ?>" class="h-72 p-5 bg-slate-100 rounded-xl flex items-center overflow-hidden">
          <?php if (has_post_thumbnail()) : ?>
            <img class="w-full h-full object-cover" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
          <?php else : ?>
            <img class="w-full h-full object-cover" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="Product Image" />
          <?php endif; ?>
        </a>
        <div class="flex flex-col gap-4">
          <div class="flex flex-col">
            <span class="text-black text-sm font-semibold font-plus-jakarta leading-tight">
              <?php 
                // Get all product categories for current post
                $categories = get_the_terms(get_the_ID(), 'product-category');
                $category_name = '';

              
                if ($categories) {
                  foreach ($categories as $category) { 
                    // Get parent term
                    $parent = get_term($category->parent, 'product-category');
                     
                    // Check if parent slug is 'capital'
                    if ($parent && $parent->slug === 'category') {
                      $category_name = $category->name; 
                    }
                  }
                }

                echo $category_name;
              ?>
            </span>
            <a href="<?php the_permalink(); ?>" class="text-black text-2xl font-semibold font-plus-jakarta leading-loose hover:text-[#1A6250]">
              <?php echo get_the_title(); ?>
            </a>
          </div>
          <?php if (!empty($details['capacity']) || !empty($details['load_center'])) : ?>
          <div class="flex gap-4">
            <?php if (!empty($details['capacity'])) : ?>
            <div class="flex-1 flex flex-col">
              <span class="text-black text-base font-normal font-plus-jakarta">Kapasitas</span>
              <span class="text-black text-base font-semibold font-plus-jakarta"><?php echo esc_html($details['capacity']); ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($details['load_center'])) : ?>
            <div class="flex-1 flex flex-col">
              <span class="text-black text-base font-normal font-plus-jakarta">Load Center</span>
              <span class="text-black text-base font-semibold font-plus-jakarta"><?php echo esc_html($details['load_center']); ?></span>
            </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php
          endif;
        endwhile;
        wp_reset_postdata();
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const relatedProductsSlider = new Siema({
    selector: '.related-products-slider',
    perPage: 4,
    loop: true
  });

  // Add click handlers for prev/next buttons
  document.querySelector('.related-products-prev').addEventListener('click', () => relatedProductsSlider.prev());
  document.querySelector('.related-products-next').addEventListener('click', () => relatedProductsSlider.next());
});
</script>

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php 

get_footer();