<?php if($section = get_field('about_company')): ?>
    <?php if($section['is_visible']): ?>
        <section id="about-company">
            <div class="container py-10 lg:py-[100px] grid lg:grid-cols-3 gap-10 text-[18px] leading-[1.5] whitespace-pre-line border-b border-[#C0C0C0]">
                <?php foreach($section['columns'] as $column): ?>
                    <div><?php echo $column; ?></div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>