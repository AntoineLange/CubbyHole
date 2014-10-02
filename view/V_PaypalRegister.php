<div class="container">
	<div class="jumbotron txtCenter">
        <h1>Paiement paypal :</h1>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="6KB4434YU8HJS">
		<input type="hidden" name="on0" value="Choix du plan">Choix du plan
		<br/>
		<select name="os0">
				<option value="PRO">PRO : 5,00 EUR - mensuel</option>
				<option value="BUSINESS">BUSINESS : 40,00 EUR - mensuel</option>
		</select>
		<br/>
		<br/>
		<input type="hidden" name="currency_code" value="EUR">
		<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
      </div>
	
</div>