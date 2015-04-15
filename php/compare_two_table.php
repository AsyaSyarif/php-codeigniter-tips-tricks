<?php
$db_config = array(
  'source' => array( 'host' => 'localhost', 'username' => 'root', 'password' => 'root', 'dbname' => 'yurtest_ft' ),
  'target' => array( 'host' => 'localhost', 'username' => 'root', 'password' => 'root', 'dbname' => 'ftuatcom_aht' ),
  );

try {

  // get the list of parameter in target first
  $target_config = $db_config['target'];
  $target_conn = new PDO( "mysql:host=" . $target_config['host'] . ";dbname=" . $target_config['dbname'], $target_config['username'], $target_config['password'] );

  $target_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $target_stmt = $target_conn->prepare( "SELECT `key` FROM parameters" );
  $target_stmt->execute();
  $target_stmt->setFetchMode( PDO::FETCH_OBJ );
  $parameters = array();
  while ( $row = $target_stmt->fetch() ) {
    $parameters[] = $row->key;
  }

  // get parameter to insert

  $source_conn = new PDO( "mysql:host=" . $db_config['source']['host'] . ";dbname=" . $db_config['source']['dbname'], $db_config['source']['username'], $db_config['source']['password'] );

  $source_conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );



  $str_in = join( ',', array_fill( 0, count( $parameters ), '?' ) );
  $sth = $source_conn->prepare( 'SELECT * FROM parameters p WHERE p.key NOT IN(' . $str_in . ')' );
  $sth->execute( $parameters );

  //echo '<pre>' . print_r( $sth, true ) . '</pre>';

  $new_parameters = $sth->fetchAll( PDO::FETCH_OBJ );
  header('Content-Type: text/plain; charset=utf-8');
  echo '-- LIST NEW PARAMETERS -- ' .PHP_EOL;
  foreach($new_parameters as $p) {
    echo '-- ' . $p->key . PHP_EOL;
    echo "INSERT INTO parameters (`description`, `key`, `value`, `category_id`, `active`)
    VALUES ('{$p->description}', '{$p->key}', '{$p->value}', '{$p->category_id}', 1);" . PHP_EOL .PHP_EOL;

  }

  exit;


  $keys = implode( "', '", $parameters );
  $source_stmt = $source_conn->prepare( "SELECT p.* FROM parameters p WHERE p.key NOT IN ('" . $keys . "')" );

  $source_stmt->execute();
  $source_stmt->setFetchMode( PDO::FETCH_OBJ );
  $new_parameters = array();
  while ( $row = $source_stmt->fetch() ) {
    $new_parameters[] = $row->key . ' =  ' . $row->value;
  }

  echo '<pre>' . print_r( $new_parameters, true ) . '</pre>';
}
catch( PDOException $e ) {
  echo "Error: " . $e->getMessage();
}

$target_conn = null;
$source_conn = null;

function pdo_query_in() {

  /* Execute a prepared statement using an array of values for an IN clause */
  $params = array( 1, 21, 63, 171 );

  /* Create a string for the parameter placeholders filled to the number of params */
  $place_holders = implode( ',', array_fill( 0, count( $params ), '?' ) );

  /*
        This prepares the statement with enough unnamed placeholders for every value
        in our $params array. The values of the $params array are then bound to the
        placeholders in the prepared statement when the statement is executed.
        This is not the same thing as using PDOStatement::bindParam() since this
        requires a reference to the variable. PDOStatement::execute() only binds
        by value instead.
    */
  $sth = $dbh->prepare( "SELECT id, name FROM contacts WHERE id IN ($place_holders)" );
  $sth->execute( $params );
}

function pdo_insert_data() {
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "myDBPDO";

  try {
    $conn = new PDO( "mysql:host=$servername;dbname=$dbname", $username, $password );

    // set the PDO error mode to exception
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    // prepare sql and bind parameters
    $stmt = $conn->prepare( "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES (:firstname, :lastname, :email)" );
    $stmt->bindParam( ':firstname', $firstname );
    $stmt->bindParam( ':lastname', $lastname );
    $stmt->bindParam( ':email', $email );

    // insert a row
    $firstname = "John";
    $lastname = "Doe";
    $email = "john@example.com";
    $stmt->execute();

    // insert another row
    $firstname = "Mary";
    $lastname = "Moe";
    $email = "mary@example.com";
    $stmt->execute();

    // insert another row
    $firstname = "Julie";
    $lastname = "Dooley";
    $email = "julie@example.com";
    $stmt->execute();

    echo "New records created successfully";
  }
  catch( PDOException $e ) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
}
