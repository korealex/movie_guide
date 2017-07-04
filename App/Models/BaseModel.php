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
    protected $fillable ;
    protected $hidden ;
    protected $original = [];
    protected $attributes = [];
    protected $relations = [];
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
        $this->builder = new QueryBuilder();
    }
    public function fill(array $attributes = []){
        $this->attributes = $attributes;
        foreach ($this->attributes as $key=>$value){

            if(in_array($key,$this->fillable)){
                $this->$key = $value;
            }
        }
        return $this;
    }

    private function getConfig(){
        return [
            'connection'=>$this->connection,
            'primary_key'=>$this->primary_key,
            'table'=>$this->table
            ];
    }
    public function where($key, $id){
        return $this->builder->where($this->table,$key,"=",$id);
    }
    public function whereRaw($query){
        return $this->builder->whereRaw($this->table,$query);
    }

    public function find($id){
        $results = $this->builder->where($this->table,$this->primary_key,"=",$id);
        return (empty($results))?null:(array)$results[0];
    }

    public function update(array $attributes = []){
        return $this->builder->update($this->table, $attributes, $this->primary_key, $attributes['id']);
    }

    public function create(array $attributes = []){
        $id =  $this->builder->insert($this->table, $attributes);

        if(is_bool($id) && $id ==true){
            return $this;
        }

        $this->fill((array)$this->find($id));
        return $this;
    }
    public function delete($id){
        return $this->builder->delete($this->table,$this->primary_key,$id);
    }
    public function hasOne($className, $fk = 'id'){


    }
    public function hasMany($className, $fk = 'id'){
        return new Relation($className,$fk,$this->id);
    }
    public function hasManyThrough($className,$pivotClassName, $fk = 'id', $other_fk = 'id'){
        return new Relation($className,$fk,$this->id,$pivotClassName);
    }

    public function load($relations = []){
        foreach ($relations as $relation){
            $this->$relation = $this->$relation()->get();
            $this->relations[$relation] =$this->$relation;
        }
    }
    public function toArray(){
        return array_merge($this->attributes, $this->relations) ;
    }








}