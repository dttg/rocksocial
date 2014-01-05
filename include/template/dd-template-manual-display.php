<?php 
//maunal display function
function dd_button_manual_setup(){
	
	global $dd_manual_code;
  	// display admin screen
  	dd_print_manual_form($dd_manual_code);
}

function dd_print_manual_form($dd_manual_code){
?>
<div class="wrap dd-wrap columns-2">
	<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
	<h2>Rocksocial - Posicionamento manual</h2>
	
	<div id="poststuff" class="metabox-holder has-right-sidebar">
		<?php include("dd-sidebar.php"); ?>
		<div id="post-body">
			<div id="post-body-content">
			
				<div class="stuffbox">
					<h3><label for="link_name">Uso avançado</label></h3>
					<div class="inside">
						<p>
						Este é o procedimento manual para incluir botões em suas páginas.
						</p>
						<h4>Exemplo</h4>
						<p>
							1. Coloque esta função  <code>&lt;?php if(function_exists('dd_digg_generate')){dd_digg_generate('Normal');} ?&gt;</code> no seu arquivo "single.php",
						Ela adicionará um botão em cada post do seu site.
						</p>
						
					
						<?php 
							
						foreach(array_keys($dd_manual_code) as $key){
							echo "<table class='dd_table_manual dd-table'>";
								
					    	echo "<tr><td colspan='2' style='padding:0' ><h3>" . $key . "</h3></td></tr>";
					    	
							foreach($dd_manual_code[$key] as $subkey => $value){
								echo "<tr>";
								echo "<td>" . $subkey . "</td>";
								echo "<td><code>&lt;?php " . $value . " ?&gt; </code></td>";
								echo "</tr>";					
							}
							
							echo "</table>";
					    }
					    
			
						?>
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>
<?php 
}
?>