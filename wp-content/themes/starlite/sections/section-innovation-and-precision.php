<?php if($section = get_field('about_innovation_and_precision')): ?>
    <?php if($section['is_visible']): ?>
        <section id="about-innovation-and-precision" class="bg-[#F2F2F2]">
            <div class="container py-10 lg:py-[100px] v-stack !gap-8">
                <div class="v-stack !gap-5">
                    <h3 class="text-[14px] lg:text-[14px]"><?php echo $section['name']; ?></h3>
                    <h2 class="text-[28px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                </div>
                <div class="grid lg:grid-cols-2 gap-5">
                    <?php foreach($section['description'] as $text): ?>
                        <div class="text-[14px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $text; ?></p></div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-4 grid grid-cols-2 lg:grid-cols-3 lg:grid-rows-2 gap-[20px]">
                    <?php if($section['images']): ?>
                        <?php foreach(array_values($section['images']) as $i => $image): ?>
                            <?php if($i === 0): ?>
                                <img src="<?php echo $image['url'] ?? $image; ?>" alt="image" class="w-full rounded-[15px] lg:row-[1/3] aspect-[157/150] lg:aspect-[381/520] object-center object-cover">
                            <?php elseif($i >= count(array_values($section['images'])) - 1): ?>
                                <img src="<?php echo $image['url'] ?? $image; ?>" alt="image" class="w-full rounded-[15px] col-[1/3] lg:col-[unset] aspect-[334/150] lg:aspect-[381/250] object-center object-cover">
                            <?php else: ?>
                                <img src="<?php echo $image['url'] ?? $image; ?>" alt="image" class="w-full rounded-[15px] aspect-[157/150] lg:aspect-auto object-center object-cover">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>