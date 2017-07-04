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
        $this->className = $className;
        $this->obj = new $className();
        $this->fk = $fk;
        $this->parent_id = $parent_id;
        $this->init();
    }
    private function init(){
        $this->builder = new QueryBuilder();
    }
    public function get(){
        $arr = [];
        $items = $this->obj->where($this->fk,$this->parent_id);
        foreach ($items as $item){
            array_push($arr, new $this->className((array)$item)) ;
        }
        return $arr;
    }
    public function save(BaseModel $model){
         $model->update([$this->fk => $this->parent_id, 'id'=>$model->id]);
    }

    public function saveMany($models){
        foreach ($models as $model){
            $model->update([$this->fk => $this->parent_id]);
        }
    }

}