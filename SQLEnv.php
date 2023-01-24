<?php


class SQLEnv
{
    const SQL_ENV = 'sqlite';
    protected $dbServerSqlite = 'sqlite';
    protected $dbServerMysql = 'mysql';
    protected $mysqlUsername = 'root';
    protected $mysqlPassword = '';
    protected $mysqlDbname = 'my_mvc';
    protected $mysqlHost = 'localhost';
    protected $charSet = 'utf8';
    protected $sqliteDSN = 'sqlite:' . __DIR__ . '/db/sqlite.db';



    /**
     * [Description for PDO_Options]
     *
     * @return Array
     * 
     * Created at: 9/24/2022, 1:38:00 AM (Egypt/Cairo)
     * @author     Aladdin Sami
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami
     */
    function PDO_Options()
    {
        $pdoOptions =
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
        return $pdoOptions;
    }



    /**
     * [Description for dsnMysql]
     *
     * @return string mysql dsn
     * 
     * Created at: 9/24/2022, 2:27:53 AM (Egypt/Cairo)
     * @author     Aladdin Sami
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami
     */
    function dsnMysql(string $dbname)
    {
        if ($dbname === '') {
            $dbname = $this->mysqlDbname;
        }
        return "mysql:host=" . $this->mysqlHost . ";dbname=" . $dbname . ";charset=utf8;";
    }



    /**
     * [Description for mysqlPDO_query]
     * simple query method
     * 
     * @param string $query mysql query often select statement
     * with not any parameter pathing for security
     * 
     * @return mixed
     * usually using fetch() or fetchAll() methods with returned value
     * 
     * Created at: 9/24/2022, 2:47:30 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami
     */
    function mysqlPDO_query(string $query, string $dbname = '')
    {
        $pdo = $this->mysqlPDO_Connect($dbname);
        $stmt = $pdo->query($query);
        return $stmt;
    }



    /**
     * [Description for mysqlPDO_Connect]
     * Make a connection with Mysql Server with given Dbase
     *
     * @param string $dbname
     * 
     * @return mixed
     * 
     * Created at: 9/28/2022, 1:05:41 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function mysqlPDO_Connect(string $dbname = '')
    {
        $dsn = $this->dsnMysql($dbname);
        try {
            $pdo = new \PDO($dsn, $this->mysqlUsername, $this->mysqlPassword, $this->PDO_Options());
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }



    function sqlitePDO_Connect(string $path = '')
    {
        if ($path === '') $path = $this->sqliteDSN;
        $dsn =  $path;
        try {
            $pdo = new \PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            //echo '{"status":0, "line": ' . __LINE__ . '}';
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }



    /**
     * [Description for generalPurpose]
     * not secure enough don't pass variables in query
     * 
     * @param string $query
     * @param string $dbname
     * 
     * @return array
     * 
     * Created at: 9/28/2022, 12:50:13 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function generalPurpose(string $query, string $dbname = '')
    {
        $pdo = $this->mysqlPDO_Connect($dbname);
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        if ($stmt) {
            return $stmt->fetchAll();
        }
    }



    /**
     * [Description for securePurpose]
     * we can pass a params insid query as a place holder ? or :param
     * then pass them inside indexed array for ? placeholder
     * or inside assciated array for :param placeholder
     * all the above arrays passes inside execute([])
     * or make bindParams('pararm', $param) or bindValue('pararm', $param)
     * then excute() without passing arrays
     * 
     * @param string $query
     * @param string $dbname
     * 
     * @return mixed
     * 
     * Created at: 9/28/2022, 12:56:12 AM (Africa/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function securePurpose(string $query, string $dbname = '')
    {
        $pdo = $this->mysqlPDO_Connect($dbname);
        return $pdo->prepare($query);
    }
}