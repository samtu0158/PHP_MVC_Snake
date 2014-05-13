<?php
namespace MySnake;
require 'snake_control.php';
require 'snake_model.php';
require 'snake_view.php';

ncurses_init();
ncurses_curs_set(0);

$SnakeModel = new snake_model();
$SnakeView = new snake_view();
$SnakeControl = new snake_control();

$SnakeControl->registermodel($SnakeModel);
$SnakeModel->registerview($SnakeView);
$SnakeControl->run();

ncurses_end();

?>
