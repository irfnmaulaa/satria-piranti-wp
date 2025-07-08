<?php if($section = get_field('about_quality_commitment')): ?>
    <?php if($section['is_visible']): ?>
        <section id="about-quality-commitment">
            <div class="container py-10 lg:py-[100px] grid gap-6 lg:gap-24 lg:grid-cols-[482px_1fr] items-center">
                <div>
                    <?php if($section['image']): ?>
                        <img src="<?php echo $section['image']['url'] ?? $section['image']; ?>" alt="image" class="w-full rounded-[20px] aspect-[335/300] lg:aspect-[482/682] object-center object-cover">
                    <?php endif; ?>
                </div>
                <div class="v-stack !gap-6 !lg:gap-14 pt-1">
                    <h3 class="text-[28px] lg:text-[42px] leading-[1.2] lg:whitespace-pre-line"><?php echo $section['title']; ?></h3>
                    <div class="text-[14px] lg:text-[18px] leading-[1.5] lg:whitespace-pre-line"><?php echo $section['description']; ?></div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>