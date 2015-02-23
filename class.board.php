<?php

class Board {
	
	private $db_name = 'chess';
	private $db_user = 'root';
	private $db_pass = '';
	private $db_host = 'localhost';
	
	protected $db_pdo;
	
	
	public $basic_setup_array = array (
		'x0y0' => 'white_tower',
		'x1y0' => 'white_jumper',
		'x2y0' => 'white_runner',
		'x3y0' => 'white_king',
		'x4y0' => 'white_queen',
		'x5y0' => 'white_runner',
		'x6y0' => 'white_jumper',
		'x7y0' => 'white_tower',
		'x0y1' => 'white_farmer',
		'x1y1' => 'white_farmer',
		'x2y1' => 'white_farmer',
		'x3y1' => 'white_farmer',
		'x4y1' => 'white_farmer',
		'x5y1' => 'white_farmer',
		'x6y1' => 'white_farmer',
		'x7y1' => 'white_farmer',
		'x0y7' => 'black_tower',
		'x1y7' => 'black_jumper',
		'x2y7' => 'black_runner',
		'x3y7' => 'black_king',
		'x4y7' => 'black_queen',
		'x5y7' => 'black_runner',
		'x6y7' => 'black_jumper',
		'x7y7' => 'black_tower', 
		'x0y6' => 'black_farmer',
		'x1y6' => 'black_farmer',
		'x2y6' => 'black_farmer',
		'x3y6' => 'black_farmer',
		'x4y6' => 'black_farmer',
		'x5y6' => 'black_farmer',
		'x6y6' => 'black_farmer',
		'x7y6' => 'black_farmer'		
	);
	
	
	public function __constract(){
		
		
	}
	
	private function connect_db(){
		try{ 
			$db_pdo = new PDO("mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8", $this->db_user, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
			return $db_pdo;
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
	
	
	
	public function generate_fields() {
		
		try{ 
		
			$db_pdo = $this->connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM board_table");			
			$board = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			foreach ($board as $field) {
				$fields[$field['id']] = $field;
			}
			
			echo "<div id='board'>";
			echo "<table>";
			for($y=7; $y>=0; $y--) {
					echo "<tr>";
					
					for($x=0; $x<=7; $x++) {
						
						if($fields['x'.$x.'y'.$y]['field_type']){ 
							
							$field_color = 'background-color: white';
						
						}
						else {
							
							$field_color = 'background-color: #F5F5DC';
						
						}
						echo "<td style='".$field_color."'>";
						echo "<div id='".$fields['x'.$x.'y'.$y]['id']."' class='".$fields['x'.$x.'y'.$y]['current_figure']."' ></div>"; // ".$fields['x'.$x.'y'.$y]['id']."
						echo "</td>";
					}
					
					echo "</tr>";
					
			}
			echo "</table>";
			echo "</div>";
			
			echo "<script>";

				for($y=7; $y>=0; $y--) {
					
					for($x=0; $x<=7; $x++) {
						
						print("
							$('#".$fields['x'.$x.'y'.$y]['id']."').click(function(){
									$(this).moveFigure();
							});

						");
					
					}
				}
				
			echo "</script>";
			
			
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}

	}
	
	public function populate_table(){
			
		try{ 
		
			$db_pdo = $this->connect_db();
			
			$query = $db_pdo->prepare("DELETE FROM board_table");
			$query->execute();

			for($y=7; $y>=0; $y--) {
			
				if($y % 2) {
					$field_type = true;
				}
				else {
					$field_type = false;
				}
			
				for($x=0; $x<=7; $x++) {
					
					if(array_key_exists('x'.$x.'y'.$y, $this->basic_setup_array)) {
						$current_figure = $this->basic_setup_array['x'.$x.'y'.$y];
					} else {
						$current_figure = null;
					}
					
					$query = $db_pdo->prepare("INSERT INTO board_table VALUES ('x{$x}y{$y}', '{$x}', '{$y}', '', '{$field_type}', '{$current_figure}' )");
					$query->execute();
				
					$field_type = !$field_type;
				}			
			}
			  
			  
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
		
	}
	
	public function board_setup () {

		try{ 
	
			$db_pdo = $this->connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM figures_table");			
			$figures = $stmt->fetchall(PDO::FETCH_ASSOC);
			
		/* 	$script = "<script>";

				echo "$(\"#"."x".$current_pos['x_ref']."y".$current_pos['y_ref']."\").css( 'background', 'green').css( 'font-weight', '700').css( 'color', 'white');\n";

				foreach($posib_moves as $pos_mov) {
					
					echo "$(\"#".$pos_mov['id']."\").css( 'background', 'red').css( 'font-weight', '700').css( 'color', 'white');\n";
				} 

			$script .= "</script>";
			
			return $script;
		 */	
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
}

	

?>

