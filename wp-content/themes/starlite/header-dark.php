<?php if(!$_POST['is_ajax']): ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo get_page_title(); ?></title>

    <meta name="description" content="<?= get_bloginfo('description') ?>">
    <meta name="keywords" content="starlite,id">
    <meta name="author" content="Ahmad Irfan Maulana">

    <link rel="icon" type="image/x-icon" href="<?= get_site_icon_url() ?>">

    <?php $meta_defaults = get_meta_defaults(); ?>

    <!-- Open Graph / Facebook -->
    <meta property="og:url" content="<?= get_the_permalink() ?>">
    <meta property="og:type" content="website">
    <?php foreach(get_field('meta_tags') as $meta_property => $meta_content): ?>
    <?php $value = $meta_content ? $meta_content : $meta_defaults[$meta_property]; ?>
    <meta property="og:<?php echo $meta_property; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= get_the_permalink() ?>">
    <?php foreach(get_field('meta_tags') as $meta_property => $meta_content): ?>
    <?php $value = $meta_content ? $meta_content : $meta_defaults[$meta_property]; ?>
    <meta property="twitter:<?php echo $meta_property; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>

    <?php wp_head(); ?>

</head>
<body class="font-body text-body overflow-x-hidden">

<div id="loader" class="fixed w-[100vw] h-[100vh] mt-[80px] lg:mt-[120px] flex items-center justify-center bg-white z-[22] top-0 left-0">
    <div class="loader mt-[-80px] lg:mt-[-120px]"></div>
</div>

<div id="content">
<?php endif; ?>

