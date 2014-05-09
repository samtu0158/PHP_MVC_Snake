<?php

class snake_view{
   private $main_window;
   private $X_window;
   private $Y_window;

   public function __construct(){
	   $this->main_window = ncurses_newwin(0, 0, 0, 0);
	   ncurses_wrefresh($this->main_window);
	   ncurses_getmaxyx($this->main_window, $this->Y_window, $this->X_window);
   }

   public function getWindowsXAndY(&$x_window,&$y_window){
	   $x_window = $this->X_window;
	   $y_window = $this->Y_window;
   }

   public function draw($hasFood, $hasEnded, $snake_body, $food){
	   ncurses_wclear($this->main_window);

	   ncurses_wrefresh($this->main_window);
	   ncurses_getmaxyx($this->main_window, $winy, $winx);

	   ncurses_wborder($this->main_window, 0, 0, 0, 0, 0, 0, 0, 0);
	   
	   if($hasEnded){
	   	$text = 'GAME OVER';
	   
	        ncurses_wmove($this->main_window, $winy/2, ($winx - strlen($text))/2);
	        ncurses_waddstr($this->main_window, $text);
	        ncurses_wrefresh($this->main_window);			
	        return;
	   }

	   ncurses_wattron($this->main_window, NCURSES_A_REVERSE);
	   foreach($snake_body as $s){
		ncurses_wmove($this->main_window, $s[1], $s[0]);
		ncurses_waddstr($this->main_window, ' ');
	   }

	   ncurses_wattroff($this->main_window, NCURSES_A_REVERSE);

	   if($hasFood){
		ncurses_wmove($this->main_window, $food[1], $food[0]);
		ncurses_waddstr($this->main_window, '*');
	   }

	   ncurses_wmove($this->main_window, 0, 0);
	   ncurses_wrefresh($this->main_window);
   }
}

?>
