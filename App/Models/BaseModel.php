<?php

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:43 PM
 */
class BaseModel
{
    protected $connection = 'mysql';
    protected $primary_key = 'id';
    protected $table;
    protected $builder;

    function __construct(array $attributes = [])
    {
        $this->builder = new QueryBuilder($this->$this->getConfig());
    }
    public function getConfig(){
        return [
            'connection'=>$this->connection,
            'primary_key'=>$this->primary_key,
            'table'=>$this->table
            ];

    }

    public function find($id){

    }

    public function update(array $attributes = []){

    }

    public function create(array $attributes = []){

    }
    public function delete($id){

    }



}