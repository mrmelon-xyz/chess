<html>
<head>
	
	<link href="jquery/jquery-ui.css" rel="stylesheet">
	<script src="jquery/jquery.js"></script>
	<script src="jquery/jquery-ui.js"></script>
	

	
	<style>
		body{
			font: 62.5% "Trebuchet MS", sans-serif;
		}
		#menu { 
			width:	450px; 
			height: 50px;
			margin: 0 auto;
		}
		
		#board { 
			width:	450px; 
			height: 450px;
			margin: 0 auto;
		}
		
		#board div {
			color: black; 
			width: 50px;
			height: 50px;
			text-align: center;
			float:left;
		}
		
		#board table {
			border: 1px solid black; 
			border-collapse: collapse;
		}
		
		#board table td {
			border: 1px solid black; 
		}
				
		.white_farmer {
			background-image: url(images/white_farmer.png);
			z-index: 1000;
		}

		.white_king {
			background-image: url(images/white_king.png);
			z-index: 1000;
		}

		.white_queen {
			background-image: url(images/white_queen.png);
			z-index: 1000;
		}

		.white_runner {
			background-image: url(images/white_runner.png);
			z-index: 1000;
		}

		.white_jumper {
			background-image: url(images/white_jumper.png);
			z-index: 1000;
		}

		.white_tower {
			background-image: url(images/white_tower.png);
			z-index: 1000;
		}


		.black_farmer {
			background-image: url(images/black_farmer.png);
			z-index: 1000;
		}

		.black_king {
			background-image: url(images/black_king.png);
			z-index: 1000;
		}

		.black_queen {
			background-image: url(images/black_queen.png);
			z-index: 1000;
		}

		.black_runner {
			background-image: url(images/black_runner.png);
			z-index: 1000;
		}

		.black_jumper {
			background-image: url(images/black_jumper.png);
			z-index: 1000;
		}

		.black_tower {
			background-image: url(images/black_tower.png);
			z-index: 1000;
		}
	</style>
	
</head>
<body>
<div id='menu'>
	<table>
		<tr>
			<td>
				<form action='index.php' method='post'>
					<input type='submit' name='reset_game' value='Reset'>
				</form>
			</td>
			<td>
				<form action='' method=''>
					<input type='button' onclick='window.location.href=window.location.href' value='Refresh'>
				</form>
			</td>
		</tr>
	</table>
	
	<p id='resultarea'></p>

	<br />
</div>
<?php

include("class.board.php");

$objBoard = new Board();

	if (isset($_POST['reset_game'])){
		$objBoard->populate_table();
	}
	
$objBoard->generate_fields();

echo "<script>";

		print("
			var selFigure = null;
			var selFigureColor = null;
			var tarLocation = null;
			var tmpFigureClass = null;
			
			var colorInPlay = 'white';
			
			$.fn.moveFigure = function() {
				
				if(selFigure == null){
					if($(this).attr('class').indexOf(colorInPlay) > -1) {
						selFigure = $(this);
						
						$(this).css({'border': '1px solid red', 'width': '48px', 'height': '48px'});
						
						tmpFigureClass = $(this).attr('class');
						
						get_possible_moves(selFigure.attr('id'),tmpFigureClass);
					} else {
						alert('Now is ' + colorInPlay + ' color turn.');
					}
				} else {
					
					if($(this).hasClass('available')) {
						
						selFigure.removeClass(tmpFigureClass);
						
						$(this).removeClass();
						$(this).addClass(tmpFigureClass).css('border','').css({'width': '50px', 'height': '50px'});
						
						if($(this) != selFigure){
							selFigure.css('border','').css({'width': '50px', 'height': '50px'});
						} 
						
						tarLocation = $(this).attr('id');
						
						update_position(selFigure.attr('id'), tarLocation);
						
							if(colorInPlay == 'white'){
								colorInPlay = 'black';
							} else {
								colorInPlay = 'white';
							}
					}
					
					selFigure = null;
					
					$('.available').css({'border': '', 'width': '50px', 'height': '50px'}).removeClass('available');

				}
				
			};
			
			
			function get_possible_moves(SrcSquID, SrcSquClass) {
					
				$.ajax({
				  type: 'GET',
				  url: 'ajax.chess_game.php',
				  data: {Source: SrcSquID, SourceClass: SrcSquClass},
				  cache: false,
				  dataType: 'json',
				  success: function(data){
					$.each(data, function( key, value) {
						$('#'+value).css({'border': '1px solid green', 'width': '48px', 'height': '48px'}).addClass('available');
					});
					 
					 
					//$(\"#resultarea\").text(data);
				  }
				});

			};
			
			function update_position(SrcSquID, tarLocation) {
					
				$.ajax({
				  type: 'GET',
				  url: 'ajax.chess_game.php',
				  data: {Source: SrcSquID, Target: tarLocation},
				  cache: false,
				  dataType: 'json',
				  success: function(data){
					 $(\"#resultarea\").text(data);
				  }
				});

			};
		");	
		
echo "</script>";
	
?>
</body>
</html>



