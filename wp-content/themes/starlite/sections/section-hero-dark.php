<?php if($section = get_field('hero')): ?>
    <?php if($section['is_visible']): ?>
        <section id="hero">
            <div class="bg-cover min-h-[699px] lg:min-h-[800px] flex pt-[120px] lg:pt-[225px]" style="background: url(<?php echo $section['background_image'] ?>), linear-gradient(98deg, rgba(0,0,0,0.6) 33.26%, rgba(0,0,0,0.6) 97.02%); background-blend-mode: multiply; background-position:center; background-size: cover;">
                <div class="container v-stack !gap-8 !lg:gap-6">
                    <h2 class="text-[28px] lg:text-[50px] lg:whitespace-pre-line text-white"><?php echo $section['title']; ?></h2>
                    <div class="text-[16px] lg:text-[24px] leading-[1.4] lg:whitespace-pre-line text-white"><?php echo $section['description']; ?></div>

                    <?php if($link = $section['link']): ?>
                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="flex items-center gap-4 text-[10px] lg:text-[18px] text-white lg:mt-5">
                            <?php echo $link['title']; ?>
                            <span class="w-[34px] lg:w-[64px] aspect-[1/1] rounded-full border-2 border-white inline-flex items-center justify-center text-[18px] lg:text-[30px]">
                            <i class="fa fa-arrow-right"></i>
                        </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>