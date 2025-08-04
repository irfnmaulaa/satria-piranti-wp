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
    <?php if(get_field('meta_tags')) foreach(get_field('meta_tags') as $meta_property => $meta_content): ?>
    <?php $value = $meta_content ? $meta_content : $meta_defaults[$meta_property]; ?>
    <meta property="og:<?php echo $meta_property; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= get_the_permalink() ?>">
    <?php if(get_field('meta_tags')) foreach(get_field('meta_tags') as $meta_property => $meta_content): ?>
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

<header id="header" class="navbar fixed top-0 left-0 bg-white z-[20] h-[108px] border-b w-full">
    <div class="max-w-[1448px] mx-auto px-8 h-full flex items-center justify-between">
        <div class="flex items-center gap-12">
            <a href="<?php echo get_front_page_url(); ?>" class="logo-wrapper">
                <img src="<?php echo get_logo(); ?>" alt="logo" class="logo h-[60px]">
            </a>
            <ul class="hidden lg:flex items-center gap-10 h-full text-[18px] font-semibold">
                <?php foreach(get_menus() as $menu): ?>
                    <?php if($menu['children']): ?>
                        <?php $is_active = in_array(get_the_permalink(), array_map(function ($child) { return $child['url']; }, $menu['children'])); ?>
                        <li class="dropdown group relative h-full flex items-center ">
                            <a href="<?php echo $menu['url']; ?>" class="nav-link <?php echo $is_active ? 'active' : ''; ?>">
                                <?php echo $menu['title']; ?>
                            </a>
                            <div class="absolute left-0 bottom-0 translate-y-[calc(100%_-_1.5rem)] min-w-[161px] pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition duration-100">
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
            </ul>
        </div>
        <div>
            Test
        </div>
    </div>
</header>

<main class="mt-[80px] lg:mt-[120px]">