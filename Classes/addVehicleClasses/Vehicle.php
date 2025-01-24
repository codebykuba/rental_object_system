<?php

require_once __DIR__ . "/../Dbh.php";

abstract class Vehicle extends Dbh{

    protected $vehicle_type;
    protected $brand;
    protected $model;
    protected $color;
    protected $price;

    public function __construct($vehicle_type, $brand, $model, $color, $price) {
        $this->vehicle_type = $vehicle_type;
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->price = $price;
    }

    abstract public function getUniqueData();

    abstract public function uniqueDatatoJSON();

    abstract public function addVehicleToDatabase();
}