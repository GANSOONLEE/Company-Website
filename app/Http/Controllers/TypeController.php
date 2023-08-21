<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \InvalidArgumentException;

class Map extends Controller{

    private $data;

    public function __construct($input=[]){
        if (!is_array($input) || count(array_filter(array_keys($input), 'is_string')) === 0) {
            throw new InvalidArgumentException("Input must be an associative array.");
        }
        $this->data = $input;
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function remove($key) {
        if (isset($this->data[$key])) {
            unset($this->data[$key]);
        }
    }

    public function toArray() {
        return $this->data;
    }

}