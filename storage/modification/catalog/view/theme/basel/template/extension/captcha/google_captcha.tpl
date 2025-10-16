<script src="//www.google.com/recaptcha/api.js"></script>

<?php if (substr($route, 0, 9) == 'checkout/') { ?>

<fieldset>
<legend><?php echo $text_captcha; ?></legend>

        	
			<div id="recaptcha-badge"></div>
			<input type="hidden" name="recaptcha_response">
			
			<script src="https://www.google.com/recaptcha/api.js?render=explicit&onload=getRecaptcha" type="text/javascript"></script>
            <script type="text/javascript">
				
			function getRecaptcha()
			{
				var grecaptchaID = grecaptcha.render("recaptcha-badge", {
					"sitekey": "<?php echo $site_key; ?>",
					"badge": "bottomright",
					"size": "invisible"
				});
							
				grecaptcha.ready(function() {
					grecaptcha.execute(grecaptchaID, {
						action: "<?php echo $recaptcha_action; ?>"
					}).then(function(token) {
						document.querySelector("input[name='recaptcha_response']").value = token;
					});
				}); 
			}
                
			</script>
			
			
</div>
</fieldset>

<?php } ?>