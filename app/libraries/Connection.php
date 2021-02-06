<?php
namespace mvc_php_crud\app\libraries\Connection;
use PDO;//une librairie ecrit en php pour interagir avec la base de donnee
use PDOException ;
class Connection{
    private $dsn='mysql:host=localhost;dbname=mvc_php_crud';
    private $user='root';
    private $password='';
    private $db;
    private $stmt;

    public function __construct()
    {
        try{
        return $this->db=new PDO(
        $this->dsn,
        $this->user,
        $this->password,
        [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_LOWER,

        ]);

        } catch(PDOException $e){
            $msg="Error in " . $e->getFile() . "L" . $e->getLine() . ":" . $e->getMessage();
            die($msg);
        }
    }
     public function query($sql)
        {
            $this->stmt=$this->db->prepare($sql);
        }

    public function bind($param,$value,$type = null)
        {
            # code...
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type= PDO::PARAM_INT;
                    break;
                    case is_bool($value):
                        $type= PDO::PARAM_BOOL;
                    break;
                    case is_null($value):
                        $type= PDO::PARAM_NULL;
                    break;
                    default:
                        $type= PDO::PARAM_STR;
                    break;
                }
            }
            $this->stmt->bindValue($param,$value,$type);
        }

   //Excecute the prepared statement
    public function execute()
   {
       # code...
       return $this->stmt->execute();
   }
   //get result set as array of objects
    public function resultSet()
   { 
    $this->execute();
    return $this->stmt->fetchAll();
    }

    //get single record as object
     public function single()
    {
     # code...
     $this->execute();
     return $this->stmt->fetch();

    }
    public function rowCount()
    {
    # code...
     return $this->stmt->rowCount();
    }


}
?>
