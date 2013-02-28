			$(document).ready(function() {
//				$('#postshare_wrapper').stickyScroll({ container: '.eventos_content' });
			});



			$(document).ready(function () {  
				  var top = $('#postshare_wrapper').offset().top - parseFloat($('#postshare_wrapper').css('marginTop').replace(/auto/, 0));
				  $(window).scroll(function (event) {
				    // what the y position of the scroll is
				    var y = $(this).scrollTop();
				  
				    // whether that's below the form
				    if (y >= top) {
				      // if so, ad the fixed class
				      $('#postshare_wrapper').addClass('fixed');
				    } else {
				      // otherwise remove it
				      $('#postshare_wrapper').removeClass('fixed');
				    }
				  });
				});