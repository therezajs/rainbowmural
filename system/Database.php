<?php
include_once("constant.php");

class Database{

  public function __construct() {
    if (getenv("HEROKU") === false) {
      //connect to database host
      $connection = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to the database host (please double check the settings in connection.php): ' . mysql_error());

      //connect to the database
      $db_selected = mysql_select_db(DB_DATABASE, $connection) or die ('Could not find a database with the name "'.DB_DATABASE.'" (please double check your settings in connection.php): ' . mysql_error());      }
    else {
      $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"],1);

      $connection = mysql_connect($server, $username, $password) or die('Could not connect to the database host (please double check the settings in connection.php): ' . mysql_error());
      $db_selected = mysql_select_db($db, $connection) or die ('Could not find a database with the name "'.$db.'" (please double check your settings in connection.php): ' . mysql_error());
    }
  }

  //fetches all records from the query and returns an array with the fetched records
  function fetch_all($query) {
    $data = array();
    $result = mysql_query($query);
    while($row = mysql_fetch_assoc($result)) {
      $data[] = $row;
    }
    return $data;
  }

  //fetch the first record obtained from the query
  function fetch_record($query) {
    $result = mysql_query($query);
    return mysql_fetch_assoc($result);
  }
}
