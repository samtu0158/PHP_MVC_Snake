<?php

namespace MySnake;

class snake_control{
   private $SnakeModel;

   public function registermodel($snake_model){
	   $this->SnakeModel = $snake_model;
   }

   public function run(){
	   $this->SnakeModel->initGame();
	   while(true){
		   $key = $this->GetInputKey();
		   if($key == 'x'){
			   break;
		   }
		   else{
			   $this->SnakeModel->handleKeyAndMovement($key);
			   $this->SnakeModel->UpdateView();
		           usleep(100*1000);
		   }
	   }
   }

   private function GetInputKey(){
	   $file = fopen('php://stdin', 'r');
	   stream_set_blocking($file, false);
	   return fread($file, 1);
   }

}

?>
