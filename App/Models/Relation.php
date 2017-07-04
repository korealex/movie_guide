<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 07-03-17
 * Time: 11:50 PM
 */
class Relation
{
    /**
     * @var QueryBuilder
     */
    protected $builder;
    /**
     * @var \App\Models\BaseModel;
     */
    protected $obj;
    protected $fk;
    protected $parent_id;


    function __construct($className, $fk, $parent_id)
    {
        $this->obj = new $className();
        $this->fk = $fk;
        $this->parent_id = $parent_id;
        $this->init();
    }
    private function init(){
        $this->builder = new QueryBuilder();
    }
    public function get(){
        return $this->obj->where($this->fk,$this->parent_id);
    }

}