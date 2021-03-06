<?php

class Runner extends Figure {

	private function all_moves_forward_right($current_pos){
	
		for($i=$current_pos['y_ref'] + 1; $i <= 7; $i++) {
			
			$new_pos = $this->basic_move_forward_right($current_pos, $i - $current_pos['y_ref'] );
			
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
		
		if(!empty($moves_array)){
			return $moves_array;
		}
		else {
			return false;
		}
		
	}
	
	private function all_moves_forward_left($current_pos){
		
		for($i=$current_pos['y_ref'] + 1 ; $i<= 7; $i++) {
			
			$new_pos = $this->basic_move_forward_left($current_pos, $i - $current_pos['y_ref'] );
			
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
		
		if(!empty($moves_array)){
			return $moves_array;
		}
		else {
			return false;
		}
		
	}
	
	private function all_moves_back_right($current_pos){
		
		for($i=$current_pos['y_ref'] - 1; $i>=0; $i--){
			
			$new_pos = $this->basic_move_back_right($current_pos, $current_pos['y_ref'] - $i );
			
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
		
		if(!empty($moves_array)){
			return $moves_array;
		}
		else {
			return false;
		}
		
	}
	
	private function all_moves_back_left($current_pos){

		for($i=$current_pos['y_ref'] - 1; $i>=0; $i--){
			
			$new_pos = $this->basic_move_back_left($current_pos, $current_pos['y_ref'] - $i );
			
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
		
		if(!empty($moves_array)){
			return $moves_array;
		}
		else {
			return false;
		}
		
	}
	
	
	public function runner_all_moves ($current_pos) {
		
		$moves_array = $this->all_moves_forward_left($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_forward_right($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_back_left($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_back_right($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		
		if(!empty($all_moves_array)){
			return $all_moves_array;
		} else {
			return false;
		}

	}
	
}

	
?>