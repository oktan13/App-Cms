<?php

namespace Engine\Core\Database;

use \PDO;

class Connection
{
    private $link;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Установка соединения с базой данных
     * @return $this
     */
    private function connect()
    {
        $config = [
            'host' => 'localhost',
            'db_name' => 'pdo_test',
            'user' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ];

        $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['db_name'] . ';charset=' . $config['charset'];

        $this->link = new PDO($dsn, $config['user'], $config['password']);

        return $this;
    }

    /**
     * Выполняет запрос к БД
     * @param $sqlQuery
     * @return mixed
     */
    public function execute($sqlQuery):bool
    {
        $request = $this->link->prepare($sqlQuery);
        return $request->execute();
    }

    /**
     * Выполняет выборку из БД и возвращает массив с данными
     * @param $sqlQuery
     * @return array
     */
    public function query($sqlQuery): array
    {
        $request = $this->link->prepare($sqlQuery);

        $request->execute();

        $result = $request->fetchALL(PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return $result;
    }
}