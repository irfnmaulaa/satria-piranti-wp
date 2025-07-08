<?php
/*
 Template Name: Footer
 Template Post Type: part
*/
?>

<?php if($footer = get_footer_data()): ?>
    <?php if($section = get_field('footer', $footer->ID)): ?>
        <footer id="footer">
            <div class="container pt-14 lg:pt-[100px] pb-[40px] !gap-16 v-stack">
                <div class="grid lg:grid-cols-[1.1fr_1fr_1fr_1fr] gap-10 lg:gap-6">
                    <div class="v-stack !gap-10">
                        <div><img src="<?php echo $section['logo']['url']; ?>" alt="logo" class="h-[40px]"></div>
                        <div class="text-[14px] lg:whitespace-pre-line"><?php echo $section['description']; ?></div>
                    </div>

                    <?php if($nav = $section['about']): ?>
                        <div class="v-stack !gap-10">
                            <h3><?php echo $nav['title']; ?></h3>
                            <div class="v-stack !gap-4">
                                <?php foreach($nav['links'] as $link): ?>
                                    <?php if($link): ?>
                                        <div>
                                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                                                <?php echo $link['title']; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($nav = $section['products']): ?>
                        <div class="v-stack !gap-10">
                            <h3><?php echo $nav['title']; ?></h3>
                            <div class="v-stack !gap-4">
                                <?php foreach($nav['links'] as $link): ?>
                                    <?php if($link): ?>
                                        <div>
                                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                                                <?php echo $link['title']; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($nav = $section['contact']): ?>
                        <div class="v-stack !gap-10">
                            <h3><?php echo $nav['title']; ?></h3>
                            <div class="v-stack !gap-3">
                                <div><?php echo $nav['address']; ?></div>
                                <?php foreach($nav['links'] as $link): ?>
                                    <div>
                                        <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
                                            <?php echo $link['title']; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div>
                                <img src="<?php echo $nav['image']['url']; ?>" alt="image" class="h-[40px]">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col-reverse lg:flex-row lg:items-center justify-between gap-4">
                    <div class="text-[18px] leading-[1.5] text-center lg:text-left mt-4 lg:mt-0"><?php echo get_field('copyright', $footer->ID); ?></div>
                    <div class="flex items-center justify-between lg:justify-start gap-1">
                        <?php foreach($section['social_media'] as $social): ?>
                            <?php if($link = $social['link']): ?>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="social-link-item p-1.5 aspect-[1/1] hover:bg-gray-200 transition duration-500 rounded-full flex items-center justify-center" title="<?php echo $link['title']; ?>">
                                    <img src="<?php echo $social['icon']; ?>" alt="image" class="w-[48px] h-[48px] lg:w-[24px] lg:h-[24px] aspect-[1/1] object-contain object-center">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </footer>
    <?php endif; ?>
<?php endif; ?>