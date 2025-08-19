<?php
/*
 Template Name: About Us
*/
?>

<?php get_header() ?>

<!-- S: Hero -->
<?php if($section = get_field('hero')): ?> 
<section class="px-4 md:px-[124px] py-16 md:py-[120px] bg-white">
    <div class="container">
        <h1 class="text-3xl md:text-[48px] leading-tight md:leading-[62px] font-semibold">
            <?php echo $section['title']; ?>
        </h1>
    </div>
</section> 
<?php endif; ?>
<!-- E: Hero -->

<!-- S: Short History and Value -->
<?php if($section = get_field(selector: 'short_history')): ?> 
<section class="relative bg-cover bg-center" style="background-image: url('<?php echo wp_get_attachment_url($section['media']['ID']); ?>');">
    <div class="absolute inset-0 gradient-overlay"></div>
    <div class="relative px-4 md:px-[124px] py-16 md:py-[120px]">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="hidden md:block">
                  <div class="w-full h-full flex items-center justify-center">
                      <a href="#" id="play-button" class="w-[75px] aspect-[1/1] rounded-full hover:scale-[1.2]" style="transition: .2s; background-image: url('<?php echo get_stylesheet_directory_uri() . '/img/play-icon.svg'; ?>'); background-size: contain;"></a>   
                  </div>
                </div>
                <div class="col-span-1">
                    <h2 class="text-2xl md:text-4xl font-semibold text-white mb-4 md:mb-6">
                        <?php echo $section['title']; ?>
                    </h2>
                    <p class="text-lg md:text-xl text-white whitespace-pre-line">
                        <?php echo $section['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($youtube_url =$section['youtube_video_url']): ?> 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const playButton = document.getElementById('play-button');
    const modal = document.getElementById('video-modal');
    const closeButton = document.getElementById('close-modal');
    const iframe = document.getElementById('youtube-iframe');
    const videoUrl = '<?= $youtube_url ?>';

    // Open modal when play button is clicked
    playButton.addEventListener('click', function(e) {
        e.preventDefault();
        iframe.src = videoUrl;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });

    // Close modal when close button is clicked
    closeButton.addEventListener('click', function() {
        modal.classList.add('hidden');
        iframe.src = ''; // Stop video playback
        document.body.style.overflow = 'auto'; // Restore scrolling
    });

    // Close modal when clicking outside the video
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            iframe.src = ''; // Stop video playback
            document.body.style.overflow = 'auto'; // Restore scrolling
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            iframe.src = ''; // Stop video playback
            document.body.style.overflow = 'auto'; // Restore scrolling
        }
    });
});
</script>
<?php endif; ?>
<?php endif; ?>
<!-- E: Short History and Value -->

<!-- S: Focus & Goals -->
<?php if($section = get_field(selector: 'focus_and_goals')): ?> 
<section class="px-4 md:px-[124px] py-16 md:py-[120px] bg-white">
    <div class="container text-center">
        <h2 class="text-2xl md:text-4xl font-semibold text-black mb-3 md:mb-4">
            <?php echo $section['title']; ?>
        </h2>
        <p class="text-lg md:text-xl font-normal text-black mb-10 md:mb-16">
            <?php echo $section['description']; ?>
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if($section['items']): foreach($section['items'] as $item): ?>
            <div class="flex flex-col items-center">
                <img 
                    src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>" 
                    alt="<?php echo $item['title']; ?>"
                    class="w-24 md:w-[128px] h-24 md:h-[128px] object-cover mb-4 md:mb-6"
                >
                <h3 class="text-base md:text-lg font-medium text-black mb-2 md:mb-4">
                    <?php echo $item['title']; ?>
                </h3>
                <p class="text-sm md:text-base font-normal text-black">
                    <?php echo $item['description']; ?>
                </p>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- E: Focus & Goals --> 

<!-- S: Our Advantages -->
<?php if($section = get_field('advantages')): ?>
<section class="px-4 md:px-32 py-16 md:py-24 bg-slate-50">
  <div class="container">
    <div class="flex flex-col items-center gap-8 md:gap-14 w-full">
      <div class="flex items-center gap-8 md:gap-14 w-full">
        <div class="flex flex-col items-start gap-4 md:gap-6 flex-1">
          <h2 class="w-full font-semibold text-center text-black text-2xl md:text-4xl leading-tight md:leading-10">
            <?php echo $section['title']; ?>
          </h2>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10 w-full">
        <?php if($section['items']): foreach($section['items'] as $item): ?>
        <div class="flex items-start gap-4 md:gap-6">
          <div class="w-12 h-12 md:w-14 md:h-14">
            <img 
              src="<?php echo wp_get_attachment_url($item['image']['ID'] ?? $item['image']); ?>"
              alt="<?php echo $item['title']; ?>"
              class="w-full h-full object-cover"
            >
          </div>
          <div class="flex flex-col gap-1 md:gap-2">
            <h3 class="text-black font-medium text-lg md:text-xl leading-tight md:leading-7"><?php echo $item['title']; ?></h3>
            <p class="text-black text-sm md:text-base"><?php echo $item['description']; ?></p>
          </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- E: Our Advantages -->

<!-- S: Trusted by Company -->
<?php get_template_part('parts/part-trusted-by-company', null, ['section' => $section]); ?>
<!-- E: Trusted by Company -->

<!-- S: Testimonial --> 
<?php get_template_part('parts/part-testimonial', null, ['section' => $section]); ?>
<!-- E: Testimonial -->

<!-- S: CTA -->
<?php get_template_part('parts/part-cta', null, ['section' => $section]); ?>
<!-- E: CTA -->

<!-- S: Video Modal -->
<div id="video-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative bg-white rounded-lg overflow-hidden max-w-4xl w-full mx-4">
        <button id="close-modal" class="absolute top-4 right-4 text-white bg-black bg-opacity-50 rounded-full w-8 h-8 flex items-center justify-center hover:bg-opacity-75 z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="aspect-video">
            <iframe id="youtube-iframe" width="100%" height="100%" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
<!-- E: Video Modal -->

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer() ?>
