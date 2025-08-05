<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Satria-Piranti
 */

get_header();
?>

<section class="py-28">
  <div class="container mx-auto px-8">
    <div class="flex items-center justify-between gap-5">
      <div class="flex flex-col items-start gap-10 flex-1">
        <h1 class="text-9xl font-semibold font-inter leading-[128px] text-black">404</h1>
        <h2 class="text-5xl font-semibold font-plus-jakarta-sans leading-[62px] text-black">Maaf, kami tidak dapat menemukan halaman itu!</h2>
        <p class="text-base font-normal font-plus-jakarta-sans text-black">Halaman yang Anda cari telah dihapus atau tidak pernah ada.</p>
        <a href="<?php echo home_url(); ?>" data-property-1="Variant3" data-show-icon="false" class="inline-flex items-center justify-center px-6 py-3 bg-slate-200 rounded-lg gap-3">
          <span class="text-base font-bold font-plus-jakarta-sans text-black">Kembali</span>
        </a>
      </div>
      <img class="w-[632px] h-[632px]" src="<?php echo get_template_directory_uri(); ?>/img/404.webp" alt="404 illustration" />
    </div>
  </div>
</section>

<!-- S: Footer -->
<?php get_template_part('parts/part-footer'); ?>
<!-- E: Footer -->

<?php
get_footer();