<?php 
//for global setting
function dd_button_global_setup(){
	
	global $ddGlobalConfig;
	
	if (isset($_POST[DD_FORM_SAVE]) && check_admin_referer('rocksocial_global_save','rocksocial_global_nonce')) {

		//update global settings options
		foreach(array_keys($ddGlobalConfig) as $key){
			//echo '<h1>' . $key . '</h1>';
			
			foreach(array_keys($ddGlobalConfig[$key]) as $option){
				
				//echo '<h1>' . $option . '</h1>';
		    	if(isset($_POST[$option])){
		    		$ddGlobalConfig[$key][$option] = $_POST[$option];
		    	}else{
		    		$ddGlobalConfig[$key][$option] = DD_EMPTY_VALUE;
		    	}
		    }
	    }
	   
		update_option(DD_GLOBAL_CONFIG, $ddGlobalConfig);
		

		echo "<div id=\"updatemessage\" class=\"updated fade\"><p>Rocksocial configurações atualizadas.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";	
				
  	}else if(isset($_POST[DD_FORM_CLEAR])){
	
        dd_clear_form_global_config(DD_FUNC_TYPE_RESET);
        
		echo "<div id=\"errmessage\" class=\"error fade\"><p>Configurações padrão foram aplicadas com sucesso.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#errmessage').hide('slow');}, 3000);</script>";	
			
  	}else if(isset($_POST[DD_FORM_CLEAR_ALL])){
	
        dd_clear_all_forms_settings();
		echo "<div id=\"errmessage\" class=\"error fade\"><p>Configurações padrão foram aplicadas com sucesso.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#errmessage').hide('slow');}, 3000);</script>";	
			
  	}
  	
  	//get back the settings from wordpress options
  	$ddGlobalConfig = get_option(DD_GLOBAL_CONFIG);
	
  	dd_print_global_form($ddGlobalConfig);
}

