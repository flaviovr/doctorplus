
//jQuery for page scrolling feature - requires jQuery Easing plugin
$(document).ready(function(){
	
    $(window).scroll(function() {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });
 	$('.datepicker').datetimepicker({
                    locale: 'pt-br',
                    format: 'DD/MM/YYYY'
                });
});
moment.locale();
$(window).load(function(){
	
});