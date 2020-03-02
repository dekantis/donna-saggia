jQuery(document).ready(function() {
  //menu
  jQuery(".drop").on("click", function(){
    if(jQuery(this).hasClass("active")){
      jQuery(this).removeClass("active");
      jQuery(this).text("Развернуть опции");
      jQuery(this).next().slideUp()
    }else {
      jQuery(this).addClass("active");
      jQuery(this).text("Свернуть опции");
      jQuery(this).next().slideDown()
    }
  });
  //menu
  jQuery(".mobile-menu").on("click", function(){
    if(jQuery(this).hasClass("active")){
      jQuery(this).removeClass("active");
      jQuery("#navi").removeClass("active");
    }else {
      jQuery(this).addClass("active");
      jQuery("#navi").addClass("active");
    }
  });
  
  
  $(".various").fancybox({
		maxWidth	: 1030,
		maxHeight	: 850,
		fitToView	: false,
		width		: '90%',
		height		: '90%',
		autoSize	: false,
		closeClick	: false,
    padding: [20,25,20,25],
		openEffect	: 'none',
		closeEffect	: 'none',
    afterShow :function(){
       $('.cusrousel-mini').slick({
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              centerPadding: '5px',
            }
          }


        ]
        });
        //event slider
      jQuery(".cusrousel-mini a").click(function(){
        if(!jQuery(this).hasClass("active")){
          jQuery(".cusrousel-mini a").removeClass("active");
          jQuery(this).addClass("active");
          var src = jQuery(this).attr("href");
          jQuery(".big-image img").fadeOut();
          setTimeout(function(){
            jQuery(".big-image img").attr("src",src);
            jQuery(".big-image a").attr("href",src);
          },300)
          jQuery(".big-image img").fadeIn();
        }
        return false;
      })
    }
	});
  //tabs
  jQuery(".tab-list li a").click(function(){
    if(!jQuery(this).parent().hasClass("active")){
      jQuery(this).parents(".tab-list").find("li").removeClass("active");
      jQuery(this).parent().addClass("active");
      var tabBox = jQuery(this).attr("href");
      jQuery(this).parents(".tab-list").next().find(".tab").hide()
      jQuery(tabBox).show();
    }
    return false;
  });

  $(".down").on("click", function(){
    jQuery("html, body").animate({scrollTop : 0},1000);
    return false;
  });
	$('.carousel').flexslider({
    controlNav: false,
    
  });
  
  $('.goods-slider').flexslider({
    controlNav: false,
    slideshow: false,
  });
});

jQuery(window).load(function(){
  setEqualMinHeight(jQuery(".goods"));
  
})
jQuery(window).resize(function(){
  setEqualMinHeight(jQuery(".goods"));
  
})

// EqualHeight
function setEqualMinHeight(columns){
  var tallestcolumn = 0;
  columns.each(function(){
    jQuery(this).css({"height":"auto"});
    currentHeight = jQuery(this).find(".goods-inner").height();
    if(currentHeight > tallestcolumn){
      tallestcolumn = currentHeight;
    }
  });
    columns.css({height: tallestcolumn});
}
