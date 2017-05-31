<?php
/**
 *
 */
class Connection
{
  //private $conn;
  private function connect()
  {
    try {
        $conn = new PDO("mysql:host=127.0.0.1;dbname=testconnect", "root", "1");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
  }
  private function disconnect($conn)
  {
    $conn = null;
  }
  public function select($sql)
  {
    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      $this->disconnect($conn);
      return $result;
    } catch (PDOException $e) {
      return $e;
    }
  }
  public function create($sql)
  {
    try {
      $conn = $this->connect();
      $conn->exec($sql);
      $this->disconnect($conn);
      return 'success';
    } catch (PDOException $e) {
      return $e;
    }
  }

  public function updated($sql)
  {
    try {
      $conn = $this->connect();
      $stmt = $conn->prepare($sql);
      // execute the query
      $stmt->execute();
      $this->disconnect($conn);
      return 'success';
    } catch (PDOException $e) {
      return $e;
    }

  }

  public function delete($sql)
  {
    try {
      $conn = $this->connect();
      $conn->exec($sql);
      $this->disconnect($conn);
      return 'success';
    } catch (PDOException $e) {
      return $e;
    }
  }
}
