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

	$('.noticias .conteudo .itens').slick({
	  dots: true,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  	nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
	  autoplay: false,
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
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 650,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});
		$('.projetos .conteudo .itens').slick({
	  dots: true,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  	nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
	  autoplay: false,
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
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 650,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	$('.videos .conteudo .itens').slick({
	  dots: true,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  	nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
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
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 570,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	$('.fotos .conteudo .itens').slick({
	  dots: true,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  	nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
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
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 570,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	$('.galery .conteudo .itens').slick({
	  dots: true,
	  arrows: true,
	  prevArrow: '<a class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></a>',
  	nextArrow: '<a class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></a>',
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
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 570,
	      settings: {
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	$('.swipebox').swipebox();
	$('.swipebox-video').swipebox();

      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lc2ZqAqAAAAAMMZzHehIFA4elAOxPpgXErL4VGr', {action: 'submit'}).then(function(token) {
          });
        });
      }	
});


const $loadingBtn = document.querySelector(".btn");
const form = document.querySelector(".form-ajax");

form.addEventListener("submit", (event) => {
  // Verifica se todos os campos obrigatórios estão preenchidos
  const requiredFields = form.querySelectorAll('input[required], textarea[required]');
  const allFieldsFilled = [...requiredFields].every((field) => field.value.trim() !== '');

  if (!allFieldsFilled) {
    event.preventDefault(); // Impede o envio do formulário
    // Opcional: Adicionar uma mensagem de erro ao usuário
    alert('Por favor, preencha todos os campos obrigatórios.');
  } else {
    // Habilita o botão e mostra o loader
    $loadingBtn.classList.add("loading");
  }
});




