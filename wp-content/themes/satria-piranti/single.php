<?php get_header() ?>

<section class="post-detail py-28">
  <div class="container mx-auto px-4 md:px-8 lg:px-32 !max-w-[1000px]">
    <div class="flex flex-col gap-14">
      <div class="flex flex-col gap-5">
        <h1 class="text-3xl md:text-5xl font-semibold font-plus-jakarta-sans leading-tight text-black">
          <?php the_title(); ?>
        </h1>
        
        <div class="flex flex-wrap gap-5 text-base font-plus-jakarta-sans">
          <?php if(has_category()): ?>
          <div class="flex items-center gap-2.5">
            <span class="text-slate-500">Kategori</span>
            <span class="font-semibold text-black"><?php the_category(', '); ?></span>
          </div>
          <?php endif; ?>
          
          <div class="flex items-center gap-2.5">
            <span class="text-slate-500">Publish Date</span>
            <span class="font-semibold text-black"><?php echo get_the_date('d M Y'); ?></span>
          </div>
          
          <div class="flex items-center gap-2.5">
            <span class="text-slate-500">Oleh</span>
            <span class="font-semibold text-black"><?php the_author(); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>


    <div class="container mx-auto px-4 md:px-8 lg:px-32 !max-w-[1264px] my-7">
      <?php if(has_post_thumbnail()): ?>
      <div class="w-full h-[632px] overflow-hidden">
        <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
      </div>
      <?php endif; ?>
    </div>

  <div class="container mx-auto px-4 md:px-8 lg:px-32 !max-w-[1000px]">
    <div class="flex flex-col gap-14"></div>
      <div class="prose max-w-none font-plus-jakarta-sans">
        <?php the_content(); ?>
      </div>

      <?php
      $post_tags = get_the_tags();
      if($post_tags): ?>
      <div class="flex flex-wrap gap-5">
        <?php foreach($post_tags as $tag): ?>
        <div class="px-4 py-3 bg-slate-200 rounded-xl">
          <span class="text-base font-medium text-black font-plus-jakarta-sans">#<?php echo $tag->name; ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer() ?>
