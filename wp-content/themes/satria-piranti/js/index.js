const $ = jQuery

$(document).ready(function() {

    // Track which counters have already animated
    const animatedCounters = new Set();

    let heroBg, currentSlideshowIndex = 0, slideshowTimeout
    function updatePage() {
        heroBg = $('.hero-bg')

        $('.modal-close').click(function (e) {
            e.preventDefault()
            $('.product-modal').css({
                opacity: 0,
                pointerEvents: 'none',
            })
            $('html,body').css({
                overflowY: 'auto'
            })
        })

        $('.product-item').click(function (e) {
            e.preventDefault()
            const image = $(this).data('image-url')

            $('.product-modal .product-modal-image').attr('src', image)
            $('.product-modal').css({
                opacity: 1,
                pointerEvents: 'unset',
            })
            $('html,body').css({
                overflowY: 'hidden'
            })
        })

        $('.product-modal').click(function (e) {
            if($(e.target).hasClass('product-modal')) {
                $('.product-modal').css({
                    opacity: 0,
                    pointerEvents: 'none',
                })
                $('html,body').css({
                    overflowY: 'auto'
                })
            }
        })

        $('.hero-nav-item').click(function(e) {
            e.preventDefault()
            const target = $(this).data('target-index')
            slideshowGoToIndex(target)
        })
        slideshowGoToIndex(0)

        updateOurProjectsSection()

        animatedCounters.clear()
        $(window).on('scroll load', checkCountersInView);

    }
    updatePage()

    function slideshowGoToIndex(index) {
        $('.background-slideshow-image').removeClass('active')
        $(`#background-slideshow-image-${index}`).addClass('active')

        $('.hero-nav-item').removeClass('active')
        $(`#hero-nav-item-${index}`).addClass('active')

        currentSlideshowIndex = parseInt(index, 10)
        const nextTarget = currentSlideshowIndex + 1 > $('.hero-nav-item').length - 1 ? 0 : currentSlideshowIndex + 1

        if(slideshowTimeout) {
            clearTimeout(slideshowTimeout)
        }
        slideshowTimeout = setTimeout(() => {
            slideshowGoToIndex(nextTarget)
        }, 4000)
    }

    $(window).keydown(function (e) {
        if(e.key === 'Escape') {
            $('.product-modal').css({
                opacity: 0,
                pointerEvents: 'none',
            })
        }
    })

    let lastScrollY = 0
    $(window).scroll(function () {
        const scrollTop = $(window).scrollTop()

        if (scrollTop > 50 && scrollTop > lastScrollY){
            $('#header').addClass('hide')
        } else {
            if (scrollTop > 100) {
                $('.navbar').addClass('border-b border-[#F5F5F5]')
                $('.navbar-dark').addClass('on-scrolling')
            } else {
                $('.navbar').removeClass('border-b border-[#F5F5F5]')
                $('.navbar-dark').removeClass('on-scrolling')
            }
            $('#header').removeClass('hide')
        }
        lastScrollY = scrollTop

        if(heroBg && heroBg.parents('div').length > 0) {
            const heroBgSpace = heroBg.parents('div').offset().left * 2 + 50
            const maxScaled = heroBgSpace / heroBg.parents('div').width()

            let scale = 1 + Math.min($(window).scrollTop() * (1/500), maxScaled)

            heroBg.css({
                transform: `scale(${scale})`,
                transformOrigin: 'bottom'
            })
        }
    })

    $('body').delegate('a', 'click', function (e) {
        const target = $(this).attr('href')
        if(target.search('#') > -1 && $(target.substring(target.search('#'))).length > 0) {
            e.preventDefault()

            const targetSelector = target.substring(target.search('#'))

            goToSection(targetSelector, 0, function() {
                history.pushState(null, null, target);
            })
        } else if($(e.target).hasClass('tab-item')) {
            e.preventDefault()
            const targetCategory = $(e.target).data('target')
            if(targetCategory) {
                $('.product-item,.category-description').css({
                    display: 'none'
                })
                $(`.product-item[data-category="${targetCategory}"], .category-description[data-category="${targetCategory}"]`).css({
                    display: 'block'
                })
            } else {
                $('.product-item').css({
                    display: 'block'
                })
                $('.category-description').css({
                    display: 'none'
                })
                $('.category-description.category-description-all').css({
                    display: 'block'
                })
            }
            $('#product-list .tab-item').removeClass('active')
            $(e.target).addClass('active')
            window.history.pushState({}, '', $(e.target).attr('href'))
        } else if(new URL(target).origin === window.location.origin) {
            e.preventDefault()
            if ($('#loader').hasClass('active')) return

            $('#loader').addClass('active')

            window.history.pushState({}, '', target)

            setTimeout(() =>  {
                $.ajax({
                    url: target,
                    method: 'POST',
                    data: {is_ajax: true},
                    success: function(response) {
                        // hide menu on mobile
                        $('#mobile-menus-checkbox').prop('checked', false)

                        $('#content').html(response)

                        updatePage()

                        window.scrollTo(0,0)
                        setTimeout(() => {
                            $('#loader').removeClass('active')
                        }, 200)
                    }
                })
            }, 300)
        }
    })

    function goToSection(targetSelector, min=0, callback) {
        if(targetSelector)
            var offset = 90; // Adjust this value based on your needs

        if ($(window).width() <= 1020) {
            offset = 92;
        }

        offset += min

        if($(targetSelector).length > 0) {
            $('html, body').animate({
                scrollTop: $(targetSelector).offset().top - offset
            }, 0, callback);
        }
    }

    function updateOurProjectsSection() {

        // initial
        let activeIndex = 0
        setProjectActive(activeIndex)

        // listener
        $('.project-item').click(function(e) {
            e.preventDefault()
            activeIndex = $(this).data('index')
            setProjectActive(activeIndex)
        })

        $('.project-nav-prev').click(function (e) {
            e.preventDefault()
            if (activeIndex > 0) {
                activeIndex -= 1
                setProjectActive(activeIndex)
            }
        })

        $('.project-nav-next').click(function (e) {
            e.preventDefault()
            if (activeIndex < $('.project-item').length - 1) {
                activeIndex += 1
                setProjectActive(activeIndex)
            }
        })
    }

    function setProjectActive(activeIndex) {
        const items = $('.project-item')
        const activeItem = items.eq(activeIndex)

        items.removeClass('active')
        activeItem.addClass('active')

        const videoUrl = activeItem.data('video-url')
        const imageUrl = activeItem.data('image-url')

        if (videoUrl) {
            $('.project-display').html(`
                <div class="relative h-full w-full">
                    <video width="420" class="w-full rounded-[20px] h-full object-cover object-center" controls playsinline poster="${ imageUrl || '' }">
                        <source src="${ videoUrl }" type="video/mp4">
                    </video>
                    <div class="project-display-control group cursor-pointer bg-[#323232CC] w-full h-full absolute left-0 top-0 flex items-center justify-center">
                        <button class="w-[100px] aspect-[1/1] cursor-pointer rounded-full border-3 group-hover:bg-white group-hover:text-[#323232CC] transition duration-200 border-white flex items-center justify-center text-white text-[32px]">
                            <i class="fa fa-play"/>
                        </button>
                    </div>
                </div>
            `)

            $('.project-display').find('.project-display-control').click(function (e) {
                e.preventDefault()
                $('.project-display').find('video')[0].play()
            })

            $('.project-display').find('video').on('play', function (e) {
                $('.project-display').find('.project-display-control').css({
                    opacity: '0',
                    pointerEvents: 'none',
                })
            })

            $('.project-display').find('video').on('pause', function (e) {
                $('.project-display').find('.project-display-control').css({
                    opacity: '100',
                    pointerEvents: 'unset',
                })
            })
        } else if (imageUrl) {
            $('.project-display').html(`
                <img src="${ imageUrl }" alt="image" class="w-full rounded-[20px] h-full object-cover object-center">
            `)
        }

        if(activeIndex <= 0) {
            $('.project-nav-prev').addClass('disabled')
        } else {
            $('.project-nav-prev').removeClass('disabled')
        }

        if(activeIndex >= items.length - 1) {
            $('.project-nav-next').addClass('disabled')
        } else {
            $('.project-nav-next').removeClass('disabled')
        }
    }

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    function animateCounter($el, target) {
        let duration = 1500; // in ms
        let startTime = null;

        function updateCounter(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const current = Math.floor(progress * target);
            $el.text(current.toLocaleString('en-US'));
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                $el.text(target.toLocaleString('en-US')); // final fix
            }
        }

        requestAnimationFrame(updateCounter);
    }

    function checkCountersInView() {
        $('.counter').each(function () {
            const $el = $(this);
            const id = $el.index('.counter'); // unique-ish key for tracking
            if (!animatedCounters.has(id) && isInViewport(this)) {
                const target = BigInt($el.data('target'));
                if (target <= Number.MAX_SAFE_INTEGER) {
                    animateCounter($el, Number(target));
                } else {
                    $el.text(target.toString()); // Fallback for huge numbers
                }
                animatedCounters.add(id);
            }
        });
    }
})