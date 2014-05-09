<?php

class snake_model{
        private $SnakeView;
	private $snake_body = array();
	private $snake_food = array();
	private $boardSize = array();
	private $MovementX;
	private $MovementY;
	private $hasEnd;

	public function registerview($snake_view){
		$this->SnakeView = $snake_view;
	}

	public function initGame(){
		$this->snake_body = array(
			array(5,5),
			array(6,5)
		);
		$this->SnakeView->getWindowsXAndY($x,$y);
		$this->boardSize[0]=$x;
		$this->boardSize[1]=$y;
		$this->GenerateFood();
		$this->MovementX = 1;
		$this->MovementY = 0;
		$this->hasEnd = false;
	}

	public function UpdateView(){
		$this->SnakeView->draw(1,$this->hasEnd,$this->snake_body,$this->snake_food);
	}

	public function handleKeyAndMovement($key){
		if($key == 'w')
		  $targetMovementY = -1;
		else if($key == 's')
		  $targetMovementY = 1;
		else if($key == 'a')
		  $targetMovementX = -1;
		else if($key == 'd')
		  $targetMovementX = 1;
		else{
		  $targetMovementX = $this->MovementX;
		  $targetMovementY = $this->MovementY;
		}
	        	
		if(count($this->snake_body) > 0)
			$SnakeHead = $this->snake_body[count($this->snake_body)-1];

		$NewSnakeHead = array($SnakeHead[0] + $targetMovementX, $SnakeHead[1] + $targetMovementY);

		if($this->isBlocked($NewSnakeHead)){
			$this->hasEnd = true;
			return;
		}
		else{
			if($targetMovementX != 0) {
				$this->MovementX = $targetMovementX;
				$this->MovementY = 0;
			}
			else if($targetMovementY != 0){
				$this->MovementY = $targetMovementY;
				$this->MovementX = 0;
			}
		}

		if($this->snake_food == $NewSnakeHead){
			$this->GenerateFood();
		}
		else{
			array_shift($this->snake_body);
		}

		$this->snake_body[] = $NewSnakeHead;
	}

	private function GenerateFood(){
		do{
			$this->snake_food = array(
				rand(1, $this->boardSize[0]-1),
				rand(1, $this->boardSize[1]-1)
			);
		}while($this->isBlocked($this->snake_food));
	}

	private function isBlocked($position){
		if($position[0] >= ($this->boardSize[0] - 1) || $position[0] <= 0)
			return true;
		if($position[1] >= ($this->boardSize[1] - 1) || $position[1] <= 0)
			return true;
		foreach($this->snake_body as $s){
			if($s == $position){
				return true;
			}
		}

		return false;
	}
}


?>
