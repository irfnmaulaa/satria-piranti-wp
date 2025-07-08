<?php
/*
 Template Name: Products - Template 2
*/
$lang = get_current_lang();
?>

<?php get_header('dark'); ?>

<!-- S: Hero -->
<?php if($section = get_field('hero_multiple_cta')): ?>
    <?php if($section['is_visible']): ?>
        <section id="hero" class="relative">
            <div class="bg-cover min-h-[699px] lg:min-h-[978px] flex pt-[100px] lg:pt-[140px]" style="background: url(<?php echo $section['background_image'] ?>), linear-gradient(98deg, #353535 33.26%, #353535 97.02%); background-blend-mode: multiply; background-position:center; background-size: cover;">
                <div class="container v-stack !gap-8 !lg:gap-6">
                    <h2 class="text-[28px] lg:text-[50px] lg:whitespace-pre-line text-white"><?php echo $section['title']; ?></h2>
                    <div class="text-[16px] lg:text-[24px] leading-[1.4] lg:whitespace-pre-line text-white"><?php echo $section['description']; ?></div>

                    <?php if($links = $section['links']): ?>
                        <div class="flex flex-col lg:flex-row lg:items-center items-stretch gap-5">
                            <?php foreach($links as $link): ?>
                                <?php $link_item = $link['link']; ?>
                                <a href="<?php echo $link_item['url'] ?? '#'; ?>" target="<?php echo $link_item['target'] ?? '_blank'; ?>" class="flex items-center gap-4 text-[10px] lg:text-[18px] text-white w-full lg:w-[211px] h-[80px] justify-center bg-[#FFFFFF] rounded-[10px]">
                                    <img src="<?php echo $link['image']; ?>" alt="image" class="h-[40px]">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($floating_image = $section['floating_image']): ?>
                <img src="<?php echo $floating_image; ?>" alt="image" class="h-[182px] lg:h-[420px] absolute bottom-0 left-[50%] translate-x-[-50%]">
            <?php endif; ?>
        </section>
    <?php endif; ?>
<?php endif; ?>
<!-- E: Hero -->

<!-- S: Certification and Standard -->
<?php get_template_part('sections/section', 'certification-and-standard'); ?>
<!-- E: Certification and Standard -->

<!-- S: Products Template 2 - Pricing -->
<?php if($section = get_field('products_template_2_pricing')): ?>
    <?php if($section['is_visible']): ?>
        <section id="lets-connect" class="bg-cover" style="background: url(<?php echo $section['background_image'] ?>), #323232; background-blend-mode: multiply; background-position: center; background-size: cover !important;">
            <div class="container py-14 lg:py-32 v-stack !gap-10 !lg:gap-14">
                <div class="grid lg:grid-cols-[1fr_auto] gap-5 lg:gap-10 items-end text-white">
                    <div class="v-stack !gap-5">
                        <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                        <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                        <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                        <?php if($checks = $section['checks']): ?>
                            <div class="flex flex-col gap-3">
                                <?php foreach(explode("\n", $checks) as $check): ?>
                                    <div class="grid grid-cols-[20px_1fr] items-center gap-2 leading-[1]">
                                        <div class="w-[20px] aspect-[1/1] rounded-full border border-white flex items-center justify-center">
                                            <i class="fa fa-check text-xs"></i>
                                        </div>
                                        <?php echo $check; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div> </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<!-- E: Products Template 2 - Pricing -->

<!-- S: Products Template 2 - Section 1 -->
<?php if($section = get_field('products_template_2_section_1')): ?>
    <section id="our-mission" class="bg-[#F2F2F2]">
        <div class="container py-14 lg:py-20 v-stack !gap-12">
            <div class="v-stack !gap-10">
                <div class="v-stack !gap-5">
                    <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                    <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                    <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                </div>
                <div class="grid lg:grid-cols-3 gap-7 lg:gap-3">
                    <?php foreach($section['count'] as $count): ?>
                        <?php $nonNumeric = preg_replace('/[0-9]/', '', $count['number']);; ?>
                        <div class="v-stack !gap-1">
                            <div class="text-[50px] lg:text-[42px] flex items-center gap-2.5"><span><span class="counter" data-target="<?php echo (int) str_replace([',', '.'], '', $count['number']); ?>">0</span><?php echo str_replace([',', '.'], '', $nonNumeric); ?></span> <span class="text-[24px] mt-1"><?php echo $count['unit']; ?></span></div>
                            <div class="text-[13px] leading-[1.8] lg:text-[18px] lg:leading-[1.5]"><?php echo $count['text']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div>
                    <img src="<?php echo $section['image']; ?>" alt="image" class="w-full aspect-[335/300] lg:aspect-[1184/600] rounded-[20px] object-cover object-center">
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- E: Products Template 2 - Section 1 -->

<!-- S: Call to Action -->
<?php if($section = get_field('call_to_action_multiple_links')): ?>
    <?php if($section['is_visible']): ?>
        <section id="lets-connect" class="bg-cover" style="background: url(<?php echo $section['background_image'] ?>), #323232; background-blend-mode: multiply; background-position: center; background-size: cover !important;">
            <div class="container py-14 lg:py-32 v-stack !gap-10 !lg:gap-14">
                <div class="grid lg:grid-cols-[1fr_auto] gap-5 lg:gap-10 items-end text-white">
                    <div class="v-stack !gap-5">
                        <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                        <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                        <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                        <?php if($checks = $section['checks']): ?>
                            <div class="flex flex-col gap-3">
                                <?php foreach(explode("\n", $checks) as $check): ?>
                                    <div class="grid grid-cols-[20px_1fr] items-center gap-2 leading-[1]">
                                        <div class="w-[20px] aspect-[1/1] rounded-full border border-white flex items-center justify-center">
                                            <i class="fa fa-check text-xs"></i>
                                        </div>
                                        <?php echo $check; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if($links = $section['links']): ?>
                            <div class="flex flex-col lg:flex-row lg:items-center items-stretch gap-5">
                                <?php foreach($links as $link): ?>
                                    <?php $link_item = $link['link']; ?>
                                    <a href="<?php echo $link_item['url'] ?? '#'; ?>" target="<?php echo $link_item['target'] ?? '_blank'; ?>" class="flex items-center gap-4 text-[10px] lg:text-[18px] text-white w-full lg:w-[211px] h-[80px] justify-center bg-[#FFFFFF] rounded-[10px]">
                                        <img src="<?php echo $link['image']; ?>" alt="image" class="h-[40px]">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<!-- E: Call to Action -->

<?php get_footer(); ?>
