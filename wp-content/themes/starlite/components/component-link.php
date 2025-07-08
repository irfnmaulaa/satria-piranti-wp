<?php if(!empty($args['link']) && $link = $args['link']): ?>
    <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="btn inline-flex items-center gap-4 text-[14px] lg:text-[18px] <?php echo $args['text_color'] ?? 'text-white'; ?> lg:mt-5 group">
        <?php echo $link['title']; ?>
        <span class="w-[34px] lg:w-[64px] aspect-[1/1] rounded-full border-2 <?php echo $args['border_color'] ?? 'border-white'; ?> inline-flex items-center justify-center text-[14px] lg:text-[25px]">
            <span class="w-[22px] overflow-hidden">
                <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[calc(-100%_-_20px)] group-hover:translate-x-[0] transition-all duration-500 ease-in-out">
                    <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                    <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                </span>
            </span>
        </span>
    </a>
<?php endif; ?>