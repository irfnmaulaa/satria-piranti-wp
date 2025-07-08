<?php
/*
 Template Name: Career
*/

// define current language
$lang = get_current_lang();

// define mailto
$mailto = get_field('career_send_to_email');

?>

<?php get_header(); ?>

<!-- S: Hero -->
<?php get_template_part('sections/section', 'hero'); ?>
<!-- E: Hero -->

<!-- S: Career - About -->
<?php if($section = get_field('career_about')): ?>
<?php if($section['is_visible']): ?>
<section id="career-about">
    <div class="container !max-w-[800px] py-10 lg:py-[100px] v-stack !gap-6 !lg:gap-12" style="max-width: 815px;">
        <div class="text-[16px] lg:text-[24px] leading-[1.4] lg:whitespace-pre-line"><p><?php echo $section['summary']; ?></p></div>
        <div class="text-[14px] lg:text-[18px] leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['details']; ?></p></div>
    </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- E: Career - About -->

<!-- S: Career - Open Position -->
<?php if($section = get_field('open_position')): ?>
    <?php if($section['is_visible']): ?>
        <section id="career-about">
            <div class="container py-10 lg:pt-0 lg:py-[100px] v-stack !gap-8 !lg:gap-12">
                <h2 class="text-[28px] lg:text-[42px] leading-[1.2] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                <div class="grid lg:grid-cols-3 gap-x-5 gap-y-10 lg:gap-y-14">
                <?php foreach(get_open_positions() as $position_data): ?>
                    <?php
                    // define mailing
                    $mailing = get_field('mailing_' . $lang, $position_data->ID);
                    $subject = $mailing['subject'] ?? '';
                    $message = $mailing['body'] ?? '';

                    // define details
                    $details = get_field('position_' . $lang, $position_data->ID);
                    ?>

                    <?php if($details): ?>
                        <div class="v-stack justify-between">
                            <div class="v-stack">
                                <?php if($details['image']): ?>
                                    <img src="<?php echo $details['image']['url'] ?? $details['image']; ?>" alt="image" class="w-full rounded-[15px] aspect-[381/215] object-cover object-center">
                                <?php endif; ?>
                                <div class="v-stack !gap-2 py-2 lg:py-0">
                                    <h3 class="font-semibold text-[16px] lg:text-[24px] leading-[1.4]"><?php echo $details['position_name']; ?></h3>
                                    <h3 class="text-[14px] lg:text-[18px] leading-[1.5]"><?php echo $details['summary']; ?></h3>
                                </div>
                            </div>
                            <div>
                                <a href="mailto:<?php echo $mailto; ?>?subject=<?php echo encodeURIComponent($subject); ?>&body=<?php echo encodeURIComponent($message); ?>" target="_blank" class="text-[14px] lg:text-[18px] text-[#E1261C] flex items-center gap-3 group">
                                <span class="<?php echo $args['border_color'] ?? 'border-white'; ?> inline-flex items-center justify-center">
                                    <span class="w-[18px] overflow-hidden">
                                        <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[calc(-100%_-_20px)] group-hover:translate-x-[0] transition-all duration-500 ease-in-out">
                                            <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                            <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                        </span>
                                    </span>
                                </span>
                                    <?php if($lang === 'id'): ?>
                                        Lamar Posisi Ini
                                    <?php else: ?>
                                        Apply This Position
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<!-- E: Career - Open Position -->

<!-- S: Let's Connect -->
<?php get_template_part('parts/section', 'lets-connect'); ?>
<!-- E: Let's Connect -->

<?php get_footer(); ?>
