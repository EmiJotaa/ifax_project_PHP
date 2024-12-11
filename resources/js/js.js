$(document).ready(function(){
	$('.btn-nav').on('click', function()
	{
		$('.menu').toggleClass('active');
		$('.btn-nav i').toggleClass('fa-bars-staggered fa-close');
	});

	$('.slider_banner .conteudo .itens').slick(
	{
  		infinite: true,
  		slidesToShow: 1,
  		slidesToScroll: 1,
  		dots: false,
  		autoplay: true,
  		autoplaySpeed: 5000,
  		arrows: true,
  		prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  		nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>'
	});


	$('.videos .conteudo .itens').slick({
	  dots: true,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 5000,
	  infinite: true,
	  speed: 500,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	
	$('.avaliacoes .conteudo .itens').slick(
	{
  		infinite: true,
  		slidesToShow: 1,
  		slidesToScroll: 1,
  		dots: false,
  		autoplay: true,
  		autoplaySpeed: 5000,
  		arrows: true,
  		prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  		nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>'
	});


	$('.logos .conteudo .itens').slick({
	  dots: false,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
      nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
	  autoplay: true,
	  autoplaySpeed: 5000,
	  infinite: true,
	  speed: 500,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 4
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 2
	      }
	    }
	  ]
	});


	$('.noticias .conteudo .itens').slick({
	  dots: true,
	  arrows: false,
	  autoplay: true,
	  autoplaySpeed: 5000,
	  infinite: true,
	  speed: 500,
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

});