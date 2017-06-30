<?php namespace App\Models;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:50 PM
 */
class QueryBuilder
{
    function __construct(array $config)
    {
        $this->connection = new \PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s', getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_PORT')),
            getenv('DB_USER'), getenv('DB_PASS'));

    }

    public function where()
    {
        $query = $this->connection->query('select * from movie where id = 1');
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public function create()
    {

    }

    public function delete()
    {

    }

}