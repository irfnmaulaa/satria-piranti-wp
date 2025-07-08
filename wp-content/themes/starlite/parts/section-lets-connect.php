<?php
/*
 Template Name: Let's Connect
 Template Post Type: part
*/
?>

<?php if($section = get_part('lets_connect')): ?>
    <?php if($section['is_visible']): ?>
        <section id="lets-connect" class="bg-cover" style="background: url(<?php echo $section['background_image'] ?>), #323232; background-blend-mode: multiply; background-position: center; background-size: cover !important;">
            <div class="container py-14 lg:py-32 v-stack !gap-10 !lg:gap-14">
                <div class="grid lg:grid-cols-[1fr_auto] gap-5 lg:gap-10 items-end text-white">
                    <div class="v-stack !gap-5">
                        <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                        <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                        <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                    </div>
                    <div>
                        <?php get_template_part('components/component', 'link', [ 'link' => $section['link'], 'border_color' => 'border-white', 'text_color' => 'text-white' ]); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>