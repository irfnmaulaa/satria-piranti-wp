<?php
/*
 Template Name: Products
*/
$lang = get_current_lang();
?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero'); ?>
<!-- E: Hero -->

<!-- S: Product List -->
<section id="product-list">
    <div class="container py-10 lg:py-[100px] v-stack !gap-8 !lg:gap-12">
        <div class="flex items-center whitespace-nowrap overflow-x-auto lg:overflow-x-visible justify-start lg:justify-center gap-3 pb-3 lg:pb-0">
            <a href="<?php echo get_the_permalink(get_locale_page('products')->ID ?? null); ?>" class="tab-item <?php echo !$_GET['category'] ? 'active' : ''; ?>">
                <?php if($lang === 'id'): ?>
                    Semua
                <?php else: ?>
                    All
                <?php endif; ?>
            </a>
            <?php foreach(get_product_categories() as $category): ?>
                <?php $link = get_the_permalink(get_locale_page('products')->ID ?? null) . '?category=' . $category->slug ?>
                <a href="<?php echo $link; ?>" data-target="<?php echo $category->slug; ?>" class="tab-item <?php echo $_GET['category'] == $category->slug ? 'active' : ''; ?>"><?php echo $category->name; ?></a>
            <?php endforeach; ?>
        </div>

        <?php foreach(get_product_categories() as $category): ?>
            <?php $category_description = get_field('product_category_descriptions', $category->taxonomy . '_' . $category->term_id)[$lang]; ?>
            <?php if($category_description): ?>
                <div class="category-description mt-3 text-[14px] lg:text-[18px] leading-[1.5] lg:whitespace-pre-line pt-1.5 max-w-[582px]" data-category="<?php echo $category->slug ?? 'uncategorized'; ?>" style="<?php echo $_GET['category'] == $category->slug ? '' : 'display:none;'; ?>"><?php echo $category_description['description']; ?></div>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($description = get_field('product_description_all')): ?>
            <div class="category-description category-description-all text-[14px] lg:text-[18px] leading-[1.5] lg:whitespace-pre-line pt-1.5" style="<?php echo empty($_GET['category']) ? '' : 'display:none;'; ?>"><?php echo $description; ?></div>
        <?php endif; ?>

        <div class="grid lg:grid-cols-3 gap-12 lg:gap-8">
            <?php foreach(get_products() as $product): ?>
                <?php if($product_data = get_field('product', $product->ID)): ?>
                    <?php $categories = get_the_terms($product->ID, 'product-category'); ?>
                    <div class="product-item cursor-pointer group" style="<?php echo $categories && !empty($_GET['category']) && ($_GET['category'] != $categories[0]->slug) ? 'display:none' : ''; ?>" data-category="<?php echo $categories[0]->slug ?? 'uncategorized'; ?>" data-image-url="<?php echo $product_data['cover']['url'] ?? $product_data['cover']; ?>">
                        <?php if($product_data['cover']): ?>
                            <img src="<?php echo $product_data['cover']['url'] ?? $product_data['cover']; ?>" alt="image" class="w-full rounded-[15px] border border-[#C0C0C0] aspect-[368/300] object-center object-cover">
                        <?php endif; ?>
                        <div class="mt-[25px]">
                            <h3 class="text-[16px] lg:text-[24px] text-center lg:text-left leading-[1.4] group-hover:text-[#E1261C] transition duration-300 inline-block"><?php echo $product_data['name']; ?></h3>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="product-modal modal fixed top-0 left-0 w-full h-full bg-[rgba(0,0,0,0.8)] z-20 opacity-0 pointer-events-none transition duration-300">
            <div class="modal-box absolute top-[60px] left-[50%] translate-x-[-50%] w-full max-w-[800px] bg-white rounded-[20px] border border-[#C0C0C0] overflow-hidden">
                <a href="#" class="absolute right-5 top-5 text-[#323232] modal-close w-[35px] rounded-full hover:bg-gray-200 transition duration-300 aspect-[1/1] ">
                    <span class="absolute left-[50%] top-[50%] w-[20px] h-[2px] translate-x-[-50%] translate-y-[-50%] rotate-45 bg-black"></span>
                    <span class="absolute left-[50%] top-[50%] w-[20px] h-[2px] translate-x-[-50%] translate-y-[-50%] rotate-[-45deg] bg-black"></span>
                </a>
                <div class="w-full h-full overflow-y-auto max-h-[calc(100vh_-_120px)]">
                    <img src="" alt="image" class="product-modal-image w-full">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- S: Product List -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->

<?php get_footer(); ?>
