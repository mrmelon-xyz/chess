<?php
include("class.figure.php");
include("class.farmer.php");
include("class.farmer_black.php");
include("class.runner.php");
include("class.tower.php");
include("class.queen.php");
include("class.king.php");
include("class.jumper.php");

if( isset($_GET['Source']) and isset($_GET['SourceClass']) ){
	$sourceID = $_GET['Source'];
	$sourceClass = $_GET['SourceClass'];

	$current_pos = get_current_pos($sourceID);
		
		if($_GET['SourceClass'] == "white_runner" or $_GET['SourceClass'] == "black_runner") {
			$objRunner = new Runner();
			$posib_moves = $objRunner->runner_all_moves($current_pos); 
		}
		
		if($_GET['SourceClass'] == "white_farmer") {
			$objFarmer = new Farmer();
			$posib_moves = $objFarmer->farmer_all_moves($current_pos); 
		}
		
		if($_GET['SourceClass'] == "black_farmer") {
			$objFarmer = new Farmer_Black();
			$posib_moves = $objFarmer->farmer_all_moves($current_pos); 
		}
		
		if($_GET['SourceClass'] == "white_tower" or $_GET['SourceClass'] == "black_tower") {
			$objTower = new Tower();
			$posib_moves = $objTower->tower_all_moves($current_pos); 
		}
		
		if($_GET['SourceClass'] == "white_queen" or $_GET['SourceClass'] == "black_queen") {
			$objQueen = new Queen();
			$posib_moves = $objQueen->queen_all_moves($current_pos); 
		}
		
		if($_GET['SourceClass'] == "white_king" or $_GET['SourceClass'] == "black_king") {
			$objKing = new King();
			$posib_moves = $objKing->king_all_moves($current_pos);
		}
		
		if($_GET['SourceClass'] == "white_jumper" or $_GET['SourceClass'] == "black_jumper") {
			$objJumper = new Jumper();
			$posib_moves = $objJumper->jumper_all_moves($current_pos);
		}
	
	Foreach ($posib_moves as $move) {
		$moves_id_array[] = $move['id'];
	}
	
	
	echo json_encode($moves_id_array);
}

if( isset($_GET['Source']) and isset($_GET['Target']) ){
	$sourceID = $_GET['Source'];
	$targetID = $_GET['Target'];

	echo setNewPosition($sourceID, $targetID);
	
}


	function setNewPosition($sourceID, $targetID) {

		try{ 
			
			$db_pdo = connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$sourceID."'");			
			$record = $stmt->fetchall(PDO::FETCH_ASSOC);
			
			$stmt = $db_pdo->prepare("UPDATE board_table SET current_figure='".$record[0]['current_figure']."' WHERE id='".$targetID."'");			
			$stmt->execute();
			
			$stmt = $db_pdo->prepare("UPDATE board_table SET current_figure='' WHERE id='".$sourceID."'");			
			$stmt->execute();
		
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}

	function get_current_pos($id) {

		try{ 
			
			$db_pdo = connect_db();
			
			$stmt = $db_pdo->query("SELECT * FROM board_table WHERE id='".$id."'");			
			$record = $stmt->fetchall(PDO::FETCH_ASSOC);
			
				$current_pos['x_ref'] = $record[0]['row']; 
				$current_pos['y_ref'] = $record[0]['column']; 
				
			return $current_pos;
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
	
	function connect_db(){
		
		try{ 
		
			 $db_name = 'chess';
			 $db_user = 'root';
			 $db_pass = '';
			 $db_host = 'localhost';
			
			$db_pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
			return $db_pdo;
		}
		catch(PDOException $e){
			
			echo 'Połączenie nie mogło zostać utworzone: ' .$e->getMessage();
		
		}
	}
?>