<?php

require_once (__DIR__ . "/../Dbh.php");

abstract class ShowVehicle extends Dbh {

    protected $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;
    }

    abstract protected function getVehicles();

    abstract protected function decodeJsonData();

    abstract protected function storeInSession();
}