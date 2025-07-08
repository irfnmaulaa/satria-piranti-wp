<?php
/*
 Template Name: Homepage
*/

$lang = get_current_lang();
$link_text = 'See category';
if ($lang === 'id') {
    $link_text = 'Lihat kategori';
}
?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero-with-slideshow'); ?>
<!-- E: Hero -->

<!-- S: Our Vision -->
<?php if($section = get_field('our_vision')): ?>
    <section id="our-vision" class="pt-10">
        <div class="container py-14 lg:py-20 v-stack !gap-14">
            <div class="v-stack !gap-5">
                <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
            </div>
            <div class="grid lg:grid-cols-3 gap-10 lg:gap-5">
                <?php foreach($section['items'] as $item): ?>
                <div class="v-stack !gap-2.5">
                    <img src="<?php echo $item['image']; ?>" alt="image" class="w-full mb-3 rounded-[15px]">
                    <h3 class="text-[16px] lg:text-[25px]"><?php echo $item['title']; ?></h3>
                    <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5]"><p><?php echo $item['description']; ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- E: Our Vision -->

<!-- S: Our Mission -->
<?php if($section = get_field('our_mission')): ?>
    <section id="our-mission" class="bg-[#F2F2F2]">
        <div class="container py-14 lg:py-20 v-stack !gap-12">
            <div class="grid lg:grid-cols-[650px_1fr] gap-10 lg:gap-20 items-center">
                <div class="v-stack !gap-10">
                    <div class="v-stack !gap-5">
                        <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                        <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                        <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-7 lg:gap-7">
                        <?php foreach($section['count'] as $count): ?>
                            <?php $nonNumeric = preg_replace('/[0-9]/', '', $count['number']);; ?>
                            <div class="v-stack !gap-1">
                                <div class="text-[50px] lg:text-[42px] flex items-center gap-2.5"><span><span class="counter" data-target="<?php echo (int) str_replace([',', '.'], '', $count['number']); ?>">0</span><?php echo str_replace([',', '.'], '', $nonNumeric); ?></span> <span class="text-[24px] mt-1"><?php echo $count['unit']; ?></span></div>
                                <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5]"><?php echo $count['text']; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <img src="<?php echo $section['image']; ?>" alt="image" class="w-full rounded-[20px]">
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- E: Our Mission -->

<!-- S: Products Overview -->
<?php if($section = get_field('products_overview')): ?>
    <section id="products-overview" class="pt-10">
        <div class="container py-14 lg:py-20 v-stack !gap-10 !lg:gap-14">
            <div class="grid lg:grid-cols-[1fr_auto] gap-5 lg:gap-10 items-end">
                <div class="v-stack !gap-5">
                    <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                    <h2 class="text-[24px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                    <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                </div>
                <div class="flex justify-end">
                    <?php get_template_part('components/component', 'link', [ 'link' => $section['link'], 'border_color' => 'border-[#E1261C]', 'text_color' => 'text-[#E1261C]' ]); ?>
                </div>
            </div>
            <div class="grid lg:grid-cols-3 lg:grid-rows-2 gap-x-5 gap-10 lg:gap-y-8">
                <?php foreach(array_values($section['is_selected_products'] ? $section['selected_products'] : get_products(5)) as $i => $item): ?>
                    <?php if($product = get_field('product', $item->ID)): ?>
                        <div class="v-stack !gap-2.5 <?php echo $i == 0 ? 'row-[1/3]' : ''; ?>">
                            <img src="<?php echo $product['cover']['url']; ?>" alt="image" class="w-full mb-3 object-center object-cover rounded-[15px] <?php echo $i == 0 ? 'aspect-[381/215] lg:aspect-[357/554]' : 'aspect-[381/215]'; ?>">
                            <h3 class="font-semibold text-[16px] lg:text-[25px]"><?php echo $product['name']; ?></h3>

                            <?php if($categories = get_the_terms($item->ID, 'product-category')): ?>
                            <?php foreach($categories as $i => $category): ?>
                            <?php if($i == 0): ?>
                            <?php $link = get_the_permalink(get_locale_page('products')->ID ?? null) . '?category=' . $category->slug ?>
                            <div>
                                <a href="<?php echo $link; ?>" class="flex items-center gap-3 leading-[1] text-[#E1261C] mt-2.5 group">
                                    <span class="<?php echo $args['border_color'] ?? 'border-white'; ?> inline-flex items-center justify-center">
                                        <span class="w-[18px] overflow-hidden">
                                            <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[calc(-100%_-_20px)] group-hover:translate-x-[0] transition-all duration-500 ease-in-out">
                                                <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                                <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                            </span>
                                        </span>
                                    </span>
                                    <?php echo $link_text; ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- E: Products Overview -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->


<?php get_footer(); ?>
