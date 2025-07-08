<?php if($section = get_field('our_clients')): ?>
    <?php if($section['is_visible']): ?>
        <section id="our-clients" class="lg:mt-24">
            <div class="container py-10 lg:pt-0 lg:py-[100px] v-stack gap-8 !lg:gap-12">
                <h2 class="text-[24px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-4">
                    <?php foreach(get_clients() as $i => $client_data): ?>
                    <?php $client = get_field('client', $client_data->ID); ?>
                    <?php if($client['logo']): ?>
                        <img src="<?php echo $client['logo']['url'] ?? $client['logo']; ?>" alt="logo" class="w-full">
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>