<?php


namespace App\Constraints;


interface ToDoTaskInterface
{
    public function getAll();

    public function get();

    public function insert();

    public function save();

    public function delete();
}
