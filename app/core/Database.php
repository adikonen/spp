<?php 

class Database
{
    /**
     * @param PDO|null $conn
     * koneksi db dengan PDO
     */
    protected $conn;

    /**
     * @param PDOStatement|bool $stmt
     * statement dari hasil preparedStatement PDO $conn
     */
    protected PDOStatement $stmt;

    public function __construct()
    {
        $host = DB_HOST;
        $db_name = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $conn = new PDO("mysql:host=$host;dbname=$db_name",$user,$pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->conn = $conn;
    }

    /**
     * melakukan bind prepared statement pada variable stmt
     * @param string|int|bool|null $param
     * @param string $value
     * @return self
     */
    public function bind($param, $value) 
    {
        $type = PDO::PARAM_STR;

        $gettedType = strtolower(gettype($param));
       
        if ($gettedType == 'integer') {
            $type = PDO::PARAM_INT;
        }        

        if ($gettedType == 'null') {
            $type = PDO::PARAM_NULL;
        }

        if ($gettedType == 'boolean') {
            $type = PDO::PARAM_BOOL;
        }

        $this->stmt->bindValue($param, $value, $type);
        return $this;
    }

    /**
     * @param bool $condition
     * 
     * $callback mempunyai parameter yaitu $db (tipe datanya adalah class Database)
     * @param Callable $callback
     * @return self
     */
    public function when($condition, $callback)
    {
        if ($condition) {
            $callback($this);
        }

        return $this;
    }

    /**
     * melakukan query ke database dengan prepared statement
     * @param string $q
     * @return self
     */
    public function query($q)
    {
        $this->stmt = $this->conn->prepare($q);
        return $this;
    }

    /**
     * eksekusi prepared statement pada stmt
     * @return void
     */
    public function execute()
    {
        $this->stmt->execute();
    }

    /**
     * mendapatkan semua nilai dari db sesuai query dalam bentuk array
     * @return array<array<string,mixed>>
     */
    public function get()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * mendapatkan record pertama dari db sesuai query
     * @return array<string,mixed>|null
     */
    public function first()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * mendapatkan record pertama dari db sama seperti first
     * namun jika tidak dapat akan dilempar ke redirector dan memberikan
     * flash message
     * 
     * @param string $onFailureMessage
     * @return array<string,mixed>|never
     */
    public function firstOrFail($onFailureMessage)
    {
        $data = $this->first();
        if ($data != null) {
            return $data;
        }
        
        Flasher::set('danger', $onFailureMessage, 404);
        return redirect('redirector/index');
    }

    /**
     * mendapatkan primary key terahkir kali
     * @return int
     */
    public function lastInsertId()
    {
        $this->execute();
        return $this->conn->lastInsertId();
    }

    /**
     * mendapatkan jumlah angka dari db sesuai query
     * @return int
     */
    public function rowCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }

    /**
     * melakukan start transaksi pada pdo
     * @return void
     */
    public function beginTransaction()
    {
        $this->conn->beginTransaction();
    }

    /**
     * rollback transaction
     * @return void
     */
    public function rollback()
    {
        $this->conn->rollback();
    }

    /**
     * commit transaction
     * @return void
     */
    public function commit()
    {
        $this->conn->commit();
    }
}