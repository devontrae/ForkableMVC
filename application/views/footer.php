<div id="contactform">
		<h1>Reach Out To Us!</h1>
		<div id="contactform-left">
				<div id="contactform-details">
						<div id="contactform-details-companyname" class="contactform-detail">
							<img src=""> <span class="detailspan">Opalite Property Loss Consultants</span>
						</div>
						<div id="contactform-details-address" class="contactform-detail">
								<img src=""> <span class="detailspan">100 West Hidden Valley Boulevard Apt. 102, Boca Raton Fl 33487</span>
						</div>
						<div id="contactform-details-phone" class="contactform-detail">
							<img src=""> <span class="detailspan">954-282-9641</span>
						</div>
						<div id="contactform-details-email" class="contactform-detail">
							<img src=""> <span class="detailspan">contact@opalitepropertyloss.com</span>
						</div>
				</div>
		</div>
		<div id="contactform-right">
				<h3>OR, via this Contact Form</h3>
				<form id="opalite-contact-form" method="post">
					<input id="contact-form-name" type="text" name="name" placeholder="Name" />
					<input id="contact-form-email" type="text" name="email" placeholder="E-Mail" />
					<input id="contact-form-phone" type="text" name="phone" placeholder="Your Phone #" />
					<textarea id="contact-form-details" name="message" placeholder="Please provide a brief description of your loss."></textarea>
					<button id="contact-form-send">SEND</button>
				</form>
				<div id="disclaimer">* We will never send you spam or unsolicited offers.</div>
		</div>
</div>
</div>

<div id="menuOverlay">
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/about">About</a></li>
			<li><a href="/legal">Legal</a></li>
		</ul>
	</nav>
	<button>X</button>
</div>
	<script>
		$('.process-step').css('opacity', 0);
		// array of elements
		var boxes = $('.process-step').toArray();
		$.each(boxes, function(index, value) {
			var box = boxes[index];
			var when = ((500 * index) * (index / 2));
			$(box).animate({opacity: 1}, when, function() {
				// done
			});
			console.log(boxes[index]);
		});
		//console.log(boxes);

		var winwidth = $(window).width();
		window.moving = null;

		if(winwidth < 1000)
			startMoving();
		else
			stopMoving();

		$(window).resize(function() {
			var winwidth = $(window).width();

			if(winwidth < 1000)
				startMoving();
			else
				stopMoving();

			console.log(winwidth);
		});

		function moveStep() {
			if(window.curr_step == 4) {
				window.curr_step = 1;
				leftstep = '0px';
			} else {
				var leftstep = '-=101%';
			}
			$('#process-steps').animate({
				left: leftstep
			}, 300, function() {
				window.curr_step++;
			})
		}

		function startMoving() {
			console.log('starting');
			if(window.moving != null)
				stopMoving();
			window.curr_step = 1;
			$('#process-steps').css('left', '0px');
			$('.process-arrow').hide();
			window.moving = window.setInterval(moveStep,3000);
		}

		function stopMoving() {
			console.log('stopping');
			if(window.moving != null)
				window.clearInterval(window.moving);
			else
				console.log('nope');

			$('#process-steps').css('left', '0px');
			$('.process-arrow').show();
			window.moving = null;
		}

		$('#hamburger').click(function(e) {
			$('#menuOverlay').fadeIn();
		});

		$('#menuOverlay').click(function(e) {
			$('#menuOverlay').fadeOut();
		});

		$('#contact-form-send').click(function(e) {
			e.preventDefault();
			var form = {
				'name': $('#contact-form-name').val(),
				'email': $('#contact-form-email').val(),
				'phone': $('#contact-form-phone').val(),
				'message': $('#contact-form-details').val()
			};

			$('#contact-form-send').text('SENDING');
			$.post('/email', form, function(data) {
				$('#contact-form-send').text(data);
			});
		});
	</script>
	</body>
</html>