function dd_print_global_form($ddGlobalConfig){
?>

<div class="wrap columns-2 dd-wrap">
	<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
	<h2>Rocksocial - Configurações Globais</h2>
	<div id="poststuff" class="metabox-holder has-right-sidebar">
		<?php include("dd-sidebar.php"); ?>
		<div id="post-body">
			<div id="post-body-content">
				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="<?php echo DD_FORM; ?>">
						<div class="stuffbox">
							<h3><label for="link_name">1. Facebook Like</label></h3>
							<div class="inside">
								<table class="form-table">
							        <tr valign="top">
								        <th scope="row">1.1 Idioma</th>
								        <td>
								        	<input type="text" 
									value="<?php echo $ddGlobalConfig[DD_GLOBAL_FACEBOOK_OPTION][DD_GLOBAL_FACEBOOK_OPTION_LOCALE]; ?>" 
									name="<?php echo DD_GLOBAL_FACEBOOK_OPTION_LOCALE;?>" />
											<br />
										</td>
							        </tr>
							         
							        <tr valign="top">
							        	<th scope="row">1.2 Incluir botão de enviar do Facebook?</th>
							        	<td>
							        		<INPUT TYPE=CHECKBOX NAME="<?php echo DD_GLOBAL_FACEBOOK_OPTION_SEND ?>" 
								<?php echo ($ddGlobalConfig[DD_GLOBAL_FACEBOOK_OPTION][DD_GLOBAL_FACEBOOK_OPTION_SEND]==DD_DISPLAY_ON) ? DD_CHECK_BOX_ON : DD_CHECK_BOX_OFF ?>>
							        	</td>
							        </tr>
							        
							        <tr valign="top">
							        	<th scope="row">1.3 Exibir faces</th>
							        	<td>
							        		<INPUT TYPE=CHECKBOX NAME="<?php echo DD_GLOBAL_FACEBOOK_OPTION_FACE ?>" 
								<?php echo ($ddGlobalConfig[DD_GLOBAL_FACEBOOK_OPTION][DD_GLOBAL_FACEBOOK_OPTION_FACE]==DD_DISPLAY_ON) ? DD_CHECK_BOX_ON : DD_CHECK_BOX_OFF ?>>
							        	</td>
							        </tr>
							        
							        <tr valign="top">
							        	<th scope="row">1.4 Utilizar imagens do post no compartilhamento</th>
							        	<td>
							        		<INPUT TYPE=CHECKBOX NAME="<?php echo DD_GLOBAL_FACEBOOK_OPTION_THUMB ?>" 
								<?php echo ($ddGlobalConfig[DD_GLOBAL_FACEBOOK_OPTION][DD_GLOBAL_FACEBOOK_OPTION_THUMB]==DD_DISPLAY_ON) ? DD_CHECK_BOX_ON : DD_CHECK_BOX_OFF ?>>
							        	</td>
							        </tr>
							        
							        <tr valign="top">
							        	<th scope="row">1.5 Imagem padrão de compartilhamento</th>
							        	<td>
							        		<input type="text" 
												value="<?php echo $ddGlobalConfig[DD_GLOBAL_FACEBOOK_OPTION][DD_GLOBAL_FACEBOOK_OPTION_DEFAULT_THUMB]; ?>" 
												name="<?php echo DD_GLOBAL_FACEBOOK_OPTION_DEFAULT_THUMB;?>" size="70" />
											<p>Se o post não tiver imagens, esta imagem será utilizada.</p>
							        	</td>
							        </tr>
							        <!--
							        <tr valign="top">
							        	<th scope="row">Some Other Option</th>
							        	<td>
							        		<input type="text" name="some_other_option" value="<?php echo get_option('some_other_option'); ?>" />
							        	</td>
							        </tr>
							        -->
							    </table>
								
								<div class="submit">
									<input class="button-primary" name="<?php echo DD_FORM_SAVE; ?>" value="Salvar" type="submit" style="width:100px;" />
								</div>
							</div>
						</div>
						<!-- End FB Like Config -->
						
						
						
						<div class="stuffbox">
							<h3><label for="link_name">2. Configurações do Twitter</label></h3>
							<div class="inside">
								<table class="form-table">
							        <tr valign="top">
							        	<th scope="row">2.1 Conta no Twitter</th>
							        	<td>
							        		<input type="text" value="<?php echo $ddGlobalConfig[DD_GLOBAL_TWITTER_OPTION][DD_GLOBAL_TWITTER_OPTION_SOURCE]; ?>" name="<?php echo DD_GLOBAL_TWITTER_OPTION_SOURCE;?>" />
							        		<p>Este usuário será o @ mencionado no tweet sugerido.</p>
							        	</td>
							        </tr>
							    </table>
								
								<div class="submit">
									<input class="button-primary" name="<?php echo DD_FORM_SAVE; ?>" value="Salvar" type="submit" style="width:100px;" />
								</div>
							</div>
						</div>
						<!-- End Twitter Config -->
						
						<div class="stuffbox">
							<h3><label for="link_name">3. Voltar as configurações padrão.</label></h3>
							<div class="inside">
								<br />
								<input class="button-primary" onclick="if (confirm('Tem certeza que deseja resetar todas as configurações globais?'))return true;return false" name="<?php echo DD_FORM_CLEAR; ?>" value="Redefinir configurações padrão" type="submit" style="width:200px;"/>
								<br /><br />
							</div>
						</div>
						<!-- End Reset Global Config -->
						
						
						
						<!--div class="stuffbox">
						<?php // XXX: This seems pretty drastic... I doubt many people do this one! ?>
							<h3><label for="link_name">4. Reset Everything</label></h3>
							<div class="inside">
								<br />
								<p>Reset all settings (everything) to their default values.</p>
								<input class="button-primary" onclick="if (confirm('Are you sure you want to reset all settings to their default values?'))return true;return false" name="<?php echo DD_FORM_CLEAR_ALL; ?>" value="Reset All Settings" type="submit" style="width:200px;"/>
								<br /><br />
							</div>
						</div-->
						<!-- End Reset All Config -->
						
						<?php wp_nonce_field('rocksocial_global_save','rocksocial_global_nonce'); ?>
					</form>
			</div>
		</div>
	</div>
</div>
<?php 
}
?>