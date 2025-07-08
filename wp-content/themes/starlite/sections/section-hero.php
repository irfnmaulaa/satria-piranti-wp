<?php if($section = get_field('hero')): ?>
    <?php if($section['is_visible']): ?>
        <section id="hero">
            <div class="container container-fluid">
                <div class="relative min-h-[570px] lg:min-h-[800px] flex items-center">
                    <div class="absolute left-0 top-0 w-full h-full rounded-[20px] hero-bg transition duration-100" style="background: url(<?php echo $section['background_image'] ?>), linear-gradient(98deg, rgba(0, 0, 0, 0.4) 33.26%, rgba(0, 0, 0, 0.2) 97.02%); background-blend-mode: multiply; background-position:center; background-size: cover;"></div>
                    <div class="container v-stack !gap-8 !lg:gap-6 relative z-2">
                        <h2 class="text-[28px] lg:text-[50px] lg:whitespace-pre-line text-white"><?php echo $section['title']; ?></h2>
                        <div class="text-[16px] lg:text-[24px] leading-[1.4] lg:whitespace-pre-line text-white"><?php echo $section['description']; ?></div>

                        <?php if(!empty($section['link'])): ?>
                            <div>
                                <?php get_template_part('components/component', 'link', [ 'link' => $section['link'], 'border_color' => 'border-white', 'text_color' => 'text-white' ]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>