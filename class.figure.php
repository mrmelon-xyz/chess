<?php

class Figure {
	
	private	$db_name = 'chess';
	private	$db_user = 'root';
	private	$db_pass = '';
	private	$db_host = 'localhost';

	function connect_db(){
		
		try{ 
			
			$db_pdo_heand = new PDO("mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8", $this->db_user, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
			return $db_pdo_heand;
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}

	function check_field_empty($id) {

		try{ 
			
			$db_pdo = $this->connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$id."'");			
			$record = $stmt->fetchall(PDO::FETCH_ASSOC);
			
				if ($record[0]['current_figure'] == null) {
					return true;
				} else {
					return false;
				}
				
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
	
	
	function check_if_field_available($destination_pos_id, $current_pos_id) {

		try{ 
			
			$db_pdo = $this->connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$current_pos_id."'");			
			$current_pos = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			$current_figure_color = substr($current_pos[0]['current_figure'], 1, 5);
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$destination_pos_id."'");			
			$destination_pos = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			$destination_figure_color = substr($destination_pos[0]['current_figure'], 1, 5);
			
				if ($destination_pos[0]['current_figure'] != null and $current_figure_color != $destination_figure_color) {
					return 'attack';
				} elseif ($destination_pos[0]['current_figure'] == null) {
					return 'null';
				} else {
					return false;
				}
				
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
	
	public function check_new_position ($new_pos) {
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
			$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
			
			if($condition == 'attack') {
				$moves_array[] = $new_pos;
				break;
			} elseif ($condition == 'null') {
				$moves_array[] = $new_pos;
			} else {
				break;
			}
		}
	}
	
	
	
	public function basic_move_forward ($temp_pos, $field_num = 1){

			$new_pos['x_ref'] = $temp_pos['x_ref'];
			$new_pos['y_ref'] = $temp_pos['y_ref'] + $field_num;
			
			$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
					
		return $new_pos;
	}
	
	public function basic_move_back ($temp_pos, $field_num = 1){
	
			$new_pos['x_ref'] = $temp_pos['x_ref'];
			$new_pos['y_ref'] = $temp_pos['y_ref'] - $field_num;
			
			$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
			
		return $new_pos;
	}
	
	public function basic_move_left ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'];
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function basic_move_right ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] + $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'];
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function basic_move_forward_right ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] + $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'] + $field_num;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function basic_move_forward_left ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'] + $field_num;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function basic_move_back_right ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] + $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - $field_num;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function basic_move_back_left ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - $field_num;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - $field_num;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function figure_all_moves ($current_pos) {
		
		if($this->is_on_board($this->basic_move_forward($current_pos))){
			$moves_array[] = $this->basic_move_forward($current_pos);
		}

		if($this->is_on_board($this->basic_move_back($current_pos))){
			$moves_array[] = $this->basic_move_back($current_pos);
		}

		if($this->is_on_board($this->basic_move_left($current_pos))){
			$moves_array[] = $this->basic_move_left($current_pos);
		}

		if($this->is_on_board($this->basic_move_right($current_pos))){
			$moves_array[] = $this->basic_move_right($current_pos);
		}		
		        
		if($this->is_on_board($this->basic_move_forward_left($current_pos))){
			$moves_array[] = $this->basic_move_forward_left($current_pos);
		}

		if($this->is_on_board($this->basic_move_forward_right($current_pos))){
			$moves_array[] = $this->basic_move_forward_right($current_pos);
		}

		if($this->is_on_board($this->basic_move_back_left($current_pos))){
			$moves_array[] = $this->basic_move_back_left($current_pos);
		}

		if($this->is_on_board($this->basic_move_back_right($current_pos))){
			$moves_array[] = $this->basic_move_back_right($current_pos);
		}

		return $moves_array;
	}
		
	public function is_on_board ($pos) {
		
		if( ( $pos['x_ref'] >= 0 && $pos['x_ref'] <= 7 ) && ( $pos['y_ref'] >= 0 && $pos['y_ref'] <= 7 ) ) {
			return true;
		}
		else {
			return false;
		}
		
	}
}

	
?>