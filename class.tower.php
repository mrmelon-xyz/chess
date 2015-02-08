<?php

class Tower extends Figure {
	
	
	private function all_moves_forward($current_pos){
	
		for($i=$current_pos['y_ref'] + 1; $i <= 7; $i++) {
			
			$new_pos = $this->basic_move_forward($current_pos, $i - $current_pos['y_ref'] );
			
			if($this->is_on_board($new_pos)){
				if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
					$moves_array[] = $new_pos;
				}else {
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
	
	private function all_moves_back($current_pos){
		
		for($i=$current_pos['y_ref'] - 1 ; $i>= 0; $i--) {
			
			$new_pos = $this->basic_move_back($current_pos, $current_pos['y_ref'] - $i);
			
			if($this->is_on_board($new_pos)){
				if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
					$moves_array[] = $new_pos;
				}else {
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
	
	private function all_moves_right($current_pos){
		
		for($i=$current_pos['x_ref'] + 1; $i<= 7; $i++){
			
			$new_pos = $this->basic_move_right($current_pos, $i - $current_pos['x_ref'] );
			
			if($this->is_on_board($new_pos)){
				if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
					$moves_array[] = $new_pos;
				}else {
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
	
	private function all_moves_left($current_pos){

		for($i=$current_pos['x_ref'] - 1; $i>= 0; $i--){
			
			$new_pos = $this->basic_move_left($current_pos, $current_pos['x_ref'] - $i );
			
			if($this->is_on_board($new_pos)){
				if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
					$moves_array[] = $new_pos;
				}else {
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
	
	
	public function tower_all_moves ($current_pos) {
		
		$moves_array = $this->all_moves_forward($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_back($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_left($current_pos);
		if(!empty($moves_array)){
			foreach ($moves_array as $mov) {
				$all_moves_array[] = $mov;
			}
		}
		
		$moves_array = $this->all_moves_right($current_pos);
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