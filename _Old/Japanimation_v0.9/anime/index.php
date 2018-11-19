<?php
	include("tool/header.php");
	//	head();
?>
	
	<div class = "arrow_left">
	<img src = "pic/sommaire_left.png" 
				width = "43" height = '43' title = "Categorie précédente"
				onClick = "prevCate();" 
				style = "left: 20px;"/>
	</div>
	<div class = "arrow_right">	
	<img src = "pic/sommaire_right.png" 
				width = "43" height = '43' title = "Categorie suivante"
				onclick = "nextCate();"
				style = "left: 380px;"/>
	</div>
	
	
	<DIV class = "sommaire">
	
		<div class = "background">
		<img src = "pic/anime_back_menu.png" width = '570' height = '290' />
		</div>
		
		<div>
		<p id = "titre" class = "titre"> Anime </p>
		</div>
		
		<div id = "illustration" class = "illustration">
			<img height = "200" name = "illustration" />
		</div>
		
		<div id = "sommaire" class = "sommaire_deroulant"></div>
	
		
		
		<div class = "arrow">
		
	
			
		
		
		<img src = "pic/sommaire_up.png" 
			width = "43" height = '43' 
			onMouseOver = "move('up');" onMouseOut = "stopmove();"
			style = "left: 100px;"/>
			
		<img src = "pic/sommaire_down.png" 
			width = "43" height = '43' 
			onMouseOver = "move('down');" onMouseOut = "stopmove();" 
			style = "left: 200px;"/>
			
			
		
		</div>
			
	</DIV>
	
	<br />
	<br />
	
	<iframe id = "html" 
		name = "frameHTML" 
		src = "page/test.htm" 
		scrolling = 'no' 
		width = '700px' height = '600px' 
		frameborder = '2'
		margin = 'auto'>
		Mon iFrame
	</iframe>
	
	<div id = "debug">Zone Debug</div>

<?php
	include("tool/footer.php");
?>