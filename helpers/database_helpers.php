<?php
# -----------------------
# File : database_helpers.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# -----------------------

class DBHelpers{
    private static $instance = null;

    private $hostname;
    private $user;
    private $password;
    private $port;
    private $driver;

    # ---------------
    # function DBHelpers
    # Behaviour : Default constructor
    # Input :
    #   o $hotname as string
    #   o $user as string
    #   o $password as string
    #   o $dbname as string
    #   o $port as int (optionnal)
    #   o $driver as string (optionnal)
    # Output: none
    # ---------------
    public function DBHelpers($hostname, $user, $password, $dbname, $port = 3306, $driver = 'mysql'){
        $this->hostname     = $hostname;
        $this->user         = $user;
        $this->password     = $password;
        $this->db           = $dbname;
        $this->port         = $port;
        $this->driver       = $driver;
    }

    # ---------------
    # function getDSN
    # Behaviour : Return formated string
    # Input : none
    # Output: string
    # ---------------
    private function getDSN(){
        return "$this->driver:host=$this->hostname;dbname=$this->db";
    }

    # ---------------
    # function select
    # Behaviour : execute query and return array object of $class
    # Input : $sql : string, $class : string
    # Output: array
    # ---------------
    public function select($sql, $class){
        $dbh = $this->connect();
        $stmt = $dbh->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
    }

    # ---------------
    # function create
    # Behaviour : execute query, return the number of modified row, or false
    # Input : $sql : string
    # Output: int or false
    # ---------------
    public function create($sql)
    {

        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);

        try {
            if ($stmt->execute())
                $retour = $stmt->rowCount();
            else
                $retour = false;
        }catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) {
                echo "toto";
            }
        }

        return $retour;
    }

    # ---------------
    # function update
    # Behaviour : execute query, return the number of modified row, or false
    # Input : $sql : string
    # Output: int or false
    # ---------------
    public function update($sql){
        $dbh = $this->connect();
        $stmt = $dbh->prepare($sql);

        if($stmt->execute())
            $retour = $stmt->rowCount();
        else
            $retour = false;

        return $retour;
    }

    # ---------------
    # function delete
    # Behaviour : execute query, return true if execution went well, else false
    # Input : $sql : string
    # Output: true or false
    # ---------------
    public function delete($sql){
        $dbh = $this->connect();

        if($dbh->exec($sql))
            $retour = true;
        else
            $retour = false;

        return $retour;
    }

    # ---------------
    # function connect
    # Behaviour : create a connection to database
    # Input : none
    # Output: null or PDO object
    # ---------------
    private function connect(){
        $pdo = null;
        try{
            $pdo = new PDO($this->getDSN(), $this->user, $this->password);
        }catch (Exception $e){
            throw new Exception( "Connexion à la base de données impossible." );
        }
        return $pdo;
    }

    # ---------------
    # function static getDBHelpers
    # Behaviour : Check if any singleton instance exist, if not, instanciate one and return it
    # Input : none
    # Output: DBHelpers instance
    # ---------------
    public static function getDBHelpers(){
        if (is_null(DBHelpers::$instance))
            DBHelpers::$instance = new DBHelpers(Configuration::getConfiguration("db_adress"),
                Configuration::getConfiguration("db_user"),
                Configuration::getConfiguration("db_password"),
                Configuration::getConfiguration("db_name"));

        return DBHelpers::$instance;
    }

}
?>