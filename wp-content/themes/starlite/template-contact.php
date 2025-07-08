<?php
/*
 Template Name: Contact
*/
?>

<?php get_header('dark'); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero-dark'); ?>
<!-- E: Hero -->

<!-- S: Maps -->
<section id="list-post" class="translate-y-[-500px] lg:translate-y-[-420px] mb-[-500px] lg:mb-[-420px] pb-16 lg:pb-32">
    <div class="container v-stack !gap-16 !lg:gap-32">
        <div class="contact-maps-wrapper w-full h-[600px] rounded-[20px] overflow-hidden bg-[#f5f5f5] shadow-lg">
            <?php if($maps = get_field('contact_embed_maps')): ?>
            <?php echo $maps; ?>
            <?php endif; ?>
        </div>

        <div class="grid lg:grid-cols-2 gap-10 mt-20 lg:mt-24">
            <div class="v-stack !gap-4">
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                <?php if($section = get_field('contact_information')): ?>
                    <h3 class="text-[28px] lg:text-[42px] leading-[1.4]"><?php echo $section['title']; ?></h3>
                    <div class="text-[14px] lg:text-[18px] leading-[1.5] mb-4"><?php echo $section['description']; ?></div>
                    <div class="v-stack !gap-5 !lg:gap-4">
                        <?php foreach($section['links'] as $link): ?>
                            <div class="grid grid-cols-[34px_1fr] lg:grid-cols-[64px_1fr] gap-x-4 items-start">
                                <div>
                                    <?php if($link['icon']): ?>
                                        <img src="<?php echo $link['icon']['url'] ?? $link['icon']; ?>" alt="icon" class="w-full">
                                    <?php endif; ?>
                                </div>
                                <div class="pt-[0.5rem]">
                                    <h4 class="text-[14px] leading-[1.2] mb-1"><?php echo $link['label']; ?></h4>

                                    <div class="flex flex-col gap-1">
                                        <?php if($link['links']): ?>
                                            <?php foreach($link['links'] as $link_item): ?>
                                                <div class="text-[14px] lg:text-[18px] leading-[1.5]">
                                                    <a href="<?php echo $link_item['url']; ?>" class="text-[#E1261C]" target="<?php echo $link_item['target']; ?>"><?php echo $link_item['title']; ?></a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php elseif($link['link']): ?>
                                            <div class="text-[14px] lg:text-[18px] leading-[1.5]">
                                                <a href="<?php echo $link['link']['url']; ?>" class="text-[#E1261C]" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <?php if($link['qr']): ?>
                                    <div></div>
                                    <div>
                                        <img src="<?php echo $link['qr']['url'] ?? $link['qr']; ?>" alt="qr" class="border border-[#E1261C] w-full max-w-[200px]">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="v-stack !gap-8 border-t lg:border-0 border-[#C0C0C0] pt-8 lg:pt-0">
                <?php if($section = get_field('contact_form')): ?>
                    <h3 class="text-[28px] lg:text-[42px] leading-[1.4]"><?php echo $section['title']; ?></h3>
                    <div class="contact-form">
                        <?php if($section['shortcode']): ?>
                            <?php echo do_shortcode($section['shortcode']); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>
<!-- E: Maps -->

<?php get_footer(); ?>
