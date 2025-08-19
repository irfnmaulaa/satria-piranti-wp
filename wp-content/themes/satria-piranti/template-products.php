<?php
/*
 Template Name: Products
*/
?>

<?php get_header(); ?>

<section class="products">
  <div class="container mx-auto">
    <div class="flex flex-col justify-start items-center gap-14 py-14">
      <div class="w-full flex flex-col justify-start items-start gap-5">
        <h1 class="w-full text-center text-black text-5xl font-semibold font-plus-jakarta-sans leading-[62px]">Sewa & Beli Forklift</h1>
      </div>
      <div class="w-full relative">
        <input type="text" id="product-search" placeholder="Cari Forklift" class="w-full p-5 pl-12 bg-slate-50 rounded-xl text-black text-base font-normal font-plus-jakarta-sans outline-none focus:ring-2 focus:ring-slate-200">
        <div class="absolute left-5 top-1/2 -translate-y-1/2">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </div>
      </div>
    </div>

    <div class="flex justify-center items-start gap-14 pb-24">
      <div class="flex flex-col justify-center items-start gap-10">
        <?php
        // Get all product categories
        $categories = get_terms([
          'taxonomy' => 'product-category',
          'hide_empty' => false,
          'parent' => 0
        ]);
        ?>

        <?php 
        // Get selected categories from URL parameter as array
        $selected_categories = isset($_GET['category']) ? explode(',', $_GET['category']) : [];
        
        foreach($categories as $category): ?>
        <div class="flex flex-col justify-start items-start gap-4">
          <h2 class="text-black text-xl font-semibold font-plus-jakarta-sans leading-7"><?php echo $category->name; ?></h2> 
            <?php
            // Get child categories
            $child_categories = get_terms([
              'taxonomy' => 'product-category',
              'hide_empty' => false,
              'parent' => $category->term_id
            ]);
            
            foreach($child_categories as $child):
              $is_active = in_array($child->slug, $selected_categories);
              
              // Add or remove category from selected categories
              $updated_categories = $selected_categories;
              if($is_active) {
                $updated_categories = array_diff($updated_categories, [$child->slug]);
              } else {
                $updated_categories[] = $child->slug;
              }
              
              // Build URL with updated categories
              $category_url = add_query_arg('category', implode(',', array_filter($updated_categories)));
            ?>
              <a href="<?php echo esc_url($category_url); ?>" 
                 class="text-black text-base font-normal font-plus-jakarta-sans hover:text-slate-600 transition-colors <?php echo $is_active ? 'font-bold' : ''; ?>">
                <?php echo $child->name; ?>
              </a>
            <?php endforeach; ?> 
        </div>
        <?php endforeach; ?>
      </div>

      <div class="flex-1 flex flex-col justify-center items-start gap-5">
        <select class="px-6 py-3 rounded-xl border border-slate-200 text-black text-base font-normal font-plus-jakarta-sans bg-white focus:outline-none focus:ring-2 focus:ring-slate-200 cursor-pointer appearance-none">
          <option value="terbaru">Terbaru</option>
          <option value="terpopuler">Terpopuler</option>
        </select>

        <div class="grid grid-cols-4 gap-8" id="products-grid">
          <?php 
          $products = get_products();
          
          if($products): foreach($products as $product): 
            // Get product metadata
            $details = get_field('product_details', $product->ID);
            $capacity = $details['capacity'];
            $load_center = $details['load_center'];
          ?>

          <?php 
            // Get all product categories for current post
            $categories = get_the_terms($product->ID, 'product-category');
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

          ?>


          <div class="product-item w-60 bg-white flex flex-col justify-start items-start gap-6" data-title="<?php echo esc_attr(strtolower(get_the_title($product->ID))); ?>">
            <a href="<?php echo get_the_permalink($product->ID); ?>" class="w-full h-60 p-5 bg-slate-100 rounded-xl flex justify-center items-center overflow-hidden">
                <img class="w-full h-full object-cover" 
                   src="<?php echo get_the_post_thumbnail_url($product->ID) ?: get_stylesheet_directory_uri() . '/img/placeholder.png'; ?>" 
                   alt="<?php echo esc_attr($product->post_title); ?>" />
            </a>
            <div class="w-full flex flex-col gap-4">
              <div class="flex flex-col">
                <div class="text-slate-500 text-sm font-semibold font-plus-jakarta-sans">
                  <?php echo $category_name; ?>
                </div>
                <div class="text-black text-lg font-semibold font-plus-jakarta-sans leading-7">
                    <a href="<?php echo get_the_permalink($product->ID); ?>">
                        <?php echo get_the_title($product->ID); ?>
                    </a>
                </div>
              </div>
              <div class="flex justify-between gap-4">
                <div class="flex-1 flex flex-col">
                  <div class="text-slate-500 text-sm font-normal font-plus-jakarta-sans">Kapasitas</div>
                  <div class="text-black text-base font-semibold font-plus-jakarta-sans">
                    <?php echo esc_html($capacity); ?>
                  </div>
                </div>
                <div class="flex-1 flex flex-col">
                  <div class="text-slate-500 text-sm font-normal font-plus-jakarta-sans">Load Center</div>
                  <div class="text-black text-base font-semibold font-plus-jakarta-sans">
                    <?php echo esc_html($load_center); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<!-- Add JavaScript for search functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('product-search');
    const productsGrid = document.getElementById('products-grid');
    const productItems = document.querySelectorAll('.product-item');

    function filterProducts(searchTerm) {
        const term = searchTerm.toLowerCase().trim();
        
        productItems.forEach(function(item) {
            const title = item.getAttribute('data-title');
            
            if (term === '' || title.includes(term)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Filter on Enter key press
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterProducts(this.value);
        }
    });

    // Optional: Also filter on input change for real-time search
    searchInput.addEventListener('input', function() {
        filterProducts(this.value);
    });
});
</script>

<?php get_footer(); ?>