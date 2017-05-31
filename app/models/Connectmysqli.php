<?php

/**
 *
 */
class Connectmysqli
{
  private function connect()
  {
    $conn = new mysqli('localhost', 'root', '1','testconnect');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
      return $conn;
    }
  }
  private function disconnect($conn)
  {
    $conn->close();
  }

  public function select($sql)
  {
    $conn = $this->connect();
    $result = $conn->query($sql);
    $this->disconnect($conn);
    if ($result->num_rows >= 0) {
      return $result;
    }else {
      return $conn->error;
    }
  }

  public function create($sql)
  {
    $conn = $this->connect();
    if ($conn->query($sql) === TRUE) {
        return 'success';
    } else {
        return $conn->error;
    }
    $this->disconnect($conn);
  }
  public function update($sql)
  {
    $conn = $this->connect();
    if ($conn->query($sql) === TRUE) {
        return 'success';
    } else {
        return $conn->error;
    }
    $this->disconnect($conn);
  }
  public function delete($sql)
  {
    $conn = $this->connect();
    if ($conn->query($sql) === TRUE) {
        return 'success';
    } else {
        return $conn->error;
    }
  }


}
