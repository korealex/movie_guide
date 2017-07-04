<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:50 PM
 */
class QueryBuilder
{
    protected $table;
    function __construct(array $config = null)
    {
        $this->connection = new \PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s', getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_PORT')),
            getenv('DB_USER'), getenv('DB_PASS'));
    }

    public function where($table, $column, $operator, $query)
    {
        $sql = "select * from {$table} where {$column} {$operator} {$query}";
        $query = $this->connection->query($sql);
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function all($table)
    {
        $query = $this->connection->query("select * from {$table}");
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insert($table, $data, $pk = 'id')
    {
        $keys = array_keys($data);
        $keys_string = implode(", ",$keys);
        $vals = "'".implode("', '",$data)."'";
        $sql = "INSERT INTO $table ({$keys_string}) VALUES ({$vals})";
        $query = $this->connection->query($sql);

        if(!$query){
            throw new \Exception($this->connection->errorInfo()[2]);
        }
        return ($data[$pk]);

    }

    public function update($table, $data, $column = 'id', $key )
    {
        $update_query = implode(', ', array_map(
            function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
            $data,
            array_keys($data)
        ));
        $sql =  "UPDATE {$table} SET {$update_query} WHERE {$column} = {$key}";
        $query = $this->connection->query($sql);

        if(!$query){
            throw new \Exception($this->connection->errorInfo()[2]);
        }
        return $key;

    }

    public function delete($table, $column = 'id', $key)
    {
        $sql = "DELETE FROM {$table} WHERE {$column} = {$key}";
        $count = $this->connection->exec($sql);
        return $count;
    }

}