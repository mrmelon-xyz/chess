<?php

class Jumper extends Figure {
	
	public function move_forward_right ($temp_pos){

			$new_pos['x_ref'] = $temp_pos['x_ref'] + 1;
			$new_pos['y_ref'] = $temp_pos['y_ref'] + 2;
			
			$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
					
		return $new_pos;
	}
	
	public function move_right_forward ($temp_pos){
	
			$new_pos['x_ref'] = $temp_pos['x_ref'] + 2;
			$new_pos['y_ref'] = $temp_pos['y_ref'] + 1;
			
			$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
			
		return $new_pos;
	}
	
	public function move_right_back ($temp_pos){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] + 2;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - 1;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function move_back_right ($temp_pos){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] + 1;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - 2;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function move_back_left ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - 1;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - 2;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function move_left_back ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - 2;
		$new_pos['y_ref'] = $temp_pos['y_ref'] - 1;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function move_left_forward ($temp_pos, $field_num = 1){
		
		$new_pos['x_ref'] = $temp_pos['x_ref'] - 2;
		$new_pos['y_ref'] = $temp_pos['y_ref'] + 1;
		
		$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
		
		return $new_pos;
	}
	
	public function move_forward_left ($temp_pos){

			$new_pos['x_ref'] = $temp_pos['x_ref'] - 1;
			$new_pos['y_ref'] = $temp_pos['y_ref'] + 2;
			
			$new_pos['id'] = "x".$new_pos['x_ref']."y".$new_pos['y_ref'];
					
		return $new_pos;
	}
	
	public function jumper_all_moves ($current_pos) {
		
		$new_pos = $this->move_forward_right($current_pos);

		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}

		$new_pos = $this->move_right_forward($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}

		$new_pos = $this->move_right_back($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}
		
		$new_pos = $this->move_back_right($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}		

		$new_pos = $this->move_back_left($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}			
		  
		$new_pos = $this->move_left_back($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}

		$new_pos = $this->move_left_forward($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}

		
		$new_pos = $this->move_forward_left($current_pos);
		
		if($this->is_on_board($new_pos)){
			if($this->check_field_empty('x'.$new_pos['x_ref'].'y'.$new_pos['y_ref'])) {
				$moves_array[] = $new_pos;
			}
		}
		
		if(!empty($moves_array)){
			return $moves_array;
		} else {
			return false;
		}
	}
		
}

	
?>