<?php
	include("/tool/header.php");
		head();
?>

	<DIV id = "sommaire" class = "sommaire">
	</DIV>

	<br />
	<br />
	<table border = "1">
		<tr>
			<td onMouseOver = "move('up');" onMouseOut = "stopmove();"> move up </td>
			<td onMouseOver = "move('down');" onMouseOut = "stopmove();"> move down </td>
		</tr>
		<tr>
			<td onMouseOver = "sizeup();" onMouseOut = "stopsizeup();"> size up </td>
			<td onMouseOver = "sizedown();" onMouseOut = "stopsizedown();"> size down </td>
		</tr>
	</table>
	
	<br />
	<br />
	
	
	<table class = "tablo" border = "1">
		<tr>
			<td> type </td>
			<td> 0 </td>
			<td> 1 </td>
			<td> 2 </td>
			<td> 3 </td>
			<td> 4 </td>
			<td> 5 </td>
			<td> 6 </td>
			<td> 7 </td>
			<td> 8 </td>
			<td> 9 </td>
		</tr>
		<tr>
			<td> Height </td>
			<td> <div id = "high0"> </div></td>
			<td> <div id = "high1"> </div></td>
			<td> <div id = "high2"> </div></td>
			<td> <div id = "high3"> </div></td>
			<td> <div id = "high4"> </div></td>
			<td> <div id = "high5"> </div></td>
			<td> <div id = "high6"> </div></td>
			<td> <div id = "high7"> </div></td>
			<td> <div id = "high8"> </div></td>
			<td> <div id = "high9"> </div></td>
		</tr>
		<tr>
			<td> Top </td>
			<td> <div id = "top0"> </div></td>
			<td> <div id = "top1"> </div></td>
			<td> <div id = "top2"> </div></td>
			<td> <div id = "top3"> </div></td>
			<td> <div id = "top4"> </div></td>
			<td> <div id = "top5"> </div></td>
			<td> <div id = "top6"> </div></td>
			<td> <div id = "top7"> </div></td>
			<td> <div id = "top8"> </div></td>
			<td> <div id = "top9"> </div></td>
		</tr>
		<tr>
			<td> Left </td>
			<td> <div id = "left0"> </div></td>
			<td> <div id = "left1"> </div></td>
			<td> <div id = "left2"> </div></td>
			<td> <div id = "left3"> </div></td>
			<td> <div id = "left4"> </div></td>
			<td> <div id = "left5"> </div></td>
			<td> <div id = "left6"> </div></td>
			<td> <div id = "left7"> </div></td>
			<td> <div id = "left8"> </div></td>
			<td> <div id = "left9"> </div></td>
		</tr>
		<tr>
			<td> Font size </td>
			<td> <div id = "size0"> </div></td>
			<td> <div id = "size1"> </div></td>
			<td> <div id = "size2"> </div></td>
			<td> <div id = "size3"> </div></td>
			<td> <div id = "size4"> </div></td>
			<td> <div id = "size5"> </div></td>
			<td> <div id = "size6"> </div></td>
			<td> <div id = "size7"> </div></td>
			<td> <div id = "size8"> </div></td>
			<td> <div id = "size9"> </div></td>
		</tr>
		<tr>
			<td> position </td>
			<td> <div id = "position0"> </div></td>
			<td> <div id = "position1"> </div></td>
			<td> <div id = "position2"> </div></td>
			<td> <div id = "position3"> </div></td>
			<td> <div id = "position4"> </div></td>
			<td> <div id = "position5"> </div></td>
			<td> <div id = "position6"> </div></td>
			<td> <div id = "position7"> </div></td>
			<td> <div id = "position8"> </div></td>
			<td> <div id = "position9"> </div></td>
		</tr>
		
	</table>
	
	<p>movement:</p><div id = 'taille'></div>

<?php
	include("/tool/footer.php");
?>