<?php
/*
 Template Name: Trusted by Company
 Template Post Type: part
*/
?>

<!-- S: Trusted Companies -->
<?php if($data = get_trusted_companies_data()): ?>
<?php if($section = get_field('trusted_by_company', $data->ID)): ?>
<section class="px-32 py-24 bg-white border-t border-b">
  <div class="container">
    <div class="flex flex-col items-center gap-14">
      <div class="w-full">
        <h2 class="text-4xl font-semibold text-black leading-10">
          <?php echo $section['title'] ?? 'Dipercaya oleh Perusahaan Terkemuka'; ?>
        </h2>
      </div>

      <div class="grid grid-cols-6 gap-8">
        <?php if($section['items']): foreach($section['items'] as $company): ?>
        <div class="flex items-center justify-center bg-white h-36">
          <img 
            src="<?php echo wp_get_attachment_url($company['logo']['ID'] ?? $company['logo']); ?>"
            alt="<?php echo $company['name'] ?? ''; ?>"
            class="max-w-[176px] max-h-[52px] object-contain"
          >
        </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php endif; ?>
<!-- E: Trusted Companies -->