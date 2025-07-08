<?php
/*
 Template Name: News
*/
$lang = get_current_lang();

$link_text = 'Read More';
if ($lang === 'id') {
    $link_text = 'Baca Selengkapnya';
}
?>

<?php get_header('dark'); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero-dark'); ?>
<!-- E: Hero -->

<!-- S: List Post -->
<section id="list-post" class="translate-y-[-500px] lg:translate-y-[-420px] mb-[-500px] lg:mb-[-420px] pb-16 lg:pb-32">
    <div class="container v-stack !gap-14 !lg:gap-32">

        <?php
            $latest_posts = get_latest_news(10);
            $first_post = $latest_posts[0];
            $other_posts = array_slice($latest_posts, 1, 3);
        ?>

        <!-- S: Pinned Post -->
        <?php if($first_post): ?>
        <?php $data = get_field('post_details', $first_post->ID); ?>
        <div class="w-full h-[600px] rounded-[20px] grid lg:grid-cols-2 overflow-hidden" style="box-shadow: 0px 4px 100px 10px #0000001A;">
            <div class="pt-6 pb-3 px-6 lg:py-8 lg:p-10 flex items-center justify-center h-full w-full bg-white">
                <div class="v-stack lg:max-w-[392px] !gap-2.5 !lg:gap-4">
                    <div class="text-[14px] leading-[1.2] uppercase tracking-[0.7px]"><p><?php echo date('d F Y', strtotime($first_post->post_date)); ?></p></div>
                    <h3 class="font-semibold text-[16px] lg:text-[24px] leading-[1.4]"><?php echo $first_post->post_title; ?></h3>
                    <div class="text-[14px] lg:text-[18px] leading-[1.5]"><?php echo $data['summary']; ?></div>
                    <div class="mt-2 lg:mt-[-8px]">
                        <div class="lg:mt-5">
                        <?php get_template_part('components/component', 'link', [ 'link' => ['title' => $link_text, 'url' => get_the_permalink($first_post->ID)], 'border_color' => 'border-[#E1261C]', 'text_color' => 'text-[#E1261C]' ]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <?php if($data['thumbnail']): ?>
                    <img src="<?php echo $data['thumbnail']['url'] ?? $data['thumbnail']; ?>" alt="thumbnail" class="w-full h-full object-cover object-center">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center bg-[#f5f5f5] text-[48px] text-[#777]">
                        <i class="fa fa-image"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- E: Pinned Post -->

        <!-- S: Other Post -->
        <div class="grid lg:grid-cols-3 gap-x-5 gap-y-10 lg:gap-y-14 pt-12 lg:pt-32">
            <?php foreach($other_posts as $post_data): ?>
                <?php if($data = get_field('post_details', $post_data->ID)): ?>
                    <div class="v-stack justify-between">
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
                        </div>
                        <div>
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
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <!-- E: Other Post -->

    </div>
</section>
<!-- E: List Post -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->

<?php get_footer(); ?>
