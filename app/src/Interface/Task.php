<?php

require_once(__DIR__ . '../../DB.php');

interface Task
{
  public function execute(DB $db);
}
