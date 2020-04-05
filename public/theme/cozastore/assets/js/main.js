
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });
    /*[ init slick ]
    ===========================================================*/
    function init_slick(sm_thumb) {
        $('.wrap-slick3').each(function(){
            $(this).find('.slick3').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                infinite: true,
                autoplay: false,
                autoplaySpeed: 6000,

                arrows: true,
                appendArrows: $(this).find('.wrap-slick3-arrows'),
                prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                dots: true,
                appendDots: $(this).find('.wrap-slick3-dots'),
                dotsClass:'slick3-dots',
                customPaging: function(slick, index) {
                    var portrait = $(slick.$slides[index]).data('thumb');
                    var portrait = portrait.replace("original",sm_thumb);
                    return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                },  
            });
        });
    }
    var l = window.location.href.split('/');
    if ( (l[4] == '') || (l[4] == 'shop')) {

    }else{
        var sm_thumb = $('.product_image').attr('data-sm');
        init_slick(sm_thumb);
    }
    /*[ load more product ]
    ===========================================================*/
    $('.load-more').click(function(event) {
        var url = $(this).attr('data-url');
        var start = $('.isotope-grid').children('.isotope-item').length;
        var base_url = window.location.origin+'/'+window.location.pathname.split('/')[1]+'/';
        $.ajax({
            url: url,
            type: 'POST',
            data: {st: start},
        })
        .done(function(data) {
            var res = $.parseJSON(data);
            if (res.state == 'fail') {
                alert('error');
            }else{
                var ar_tags = [];
                var ist_tag = '';
                $.each(res, function(index, val) {
                    var tags = $.parseJSON(val.meta_key);
                    $.each(tags, function(i, tag) {
                        var tag = tag.split(',');
                        ist_tag = tag.join(' ');
                        ist_tag = ist_tag.toLowerCase();
                        $.each(tag, function(j, vl) {
                            if ($.inArray(vl, ar_tags) < 0) {
                                ar_tags.push(vl);
                            }
                        });
                    });
                    var di= '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item '+ist_tag+' '+val.catalog_id+' '+val.type_id+'">'+
                                '<div class="block2 '+val.id+'" id="'+val.id+'">'+
                                    '<div class="block2-pic hov-img0">'+
                                        '<img src="'+val.path_img+'" alt="IMG-PRODUCT" data-sm="'+val.sm_thumb+'" class="product_image" data-img="'+val.image_list_entity+'">'+
                                        '<a href="javascript:void(0)" class="qick-view block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">'+
                                            'Quick View'+
                                        '</a>'+
                                    '</div>'+
                                    '<div class="block2-txt flex-w flex-t p-t-14">'+
                                        '<div class="block2-txt-child1 flex-col-l ">'+
                                            '<a href="'+base_url+val.title+'-v'+val.id+'.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 product_name">'+
                                                val.name+
                                            '</a>'+
                                            '<span class="stext-105 cl3 product_price">'+
                                                val.price+
                                            '</span>'+
                                            '<span class="dis-none product_meta_desc">'+val.meta_desc+'</span>'+
                                            '<span class="dis-none product_size">'+val.attb.size+'</span>'+
                                            '<span class="dis-none product_color">'+val.attb.name+'</span>'+
                                            '<span class="dis-none product_code">'+val.attb.code+'</span>'+
                                        '</div>'+
                                        '<div class="block2-txt-child2 flex-r p-t-3">'+
                                            '<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">'+
                                                '<img class="icon-heart1 dis-block trans-04" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAQCAYAAAD0xERiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Qjk4NEU4QTRGRjdFMTFFNzk4NDhERjk0Mjk4N0E5MjQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Qjk4NEU4QTVGRjdFMTFFNzk4NDhERjk0Mjk4N0E5MjQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpCOTg0RThBMkZGN0UxMUU3OTg0OERGOTQyOTg3QTkyNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpCOTg0RThBM0ZGN0UxMUU3OTg0OERGOTQyOTg3QTkyNCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PrPPoIsAAAFdSURBVHjanNQ/KIRxHMfxxzlyZLlVSpIYsNBZdBYGwxmVUiIGw5EVpQwWZcUghcEg9AwYJZMU0Y0MMl0sFlyH968+9/Tr8Zy7nm+96p77Pd/PPc/vz1W4ruv4qgbNeMez87caUY9HfNgDEetzDGvI4hwZ3CGp8aSuMxrP6v6YP6wap2hHl349jnWcqOlY13GNd+r+M/V7YbOoREqPbyqHHQyrMaXrnMaf9F1E/V7YJJaRD5ijCwziMmAsr76pQph5xFbcOOHK9LWgyoR94RO1IcPqtKq5wms+oDtkWA/u7Tk7wnjIsAmtuBe2iT5rT5VbQ0hgww57xRz20FRmUBt2MYM3/wnYxxau0FEiKKEts4rDoONkagVL2lNpbWS7zDZa0HFK62Q4xcJMbaMfY9pDI1r+aZ3LAfTiwN8YLfIat3qVUSxqLq8xD/M38xPUFP1nXr4VYjTgpdSK/AowAJcYR6wGbjGmAAAAAElFTkSuQmCC" alt="ICON">'+
                                                '<img class="icon-heart2 dis-block trans-04 ab-t-l" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAQCAYAAAD0xERiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QzhBNzdENTBGRjdFMTFFN0EzMTVGQjhCRTU3NjZBQkUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QzhBNzdENTFGRjdFMTFFN0EzMTVGQjhCRTU3NjZBQkUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpDOEE3N0Q0RUZGN0UxMUU3QTMxNUZCOEJFNTc2NkFCRSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpDOEE3N0Q0RkZGN0UxMUU3QTMxNUZCOEJFNTc2NkFCRSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PktrfMIAAAEXSURBVHjaYkwvucqABjiAWAmIPwPxYwZMIAvEvEB8D4h/IEswIbE5gbgHiN8AMciGR0B8EYjtofL2UP4jqPwbqHpOmAEsUJoNiLcjaYQBPSDeA8QTgTgPiFmR5LiBuBiITYHYFYh/wVyWj8UgZAuL0QxCBnZQ/XBvJjNQBlJhhoG8qEahYSogl4MM+wXEPyk0DBSrv2HevEKhYZeRw2w9hYZtRDZsJhC/JdOg10A8A9mwt7DoJRH8B+JMIH6HngOWAnEdiQaVAfFabNkJBJqhae4XAYO+AXEkNDsx4DIMBOYBsTkQn8Fh0EEgNgbilegSTDg0XIAaGIuUbI4DsT8QOwLxDVz5Dhf4B8RLoFgaiJ8SCkSAAAMADAU1xygo4wwAAAAASUVORK5CYII=" alt="ICON">'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>',
                    newItems = $(di).appendTo('.isotope-grid');
                    newItems.imagesLoaded( function() {
                        $('.isotope-grid').isotope('appended', newItems );
                    });
                });
                var x = $('.tags_product button').map(function(){
                           return $.trim($(this).text());
                        }).get();
                $.each(ar_tags, function(i, value) {
                    if ($.inArray(value, x) < 0) {
                        value = value.trim();
                        $('.tags_product').append('<button data-filter=".'+value+'" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">'+value+'</button>')
                    }
                });
            }
        })
        .fail(function() {
            console.log("error");
        })
        
    });
    /*[ quick view product ]
    ===========================================================*/
    var i = 1;
    $('body').on('click','.qick-view', function(){
        if (i > 1) {     
            $('.slick3').slick('unslick');
        }
        var $this   = $(this).parents('.block2'),
            name    = $this.find('.product_name').text(),
            price   = $this.find('.product_price').html(),
            desc    = $this.find('.product_meta_desc').text();
            size    = $this.find('.product_size').text(),
            color   = $this.find('.product_color').text(),
            code    = $this.find('.product_code').text(),
            path    = $this.find('.product_image').attr('src');
        var image   = $this.find('.product_image').attr('data-img');
        var sm_thumb= $this.find('.product_image').attr('data-sm');
        $('.js-modal1').find('.product_name').text(name);
        $('.js-modal1').find('.product_price').html(price);
        $('.js-modal1').find('.product_meta_desc').text(desc);

        var arr_size = [],
            size = size.trim().split('|'),
            size = size[0].split(',');
        $.each(size, function(index, val) {
            var item_size = '<option>Size '+val+'</option>';
            arr_size.push(item_size);
        });
        $('.js-modal1').find('.product_siz').html(arr_size);

        var arr_color = [],
            color = color.trim().split('|'),
            color_list = color[0].split(',');
        $.each(color_list, function(index, val) {
            var item_color = '<option>'+val+'</option>';
            arr_color.push(item_color);
        });
        $('.js-modal1').find('.product_clr').html(arr_color);

        var image_1 = image.split('|')[0],
            image_1 = $.parseJSON(image_1),
            path = path.replace(/[^\/]*$/, ""),
            x = path.split('/')[6],
            path = path.replace(x, "original");
        
        $('.js-modal1').find('.product_image').attr('src', path+image_1[0]);
        var arr_image = [];
        $.each(image_1, function(index, val) {
            var item_image =    '<div class="item-slick3" data-thumb="'+path+val+'" >'+
                                    '<div class="wrap-pic-w pos-relative">'+
                                        '<img class="product_image" src="'+path+val+'" alt="IMG-PRODUCT">'+
                                        '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+path+val+'">'+
                                            '<i class="fa fa-expand"></i>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
            arr_image.push(item_image);
        });
        $('.js-modal1').find('.gallery-lb').html(arr_image);

        var arr_code = [],
            code = code.trim().split('|');
        $.each(code, function(index, val) {
            var data_img = image.split('|')[index];
            var data_img = $.parseJSON(data_img);
            if (index == 0) {
                var pointer = 'pointer-none op-05';
            }else{
                var pointer = 'pointer';
            }
            var item_code = '<li class="p-b-6 get_atb '+pointer+'" >'+
                                '<span class="fs-15 lh-12 m-r-6" style="color: '+val+';">'+
                                    '<i class="zmdi zmdi-circle"></i>'+
                                '</span>'+
                            '</li>';
            arr_code.push(item_code);
        });
        $('.js-modal1').find('.product_code').html(arr_code);

        $('.js-modal1').find('.js-addcart-detail').attr('id',$this.attr('id'));
        /* show modal */
        $('.js-modal1').addClass('show-modal1');
        init_slick(sm_thumb);
        i++;
    });
    /*[ change view detail image in qick view product ]
    ===========================================================*/
    $('body').on('click','.get_atb', function(){
        $(this).parents('.product_code').find('.pointer-none').addClass('pointer').removeClass('pointer-none op-05');
        $(this).addClass('pointer-none op-05').removeClass('pointer');
        $('.slick3').slick('unslick');
        var $this   = $(this),
            id      = $this.parents('.row').find('.js-addcart-detail').attr('id'),
            index   = $this.index(),
            parent  = $('.'+id),
            size    = parent.find('.product_size').text(),
            color   = parent.find('.product_color').text().trim().split('|'),
            img     = parent.find('.product_image').attr('data-img'),
            img     = $.parseJSON(img.split('|')[index]);
        var path    = parent.find('.product_image').attr('src');
        if (path == undefined) {
            var se = 'image_detail';
            path = parent.find('.image_detail').attr('src');
        }else{
            var se = 'product_image';
        }
        var path    = path.replace(/[^\/]*$/, ""),
            nxn     = path.split('/')[6],
            old_cl  = path.split('/')[8],
            path     = path.replace(nxn, "original"),
            path     = path.replace(old_cl, color[index]),
            sm_thumb = parent.find('.product_image').attr('data-sm'),
            arr_img  = [],
            arr_color= [],
            arr_size = [];
        $.each(img, function(index, val) {
            var item_img =    '<div class="item-slick3" data-thumb="'+path+val+'" >'+
                                    '<div class="wrap-pic-w pos-relative">'+
                                        '<img class="'+se+'" src="'+path+val+'" alt="IMG-PRODUCT">'+
                                        '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+path+val+'">'+
                                            '<i class="fa fa-expand"></i>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>';
            arr_img.push(item_img);
        });
        $('.js-modal1').find('.gallery-lb').html(arr_img);

        size = size.trim().split('|'),
        size = size[index].split(',');
        $.each(size, function(index, val) {
            var item_size = '<option>Size '+val+'</option>';
            arr_size.push(item_size);
        });
        $('.js-modal1').find('.product_siz').html(arr_size);

        color = color[index].split(',');
        $.each(color, function(index, val) {
            var item_color = '<option>'+val+'</option>';
            arr_color.push(item_color);
        });
        $('.js-modal1').find('.product_clr').html(arr_color);

        /* init slick again*/
        init_slick(sm_thumb);
    });
    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter'),
            filterValue = filterValue.replace(/ /g,'-'),
            filterValue = filterValue.toLowerCase();
            $topeContainer.isotope({ filter: filterValue });
        });
        
    });
    $('[data-sort]').click( function( event ) {
        event.preventDefault();
        $('[data-sort]').removeClass('filter-link-active');
        $(this).addClass('filter-link-active');
        var sort = $(this).attr('data-sort');
            sort = $.parseJSON(sort);
        $topeContainer.isotope(sort);
    });

    // init Isotope
    $(window).on('load', function () {
        if (window.location.search.substr(1)) {
            var id = '.'+window.location.search.substr(1);
            $topeContainer.isotope({ filter: id });
            $('.filter-tope-group button').removeClass('how-active1');
            $("[data-filter='"+id+"']").addClass('how-active1');
        }else{
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    getSortData: {
                        product_price: function( itemElem ) {
                            var price = $( itemElem ).find('.product_price').clone().children().remove().end().text();
                            price = price.replace('.vnđ', '');
                            price = price.replace(/,/g,'').trim();
                            return parseFloat(price);
                        }
                    }
                });
            });
            
        }
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    
    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });
})(jQuery);