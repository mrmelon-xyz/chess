<?php

	try {
		
				$db_name = 'chess';
				$db_user = 'root';
				$db_pass = '';
				$db_host = 'localhost';
			
			
			$db_pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
			
			$destination_pos_id = 'x7y4';
			$current_pos_id = 'x7y0';
			
			echo 1;
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$current_pos_id."'");			
			$current_pos = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			echo $current_figure_color = substr($current_pos[0]['current_figure'], 0, 5);
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$destination_pos_id."'");			
			$destination_pos = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			echo $destination_figure_color = substr($destination_pos[0]['current_figure'], 0, 5);
			
			echo 2;
			
				if ($destination_pos[0]['current_figure'] != null and $current_figure_color != $destination_figure_color) {
					echo 'attack';
				} elseif ($destination_pos[0]['current_figure'] == null) {
					echo 'true';
				} else {
					echo 'false';
				}
				
		}
		catch(PDOException $e){
			
			echo 'Polaczenie nie moglo zostac utworzone: ' .$e->getMessage();
		
		}
		
		
?>