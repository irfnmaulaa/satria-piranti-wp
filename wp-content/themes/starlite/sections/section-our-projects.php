<?php if($section = get_field('our_projects')): ?>
    <?php if($section['is_visible']): ?>
        <section id="our-projects">
            <div class="container py-10 lg:py-[100px] v-stack !gap-8 !lg:gap-12">
                <div class="v-stack !gap-5">
                    <h2 class="text-[24px] lg:text-[42px] lg:whitespace-pre-line"><?php echo $section['title']; ?></h2>
                    <div class="text-[13px] leading-[1.8] lg:text-[18px] lg:leading-[1.5] lg:whitespace-pre-line"><p><?php echo $section['description']; ?></p></div>
                </div>
                <div>
                    <?php $projects = get_projects(); ?>
                    <?php $first_project = $projects[0]; ?>

                    <?php if($first_project && $project = get_field('project', $first_project->ID)): ?>
                    <div class="project-display aspect-[335/300] lg:aspect-[1184/600] bg-[#252525] rounded-[20px] overflow-hidden"></div>
                    <?php endif; ?>

                    <div class="flex lg:grid lg:grid-cols-[auto_auto_auto] lg:justify-center lg:gap-5 mt-5 items-center lg:px-8 overflow-auto pb-3 lg:pb-0">
                        <div class="hidden lg:flex group btn">
                            <button class="project-nav project-nav-prev w-[64px] aspect-[1/1] bg-[#F2F2F2] border border-[#C0C0C0] text-[#C0C0C0] text-[24px] flex items-center justify-center rounded-full">
                                <span class="w-[22px] overflow-hidden">
                                    <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[0] group-hover:translate-x-[calc(-100%_-_20px)] transition-all duration-500 ease-in-out">
                                        <span class="flex justify-center"><i class="fa fa-arrow-left"></i></span>
                                        <span class="flex justify-center"><i class="fa fa-arrow-left"></i></span>
                                    </span>
                                </span>
                            </button>
                        </div>
                        <div class="flex flex-nowrap whitespace-nowrap gap-3 lg:gap-5 lg:overflow-auto">
                            <?php foreach($projects as $i => $project_data): ?>
                                <?php $project = get_field('project', $project_data->ID); ?>
                                <button class="project-item w-[60px] lg:w-[100px]" data-index="<?php echo $i; ?>" data-video-url="<?php echo $project['video']['url'] ?? $project['video']; ?>" data-image-url="<?php echo $project['image']['url'] ?? $project['image']; ?>">
                                    <img src="<?php echo $project['image']['url'] ?? $project['image']; ?>" alt="<?php echo $project_data->post_title; ?>" class="w-full aspect-[1/1] object-cover object-center">
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <div class="hidden lg:flex group btn">
                            <button class="project-nav project-nav-next w-[64px] aspect-[1/1]  text-[24px] flex items-center justify-center rounded-full">
                                <span class="w-[22px] overflow-hidden">
                                    <span class="w-full grid grid-cols-[100%_100%] gap-[20px] translate-x-[calc(-100%_-_20px)] group-hover:translate-x-[0] transition-all duration-500 ease-in-out">
                                        <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                        <span class="flex justify-center"><i class="fa fa-arrow-right"></i></span>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>