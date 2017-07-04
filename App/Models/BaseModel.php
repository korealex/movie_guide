<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:43 PM
 */
abstract class BaseModel
{
    protected $connection = 'mysql';
    protected $primary_key = 'id';
    protected $table ;
    protected $fillables ;
    protected $hidden ;
    protected $original = [];
    protected $attributes = [];
    /**
     * @var QueryBuilder
     */
    protected $builder;

    function __construct(array $attributes = [])
    {
        $this->init();
        $this->fill($attributes);

    }
    private function init(){
        $this->builder = new QueryBuilder($this->getConfig());
    }
    private function fill(array $attributes = []){
        $this->attributes = $attributes;
        foreach ($this->attributes as $key=>$value){

            if(in_array($key,$this->fillables)){
                $this->$key = $value;
            }
        }
    }

    private function getConfig(){
        return [
            'connection'=>$this->connection,
            'primary_key'=>$this->primary_key,
            'table'=>$this->table
            ];
    }

    public function find($id){
        return $this->builder->where($this->table,$this->primary_key,"=",$id);
    }

    public function update(array $attributes = []){
        return $this->builder->update($this->table, $attributes, $this->primary_key, $attributes['id']);
    }

    public function create(array $attributes = []){
        return $this->builder->insert($this->table, $attributes);
    }
    public function delete($id){
        return $this->builder->delete($this->table,$this->primary_key,$id);
    }




}