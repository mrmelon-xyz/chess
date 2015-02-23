<?php

class King extends Figure {
	
	
	private function move_forward($current_pos){
		
		$new_pos = $this->basic_move_forward($current_pos);
		
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_back($current_pos){

		$new_pos = $this->basic_move_back($current_pos);
		
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_right($current_pos){

		$new_pos = $this->basic_move_right($current_pos);
		
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_left($current_pos){

		$new_pos = $this->basic_move_left($current_pos);
	
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_forward_right($current_pos){
	
		$new_pos = $this->basic_move_forward_right($current_pos);
	
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_forward_left($current_pos){
		
		$new_pos = $this->basic_move_forward_left($current_pos);
		
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_back_right($current_pos){
		
		$new_pos = $this->basic_move_back_right($current_pos);
		
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	private function move_back_left($current_pos){

		$new_pos = $this->basic_move_back_left($current_pos);
	
		if($this->is_on_board($new_pos)){
			$destination_pos_id = 'x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'];
			$current_pos_id = 'x'.$current_pos['x_ref'].'y'.$current_pos['y_ref'];
			
				$condition = $this->check_if_field_available($destination_pos_id, $current_pos_id);
				
				if($condition == 'attack') {
					return $new_pos;
					break;
				} elseif ($condition == 'null') {
					return $new_pos;
				} else {
					return false;
				}

		}
		else {
			return false;
		}
		
	}
	
	public function king_all_moves ($current_pos) {
		
		$moves_array = $this->move_forward($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		$moves_array = $this->move_back($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
	
		$moves_array = $this->move_left($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		$moves_array = $this->move_right($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		
		$moves_array = $this->move_forward_left($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		$moves_array = $this->move_forward_right($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		
		$moves_array = $this->move_back_left($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		$moves_array = $this->move_back_right($current_pos);
		if(!empty($moves_array)){
			$all_moves_array[] = $moves_array;
		}
		
		if(!empty($all_moves_array)){
			return $all_moves_array;
		} else {
			return false;
		}
	}
	
}

	
?>