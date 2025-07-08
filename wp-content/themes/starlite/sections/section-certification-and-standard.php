<?php if($section = get_field('about_certification_and_standard')): ?>
    <?php if($section['is_visible']): ?>
        <section id="about-certification-and-standard">
            <div class="container py-10 lg:py-[100px] grid lg:grid-cols-[1.2fr_1fr] gap-8 lg:gap-16 items-center">
                <div class="v-stack !gap-5">
                    <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                    <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                    <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                    <?php foreach($section['images'] as $image): ?>
                        <img src="<?php echo wp_get_attachment_url($image->ID); ?>" alt="image" class="w-full">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>