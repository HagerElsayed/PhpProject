<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author hagerelsayed
 */
class product {

    private $id;
    private $subcategory_id;
    private $name;
    private $description;
    private $price;
    private $path_id;

    function __construct($id, $subcategory_id, $name, $description, $price, $path_id) {
        $this->id = isset($this->id) ? $this->id : $id;
        $this->subcategory_id = isset($this->subcategory_id) ? $this->subcategory_id : $subcategory_id;
        $this->name = isset($this->name) ? $this->name : name;
        $this->description = isset($this->price) ? $this->price : $price;
        $this->path_id = isset($this->path_id) ? $this->path_id : $path_id;
    }

    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name = $value;
    }

}