<input type="checkbox" id="mobile-menus-checkbox" class="hidden"/>
<header id="header" class="navbar-dark w-full h-[80px] lg:h-[120px] fixed top-0 left-0 z-[20]">
    <div class="container h-full flex items-center justify-between text-white">
        <!-- S: Menu Desktop -->
        <ul class="hidden lg:flex items-center gap-10 h-full">
            <?php foreach(get_menus() as $menu): ?>
                <?php if($menu['children']): ?>
                    <?php $is_active = in_array(get_the_permalink(), array_map(function ($child) { return $child['url']; }, $menu['children'])); ?>
                    <li class="dropdown group relative h-full flex items-center">
                        <a href="<?php echo $menu['url']; ?>" class="nav-link translate-y-[-1px] <?php echo $is_active ? 'active' : ''; ?>">
                            <?php echo $menu['title']; ?>
                        </a>
                        <div class="absolute text-[#323232] left-0 bottom-0 translate-y-[calc(100%_-_1.5rem)] min-w-[161px] pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition duration-100">
                            <div class="w-full bg-white p-3 rounded-[8px] border border-[#C0C0C0]">
                                <?php foreach($menu['children'] as $child): ?>
                                    <a href="<?php echo $child['url']; ?>" class="flex items-center gap-2.5 h-full leading-[1] p-3">
                                        <span class="nav-link border-b border-b-transparent <?php echo get_the_permalink() === $child['url'] ? 'active' : ''; ?>">
                                            <?php echo $child['title']; ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo $menu['url']; ?>" class="nav-link <?php echo get_the_permalink() === $menu['url'] ? 'active' : ''; ?>">
                            <?php echo $menu['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if($current_lang = get_current_lang_details()): ?>
                <li class="dropdown group relative h-full">
                    <span class="nav-link flex items-center gap-2.5 h-full !cursor-pointer leading-[1]">
                        <img src="<?php echo $current_lang['flag']; ?>" alt="lang" class="h-[22px]">
                        <?php echo $current_lang['name']; ?>
                    </span>
                    <div class="absolute text-[#323232] left-0 bottom-0 translate-y-[calc(100%_-_1.5rem)] min-w-[161px] pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition duration-100">
                        <div class="w-full bg-white p-3 rounded-[8px] border border-[#C0C0C0]">
                            <?php
                            $languages = get_posts([
                                'post_type' => 'part',
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'parts/section-language.php',
                                'posts_per_page' => -1,
                                'orderby' => 'ID',
                                'order' => 'ASC',
                            ]);
                            ?>
                            <?php foreach($languages as $lang_data): ?>
                                <?php $lang = get_field('lang_details', $lang_data->ID); ?>
                                <?php if($lang): ?>
                                    <a href="<?php echo get_page_url_by_lang(get_current_page_slug(), $lang['code'], $lang['home_page']['url']); ?>" class="flex items-center gap-2.5 h-full leading-[1] p-3">
                                        <img src="<?php echo $lang['flag']['url'] ?? $lang['flag']; ?>" alt="lang" class="h-[22px]">
                                        <span class="nav-link <?php echo $current_lang['name'] == $lang['name'] ? 'active' : '' ; ?>">
                                        <?php echo $lang['name']; ?>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
        <!-- E: Menu Desktop -->

        <!-- S: Menu Mobile -->
        <div id="mobile-menus" class="hidden absolute bottom-0 left-0 translate-y-[calc(100%_-_2px)] w-full h-[calc(100vh_-_75px)] bg-[#323232] text-white items-center gap-10 justify-between py-6">
            <ul class="container v-stack !gap-10">
                <?php foreach(get_menus() as $i => $menu): ?>
                    <?php if($menu['children']): ?>
                        <?php $is_active = in_array(get_the_permalink(), array_map(function ($child) { return $child['url']; }, $menu['children'])); ?>
                        <li>
                            <input type="checkbox" <?php echo $is_active ? 'checked' : ''; ?> class="hidden mobile-menus-toggle" id="mobile-menus-<?php echo $i; ?>">
                            <label for="mobile-menus-<?php echo $i; ?>" class="flex items-center justify-between">
                                <div class="nav-link-sm leading-[1] <?php echo $is_active ? 'active' : ''; ?>">
                                    <?php echo $menu['title']; ?>
                                </div>
                                <i class="fas fa-chevron-down text-lg icon"></i>
                            </label>
                            <div class="sub-menu hidden">
                                <ul class="v-stack !gap-8 pt-8 ps-8">
                                    <?php foreach($menu['children'] as $child): ?>
                                        <li class="w-full">
                                            <a href="<?php echo $child['url']; ?>" class="nav-link-sm leading-[1] <?php echo get_the_permalink() === $child['url'] ? 'active' : ''; ?>">
                                                <?php echo $child['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo $menu['url']; ?>" class="nav-link-sm leading-[1] <?php echo get_the_permalink() === $menu['url'] ? 'active' : ''; ?>">
                                <?php echo $menu['title']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <ul class="container flex items-center justify-between">
                <?php foreach($languages as $lang_data): ?>
                    <?php $lang = get_field('lang_details', $lang_data->ID); ?>
                    <?php if($lang): ?>
                        <li>
                            <a href="<?php echo get_page_url_by_lang(get_current_page_slug(), $lang['code'], $lang['home_page']['url']); ?>" class="flex items-center gap-2.5 h-full leading-[1] p-3">
                                <img src="<?php echo $lang['flag']['url'] ?? $lang['flag']; ?>" alt="lang" class="h-[22px]">
                                <span class="nav-link">
                                    <?php echo $lang['name']; ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- E: Menu Mobile -->

        <label for="mobile-menus-checkbox" class="w-[18px] h-[18px] inline-flex lg:hidden flex-col gap-1.5 relative">
            <span class="w-full h-[2px] bg-white absolute left-0 top-0"></span>
            <span class="w-full h-[2px] bg-white absolute left-0 top-[50%] translate-y-[-50%]"></span>
            <span class="w-full h-[2px] bg-white absolute left-0 top-[100%] translate-y-[-100%]"></span>
        </label>

        <a href="<?php echo get_front_page_url(); ?>" class="logo-wrapper">
            <img src="<?php echo get_logo(); ?>" alt="logo" class="h-[40px] logo">
        </a>
    </div>
</header>

<main id="content">