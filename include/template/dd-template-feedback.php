<?php

function dd_feedback_setup(){
	$dd_feedback_errors = array();
	
	if($_POST['submit']) {
		$dd_feedback_name = $_POST['object']['name'];
		$dd_feedback_email = $_POST['object']['email'];
		$dd_feedback_message = $_POST['object']['message'];
		$dd_feedback_diagnostics = $_POST['object']['diagnostics'];
		$dd_feedback_url = $_POST['object']['include_url'];
	
		if($dd_feedback_name=='') $dd_feedback_errors[] = 'Por favor informe seu nome.';
		if($dd_feedback_email=='') $dd_feedback_errors[] = 'Por favor informe um email válido.';
		//if(!array_key_exists($this->data->type, $this->feedback_types)) $dd_feedback_errors[] = 'Please make sure you have selected a feedback type.';
		if($dd_feedback_message == '') $dd_feedback_errors[] = 'Por favor, digite sua mensagem.';
		if(strlen($dd_feedback_message)>2500) $dd_feedback_errors[] = 'Sua mensagem não pode conter mais de 2500 caracteres.';
		
		
		if(count($dd_feedback_errors)==0) {
			// Send email to contato@rockcontent.com
			$dd_feedback_subject = "Rocksocial Feedback ". DD_VERSION;
			$dd_feedback_message = "Name: $dd_feedback_name.\n\n Email: $dd_feedback_email.\n\n Message: $dd_feedback_message\n\n Diagnostics: $dd_feedback_diagnostics\n\n";
			
			if($dd_feedback_url){
				$dd_feedback_message .= "URL: ".get_bloginfo('url');
			}
			
			wp_mail("contato@rockcontent.com", $dd_feedback_subject, $dd_feedback_message);
			
			dd_feedback_success();
			return;
		}
	}

	$diagnostics = dd_get_diagnostics();
?>

	<div class="wrap">
				
		<?php if(count($dd_feedback_errors) != 0): ?><div class="error"><ul style="padding-top:6px;"><li><?php echo implode('</li><li>',$dd_feedback_errors); ?></li></ul></div><?php endif; ?>
		
		<h2>Rocksocial <?php echo DD_VERSION; ?> Feedback</h2>
		<p>Adoramos ouvir feedback sobre nosso plugin. Envie seu feedback pelo formulário abaixo. Para um atendimento super rápido, fale conosco no <a href="http://www.twitter.com/rockcontent">@RockcontentP</a> no Twitter.</p>
		<form method="post" action="">
			<table class="form-table">
				<tr>
					<th scope="row">Plugin</th>
					<td><strong>Rocksocial</strong> (version <?php echo DD_VERSION; ?>)</td>
				</tr>
				<tr>
					<th scope="row">Seu nome</th>
					<td><input type="text" name="object[name]" value="<?php echo dd_e($dd_feedback_name); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row">Seu endereço de email</th>
					<td>
						<input type="text" name="object[email]" value="<?php echo dd_e($dd_feedback_email); ?>" class="regular-text" />
						<br />
					</td>
				</tr>
				<tr>
					<th scope="row">Feedback</th>
					<td>
						<select name="object[type]">
							<option>Geral</option>
							<option>Bug</option>
							<option>Pedido de funcionalidade</option>
							<option>Outro</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">Sua mensagem<br /><span class="description">Máximo 2500 caracteres</span></th>
					<td>
						<textarea name="object[message]" class="large-text" rows="10" cols="50"><?php echo dd_e($dd_feedback_message); ?></textarea>
					</td>
				</tr>
				<?php if(is_array($diagnostics) and count($diagnostics)>0): ?>
					<tr>
						<th scope="row">Dados de diagnóstico</th>
						<td>
							Os dados de diagnóstico são enviados para nos ajudar a entender melhor os problemas que você estar enfrentando.
							<textarea name="object[diagnostics]" class="large-text" rows="5" cols="50"><?php foreach($diagnostics as $k=>$v): ?><?php echo $k.': '.$v."\n"; ?><?php endforeach; ?></textarea>
						</td>
					</tr>
				<?php endif; ?>
				
				
				<tr>
					<th></th>
					<td colspan="2">
						<label><input type="checkbox" name="object[include_url]" value="include" /> Incluir URL do site na mensagem.</label>
					</td>
				</tr>
				
			</table>
			<div class="submit">
				<input type="submit" name="submit" value="Send" class="button-primary" />
			</div>
		</form>
	</div>

<?php
} // end func: dd_feedback_setup



function dd_feedback_success(){
?>
	<div class="wrap">
		<h2>Rocksocial <?php echo DD_VERSION; ?> Feedback</h2>
		<div class="updated"><p>Feedback enviado com sucesso.</p></div>
		<p>Obrigado pelo contato. Responderemos o mais rápido possível.</p>
	</div>

<?php
} // end func: dd_feedback_success





/*
	Sanitise output
*/
function dd_e($str) {
	return htmlspecialchars($str);
} // end func: dd_e



function dd_get_diagnostics() {
	global $wpdb, $wp_version;
	$p = dd_phpinfo_array();
	
	$d = array();
	$d['host_os'] = $p['PHP Configuration']['System'];
	$d['server_api'] = $p['PHP Configuration']['Server API'];
	$d['php_version'] = $p['Core']['PHP Version'];
	$d['safe_mode'] = $p['Core']['safe_mode'];
	$d['mysql_version'] = $wpdb->get_var('SELECT version()');
	$d['wordpress_version'] = $wp_version;
	$d['timezone'] = $p['date']['date.timezone'];
	$d['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
	
	return $d;
} // end func: dd_get_diagnostics


/*
	Returns phpinfo() as an array (why doesn't PHP offer this as a built-in?)
	  * Reproduced from http://www.php.net/manual/en/function.phpinfo.php#87463
*/
function dd_phpinfo_array() {
	ob_start(); 
	phpinfo(-1);
	
	$pi = preg_replace(
	array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
	'#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
	"#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
	'#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
	.'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
	'#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
	'#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
	"# +#", '#<tr>#', '#</tr>#'),
	array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
	'<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
	"\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
	'<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
	'<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
	'<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
	ob_get_clean());
	
	$sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
	unset($sections[0]);
	
	$pi = array();
	foreach($sections as $section){
		$n = substr($section, 0, strpos($section, '</h2>'));
		preg_match_all('#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',$section, $askapache, PREG_SET_ORDER);
		foreach($askapache as $m) $pi[$n][$m[1]]=(!isset($m[3])||$m[2]==$m[3])?$m[2]:array_slice($m,2);
	}
	
	return $pi;
} // end func: dd_phpinfo_array

?>