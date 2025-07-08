<?php
$data = get_field('post_details');

$lang = get_current_lang();
$link_text = 'Read More';
if ($lang === 'id') {
    $link_text = 'Baca Selengkapnya';
}
?>

<?php get_header(); ?>

<!-- S: Hero -->
<section id="hero">
    <div class="container container-fluid">
        <div class="relative min-h-[570px] lg:min-h-[800px]">
            <div class="hero-bg absolute left-0 top-0 w-full h-full rounded-[20px]" style="background: url(<?php echo $data['thumbnail']['url'] ?? $data['thumbnail'] ?>), linear-gradient(98deg, rgba(0, 0, 0, 0.4) 33.26%, rgba(0, 0, 0, 0.2) 97.02%); background-blend-mode: multiply; background-position:center; background-size: cover;"></div>
            <div class="container v-stack !gap-8 !lg:gap-6 justify-between py-20 relative z-2 min-h-[570px] lg:min-h-[800px]">
                <div>
                    <?php if($previous_page = get_locale_page('news')): ?>
                        <a href="<?php echo get_the_permalink($previous_page->ID); ?>" class="btn inline-flex items-center gap-4 text-[14px] lg:text-[18px] text-white lg:mt-5 group">
                            <span class="w-[34px] lg:w-[64px] aspect-[1/1] rounded-full border-2 border-white inline-flex items-center justify-center text-[14px] lg:text-[25px]">
                                <span class="w-[22px] overflow-hidden">
                                    <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[0] group-hover:translate-x-[calc(-100%_-_20px)] transition-all duration-500 ease-in-out">
                                        <span class="flex justify-center"><i class="fa fa-arrow-left"></i></span>
                                        <span class="flex justify-center"><i class="fa fa-arrow-left"></i></span>
                                    </span>
                                </span>
                            </span>
                            Back to News
                        </a>
                    <?php endif; ?>
                </div>
                <div class="v-stack max-w-[790px] !gap-8">
                    <div class="text-[14px] lg:text-[14px] leading-[1.2] uppercase tracking-[1px] text-white"><?php echo get_the_date('d F Y'); ?></div>
                    <h2 class="text-[28px] lg:text-[50px] lg:whitespace-pre-line text-white"><?php echo get_the_title(); ?></h2>
                </div>
                <div></div>
            </div>
        </div>
    </div>
</section>
<!-- E: Hero -->

<!-- S: Post Details -->
<section id="post-details">
    <div class="container py-10 lg:py-[100px]">
        <div class="v-stack news-content leading-[1.5] text-[14px] lg:text-[18px] max-w-[800px] mx-auto" style="gap: 0;">
            <?php echo get_the_content(); ?>
        </div>
    </div>
</section>
<!-- E: Post Details -->

<!-- S: Other News -->
<section id="other-news" class="bg-[#F2F2F2]">
    <div class="container py-10 lg:py-[100px] v-stack !gap-12">
        <div class="v-stack !gap-5 items-center justify-between" style="flex-direction: row">
            <h2 class="text-[24px] lg:text-[42px] lg:whitespace-pre-line">Other News</h2>
            <?php get_template_part('components/component', 'link', [ 'link' => ['url' => site_url('/news-' . get_current_lang()), 'title' => 'Read All News'], 'border_color' => 'border-[#E1261C]', 'text_color' => 'text-[#E1261C]' ]); ?>
        </div>
        <div class="grid lg:grid-cols-3 gap-x-5 gap-y-10 lg:gap-y-14">
            <?php foreach(get_latest_news(3) as $post_data): ?>
                <?php if($data = get_field('post_details', $post_data->ID)): ?>
                    <div class="v-stack">
                        <?php if($data['thumbnail']): ?>
                            <img src="<?php echo $data['thumbnail']['url'] ?? $data['thumbnail']; ?>" alt="thumbnail" class="w-full rounded-[15px] aspect-[381/215] object-cover object-center">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-[#f5f5f5] rounded-[15px] text-[48px] text-[#777]">
                                <i class="fa fa-image"></i>
                            </div>
                        <?php endif; ?>
                        <div class="v-stack !gap-2 py-2 lg:py-0">
                            <div class="text-[14px] leading-[1.2] uppercase tracking-[0.7px]"><p><?php echo date('d F Y', strtotime($post_data->post_date)); ?></p></div>
                            <h3 class="font-semibold text-[16px] lg:text-[24px] leading-[1.4]"><?php echo $post_data->post_title; ?></h3>
                        </div>
                        <a href="<?php echo get_the_permalink($post_data->ID); ?>" class="text-[14px] lg:text-[18px] text-[#E1261C] flex items-center gap-3 group">
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
        </div>
    </div>
</section>
<!-- E: Other News -->


<?php get_footer(); ?>
