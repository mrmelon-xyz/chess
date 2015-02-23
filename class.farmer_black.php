<?php

class Farmer_Black extends Figure {

	
	public function first_move ($current_pos){
		if($current_pos['y_ref'] == 6 ){
			
			$new_pos = $this->basic_move_back($current_pos, 2);
			
			if($this->is_on_board($new_pos)){
				$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
				$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
				
					$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
					
					if($condition == 'null') {
						return $new_pos;
					} else {
						return false;
					}

			}
			else {
				return false;
			}

		}
	}
	
	function basic_move ($current_pos){
		
		$new_pos = $this->basic_move_back($current_pos);
					
			if($this->is_on_board($new_pos)){
				$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
				$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
				
					$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
					
					if($condition == 'null') {
						return $new_pos;
					} else {
						return false;
					}

			}
			else {
				return false;
			}


	}
	
	function atak_move_left ($current_pos){
		
		$new_pos = $this->basic_move_back_left($current_pos);
		
			if($this->is_on_board($new_pos)){
				$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
				$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
				
					$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
					
					if($condition == 'attack') {
						return $new_pos;
					} else {
						return false;
					}

			}
			else {
				return false;
			}

		
	}
	
	function atak_move_right ($current_pos){
		
		$new_pos = $this->basic_move_back_right($current_pos);
		
			if($this->is_on_board($new_pos)){
				$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
				$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
				
					$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
					
					if($condition == 'attack') {
						return $new_pos;
					} else {
						return false;
					}

			}
			else {
				return false;
			}


	}
	
	function farmer_all_moves ($current_pos) {
		
		
		if ($this->first_move($current_pos)) {
			$all_moves_array[] = $this->first_move($current_pos);
		}
		
		if ($this->basic_move($current_pos)) {
			$all_moves_array[] = $this->basic_move($current_pos);
		}
		
		if ($this->atak_move_left($current_pos)) {
			$all_moves_array[] = $this->atak_move_left($current_pos);
		}
		
		if ($this->atak_move_right($current_pos)) {
			$all_moves_array[] = $this->atak_move_right($current_pos);
		}
		
		if(empty($all_moves_array)) {
			
			$all_moves_array['err'] = true;
			return $all_moves_array;
			
		}
		else {
			return $all_moves_array;
		}
	}
}
?>