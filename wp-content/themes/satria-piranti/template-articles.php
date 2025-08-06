<?php
/*
 Template Name: Articles
*/
?>

<?php get_header() ?>

<?php 
$featured_article = get_field('featured_article');

if ($featured_article):
    $thumbnail = get_the_post_thumbnail_url($featured_article->ID) ?: 'https://placehold.co/632x421';
    $permalink = get_permalink($featured_article->ID);
?>
<section class="featured-article border-b border-slate-200">
  <div class="container mx-auto px-4 md:px-8 py-16 md:py-28">
    <div class="flex flex-col md:flex-row items-center gap-6 md:gap-10">
      <div class="flex-1 flex flex-col gap-6 md:gap-10">
        <h1 class="text-3xl md:text-5xl font-semibold font-plus-jakarta-sans leading-tight md:leading-[48px] text-black"><?php echo $featured_article->post_title; ?></h1>
        <p class="text-base font-normal font-plus-jakarta-sans text-black"><?php echo wp_trim_words($featured_article->post_content, 40); ?></p>
        <div>
            <a href="<?php echo $permalink; ?>" data-property-1="Variant3" data-show-icon="false" class="inline-flex items-center px-6 py-3 bg-slate-200 rounded-lg">
                <span class="text-base font-bold font-plus-jakarta-sans text-black">Baca Selengkapnya</span>
            </a>
        </div>
      </div>
      <img class="w-full md:w-[632px] h-64 md:h-96 object-cover" src="<?php echo $thumbnail; ?>" alt="<?php echo esc_attr($featured_article->post_title); ?>" />
    </div>
  </div>
</section>
<?php endif; ?>

<section class="article-list">
  <div class="container mx-auto px-4 md:px-8 py-10 md:py-14">
    <div class="flex items-center gap-4 md:gap-8 mb-10 md:mb-14 overflow-x-auto pb-2">
      <?php
        $categories = get_categories();
      ?>
      <button class="px-3 md:px-4 py-3 md:py-4 bg-slate-200 rounded-full text-sm md:text-base font-normal font-plus-jakarta-sans text-black whitespace-nowrap">Semua</button>
      <?php foreach($categories as $category): ?>
        <button class="px-3 md:px-4 py-3 md:py-4 bg-slate-200 rounded-full text-sm md:text-base font-normal font-plus-jakarta-sans text-black whitespace-nowrap"><?php echo $category->name; ?></button>
      <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php 
        foreach(get_articles() as $article):
          $thumbnail = get_the_post_thumbnail_url($article->ID) ?: 'https://placehold.co/400x206';
          $category = get_the_category($article->ID);
          $category_name = !empty($category) ? $category[0]->name : '';
          $permalink = get_permalink($article->ID);
      ?>
      <article data-property-1="Variant2" class="flex flex-col bg-white">
        <a href="<?php echo $permalink; ?>">
          <img class="w-full h-52 object-cover" src="<?php echo $thumbnail; ?>" alt="<?php echo $article->post_title; ?>" />
        </a>
        <div class="p-4 md:p-8 flex flex-col gap-4 md:gap-6">
          <div class="flex flex-col gap-2 md:gap-2.5">
            <span class="text-xs md:text-sm font-normal font-plus-jakarta-sans text-black"><?php echo $category_name; ?></span>
            <a href="<?php echo $permalink; ?>" class="hover:underline">
              <h2 class="text-xl md:text-2xl font-semibold font-plus-jakarta-sans text-black"><?php echo $article->post_title; ?></h2>
            </a>
          </div>
          <p class="text-sm md:text-base font-normal font-plus-jakarta-sans text-black"><?php echo wp_trim_words($article->post_content, 20); ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- S: Footer -->
<?php get_template_part('parts/part-footer', null, ['section' => $section]); ?>
<!-- E: Footer -->

<?php get_footer() ?>