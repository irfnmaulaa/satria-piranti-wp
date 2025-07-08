<?php if($section = get_field('hero_with_slideshow')): ?>
    <?php if($section['is_visible']): ?>
        <section id="hero">
            <div class="container container-fluid">
                <div class="relative min-h-[570px] lg:min-h-[800px] flex items-center">

                    <div class="absolute left-0 top-0 w-full h-full rounded-[20px] z-2 hero-bg transition duration-100">
                        <?php foreach(array_values($section['background_images']) as $i => $image): ?>
                            <div id="background-slideshow-image-<?php echo $i; ?>" class="background-slideshow-image absolute left-0 top-0 w-full h-full rounded-[20px] z-1 <?php echo $i == 0 ? 'active' : ''; ?>" style="background: url(<?php echo $image ?>); background-position:center; background-size: cover;"></div>
                        <?php endforeach; ?>
                        <div class="absolute left-0 top-0 w-full h-full rounded-[20px] z-2" style="background: linear-gradient(98deg, rgba(0, 0, 0, 0.4) 33.26%, rgba(0, 0, 0, 0.2) 97.02%);"></div>
                    </div>

                    <div class="absolute container left-[50%] translate-x-[-50%] top-[1.5rem] lg:top-[3.5rem] flex items-center gap-2.5 lg:gap-3">
                        <?php foreach(array_values($section['background_images']) as $i => $image): ?>
                            <button id="hero-nav-item-<?php echo $i; ?>" data-target-index="<?php echo $i; ?>" class="hero-nav-item w-[10px] aspect-[1/1] rounded-full bg-gray-500 <?php echo $i == 0 ? 'active' : ''; ?>"></button>
                        <?php endforeach; ?>
                    </div>

                    <div class="container v-stack !gap-8 !lg:gap-6 relative z-3">
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