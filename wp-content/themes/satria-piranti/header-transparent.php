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

<header id="header" class="navbar navbar-dark fixed top-0 left-0 bg-transparent z-[20] h-[80px] md:h-[108px] w-full">
    <div class="max-w-[1448px] mx-auto px-4 md:px-8 h-full flex items-center justify-between">
        <div class="flex items-center gap-12 h-full">
            <a href="<?php echo get_front_page_url(); ?>" class="logo-wrapper">
                <img src="<?php echo get_logo(); ?>" alt="logo" class="logo h-[40px] md:h-[60px]">
            </a>

            <!-- S: Left Menu -->
            <ul class="hidden lg:flex items-center h-full text-[18px] font-semibold">
                <?php 
                $menus = get_menus();  

                $left_menus = [];
                foreach($menus as $i => $menu) {
                    if($i < 5) {
                        $left_menus[] = $menu;
                    } else {
                        $right_menus[] = $menu;
                    }
                }
                
                foreach($left_menus as $menu): ?>
                    <?php if($menu['children']): ?>
                        <?php 
                        $is_active = in_array(get_the_permalink(), array_map(function ($child) { return $child['url']; }, $menu['children']));
                        // Check if any child menu has its own children (grandchildren)
                        $has_grandchildren = false;
                        foreach($menu['children'] as $child) {
                            if(isset($child['children']) && !empty($child['children'])) {
                                $has_grandchildren = true;
                                break;
                            }
                        }
                        ?>
                        <li class="dropdown group <?php echo !$has_grandchildren ? 'relative' : ''; ?> h-full flex items-center">
                            <a href="<?php echo $menu['url']; ?>" class="nav-link h-full flex items-center justify-center gap-2 px-5 text-white <?php echo $is_active ? 'active' : ''; ?>">
                                <?php echo $menu['title']; ?>
                                <i class="fas fa-chevron-down text-sm transition-transform group-hover:rotate-180"></i> 
                            </a>

                            <?php if($has_grandchildren): ?>
                            <div class="absolute left-0 bottom-0 translate-y-[100%] w-full pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition duration-100">
                                <div class="w-full p-10 bg-white shadow">
                                    <div class="flex flex-col items-center gap-5 w-full max-w-[1448px] mx-auto px-8">
                                        <div class="w-full inline-flex items-start gap-10">
                                            <?php foreach(array_values($menu['children']) as $i => $child): ?>

                                                <?php if($i == 0): ?>
                                                    <div class="flex-1 inline-flex flex-col items-start gap-5 border-r">
                                                        <div class="w-full inline-flex items-center gap-14">
                                                            <div class="flex-1 inline-flex flex-col items-start gap-6">
                                                                <div class="w-full text-black text-lg font-semibold font-plus-jakarta-sans leading-7"><?php echo $child['title']; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="w-full flex flex-col items-start gap-5">
                                                            <div class="w-full grid grid-cols-3 gap-8">
                                                                <?php foreach($child['children'] as $grandchild): ?>
                                                                <a href="<?php echo $grandchild['url']; ?>" class="flex items-center gap-6">
                                                                    <div class="w-14 h-14 bg-slate-50 flex justify-center items-center">
                                                                    <?php
                                                                    // Get post ID from menu URL
                                                                    $post_id = url_to_postid($grandchild['url']);
                                                                    $thumbnail_id = get_post_thumbnail_id($post_id);

                                                                    if ($thumbnail_id) {
                                                                        $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
                                                                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                                                        ?>
                                                                        <img src="<?php echo esc_url($thumbnail[0]); ?>" 
                                                                            alt="<?php echo esc_attr($alt_text); ?>"
                                                                            class="w-full h-full object-cover">
                                                                    <?php } else { ?>
                                                                        <img src="<?php echo get_template_directory_uri() . '/img/placeholder.png'; ?>" 
                                                                            alt="no image"
                                                                            class="w-full h-full object-cover">
                                                                    <?php } ?>
                                                                    </div>
                                                                    <span class="text-black text-base font-normal font-plus-jakarta-sans"><?php echo $grandchild['title']; ?></span>
                                                                </a>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                <?php elseif($i == 1): ?>
                                                <div class="w-96 inline-flex flex-col items-start gap-5">
                                                    <div class="inline-flex items-center gap-14">
                                                        <div class="inline-flex flex-col items-start gap-6">
                                                            <div class="text-black text-lg font-semibold font-plus-jakarta-sans leading-7"><?php echo $child['title']; ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col items-start gap-5">
                                                        <?php foreach($child['children'] as $grandchild): ?>
                                                            <a href="<?php echo $grandchild['url']; ?>" class="flex items-center gap-6">
                                                                <div class="w-14 h-14 bg-slate-50 flex justify-center items-center">
                                                                <?php
                                                                // Get post ID from menu URL
                                                                $post_id = url_to_postid($grandchild['url']);
                                                                $thumbnail_id = get_post_thumbnail_id($post_id);

                                                                if ($thumbnail_id) {
                                                                    $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
                                                                    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                                                    ?>
                                                                    <img src="<?php echo esc_url($thumbnail[0]); ?>" 
                                                                        alt="<?php echo esc_attr($alt_text); ?>"
                                                                        class="w-full h-full object-cover">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo get_template_directory_uri() . '/img/placeholder.png'; ?>" 
                                                                        alt="no image"
                                                                        class="w-full h-full object-cover">
                                                                <?php } ?>
                                                                </div>
                                                                <span class="text-black text-base font-normal font-plus-jakarta-sans"><?php echo $grandchild['title']; ?></span>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                
                                            <?php endforeach; ?> 
                                        </div>
                                        
                                        <div class="w-full h-px border-t border-slate-200"></div>
                                        
                                        <div class="w-full inline-flex items-center gap-14">
                                            <div class="flex-1 inline-flex flex-col items-start gap-6">
                                                <p class="text-black text-lg font-normal font-plus-jakarta-sans leading-7">
                                                    Temukan berbagai forklift seperti Diesel, Electric, Reach Truck, dan Pallet Stacker untuk mendukung produktivitas
                                                </p>
                                            </div>
                                            
                                            <?php 
                                            $last_child = end($menu['children']);
                                            if (count($menu['children']) >= 2 && $last_child): ?>
                                            <a href="<?php echo $last_child['url']; ?>" class="px-6 py-3 bg-teal-800 rounded-lg flex items-center gap-3">
                                                <span class="text-white text-base font-bold font-plus-jakarta-sans"><?php echo $last_child['title']; ?></span>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.svg" alt="arrow-right">
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                                <div class="absolute left-0 bottom-0 translate-y-[100%] min-w-[161px] pointer-events-none group-hover:pointer-events-auto opacity-0 group-hover:opacity-100 transition duration-100">
                                    <div class="w-80 p-10 bg-white shadow flex flex-col items-center gap-5">
                                        <div class="w-full flex items-start gap-10">
                                            <div class="flex-1 flex flex-col items-start gap-5">
                                                <div class="flex flex-col items-start gap-5">
                                                    <?php foreach($menu['children'] as $child): ?>
                                                    <a href="<?php echo $child['url']; ?>" class="w-full bg-white flex items-center gap-6">
                                                        <div class="w-14 h-14 bg-slate-50 flex justify-center items-center">
                                                        <?php
                                                        // Get post ID from menu URL
                                                        $post_id = url_to_postid($child['url']);
                                                        $thumbnail_id = get_post_thumbnail_id($post_id);

                                                        if ($thumbnail_id) {
                                                            $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
                                                            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                                            ?>
                                                            <img src="<?php echo esc_url($thumbnail[0]); ?>" 
                                                                alt="<?php echo esc_attr($alt_text); ?>"
                                                                class="w-full h-full object-cover">
                                                        <?php } else { ?>
                                                            <img src="<?php echo get_template_directory_uri() . '/img/placeholder.png'; ?>" 
                                                                alt="no image"
                                                                class="w-full h-full object-cover">
                                                        <?php } ?>
                                                        </div>
                                                        <span class="text-black text-base font-normal font-plus-jakarta-sans"><?php echo $child['title']; ?></span>
                                                    </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?> 
                        </li>
                    <?php else: ?>
                        <li class="h-full">
                            <a href="<?php echo $menu['url']; ?>" class="nav-link h-full flex items-center justify-center px-5 text-white <?php echo get_the_permalink() === $menu['url'] ? 'active' : ''; ?>">
                                <?php echo $menu['title']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <!-- S: Left Menu -->
        </div>

        <!-- S: Right Menu -->
        <div>
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden flex items-center justify-center w-10 h-10 focus:outline-none">
                <svg id="hamburger-icon" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <ul class="hidden lg:flex items-center gap-10 h-full text-[18px] font-semibold text-white">
                <?php  
                foreach($right_menus as $i => $menu): ?>
                    <?php if($i === count($right_menus) - 1): ?>
                        <a href="<?php echo $menu['url']; ?>" class="inline-flex items-center gap-3 px-6 py-3 bg-[#F26B4A] rounded-lg">
                            <span class="text-white text-base font-bold font-plus-jakarta-sans"><?php echo $menu['title']; ?></span>
                        </a>
                    <?php else: ?> 
                        <div class="relative group">
                            <button id="language-button" class="relative inline-flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer select-none" onclick="toggleDropdown()">
                                <div class="w-4 h-4 relative">
                                    <img id="language-flag" src="<?php echo get_template_directory_uri(); ?>/img/indonesia.png" alt="language flag">
                                </div>
                                <span id="selected-language" class="text-lg font-semibold font-plus-jakarta-sans">
                                    <span class="nav-link text-white inline-flex gap-2 items-center">Indonesia <i class="fas fa-chevron-down text-sm"></i></span> 
                                </span> 
                            </button>
                            <div id="language-dropdown" class="hidden absolute top-full mt-2 w-full bg-white rounded-xl border border-slate-200 overflow-hidden">
                                <div class="py-1">
                                    <button class="w-full px-4 py-2 text-left hover:bg-slate-50 text-black text-lg font-semibold inline-flex items-center gap-3" onclick="changeLanguage('id', 'Indonesia')">
                                        <div class="w-4 h-4 relative">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/indonesia.png" alt="indonesia flag">
                                        </div>
                                        Indonesia
                                    </button>
                                    <button class="w-full px-4 py-2 text-left hover:bg-slate-50 text-black text-lg font-semibold inline-flex items-center gap-3" onclick="changeLanguage('en', 'English')">
                                        <div class="w-4 h-4 relative">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/united-kingdom.png" alt="english flag">
                                        </div>
                                        English
                                    </button>
                                </div>
                            </div>
                            <script>
                                function toggleDropdown() {
                                    const dropdown = document.getElementById('language-dropdown');
                                    const arrow = document.getElementById('dropdown-arrow');
                                    dropdown.classList.toggle('hidden');
                                    arrow.style.transform = dropdown.classList.contains('hidden') ? '' : 'rotate(180deg)';
                                }

                                function changeLanguage(lang, text) {
                                    const flagImg = document.getElementById('language-flag');
                                    const selectedText = document.getElementById('selected-language');
                                    const templateUrl = '<?php echo get_template_directory_uri(); ?>';
                                    
                                    flagImg.src = templateUrl + '/img/' + (lang === 'en' ? 'united-kingdom.png' : 'indonesia.png');
                                    flagImg.alt = lang === 'en' ? 'english' : 'indonesia';
                                    selectedText.textContent = text;
                                    
                                    toggleDropdown();
                                }

                                // Close dropdown when clicking outside
                                document.addEventListener('click', function(event) {
                                    const dropdown = document.getElementById('language-dropdown');
                                    const button = document.getElementById('language-button');
                                    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                        dropdown.classList.add('hidden');
                                        document.getElementById('dropdown-arrow').style.transform = '';
                                    }
                                });
                            </script>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- E: Right Menu -->

    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed top-[80px] left-0 w-full bg-white rounded-b-2xl shadow-lg transform transition-transform duration-300 ease-in-out translate-y-[-150%] z-[19]">
    <div class="p-6 max-h-[80vh] overflow-y-auto">
        <ul class="flex flex-col space-y-4">
            <?php foreach($left_menus as $menu): ?>
                <?php if($menu['children']): ?>
                    <li class="mobile-dropdown">
                        <div class="flex justify-between items-center py-2">
                            <a href="<?php echo $menu['url']; ?>" class="text-black text-lg font-semibold">
                                <?php echo $menu['title']; ?>
                            </a>
                            <button class="mobile-dropdown-toggle p-2">
                                <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                        <ul class="mobile-dropdown-menu hidden pl-4 mt-2 space-y-2">
                            <?php foreach($menu['children'] as $child): ?>
                                <li>
                                    <a href="<?php echo $child['url']; ?>" class="block py-2 text-black text-base">
                                        <?php echo $child['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo $menu['url']; ?>" class="block py-2 text-black text-lg font-semibold">
                            <?php echo $menu['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php foreach($right_menus as $i => $menu): ?>
                <?php if($i === count($right_menus) - 1): ?>
                    <li class="pt-4">
                        <a href="<?php echo $menu['url']; ?>" class="inline-flex items-center gap-3 px-6 py-3 bg-[#F26B4A] rounded-lg w-full justify-center">
                            <span class="text-white text-base font-bold font-plus-jakarta-sans"><?php echo $menu['title']; ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
        
        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', function() {
            if (mobileMenu.classList.contains('translate-y-[-150%]')) {
                mobileMenu.classList.remove('translate-y-[-150%]');
                mobileMenu.classList.add('translate-y-0');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('translate-y-[-150%]');
                mobileMenu.classList.remove('translate-y-0');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
        
        // Toggle dropdown menus in mobile view
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const dropdownMenu = this.parentElement.nextElementSibling;
                const arrow = this.querySelector('svg');
                
                if (dropdownMenu.classList.contains('hidden')) {
                    dropdownMenu.classList.remove('hidden');
                    arrow.classList.add('rotate-180');
                } else {
                    dropdownMenu.classList.add('hidden');
                    arrow.classList.remove('rotate-180');
                }
            });
        });
    });
</script>

<main>