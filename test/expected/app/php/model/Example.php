<?php

require_once("DataBase.php");

class Example
{
  var $database;

  public function __construct() {
    $this->database = new DataBase();
  }

  public function all( $params ) {
  	$sql  = "";
    $sql .= " SELECT * ";
    $sql .= " FROM EXAMPLE ";
    $sql .= " WHERE ACTIVE = " . $params['active'];
    $sql .= " ORDER BY EXAMPLE.NAME ";

	  $retorno = $this->database->select_sql( $sql );
	  // foreach ($retorno as $key => $value) {
		//  $retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
	  // }

	  return $retorno;
  }

  public function edit( $params ) {
	  $code = utf8_decode($params['code']);

  	$sql  = "";
    $sql .= " SELECT * FROM EXAMPLE ";
    $sql .= " WHERE ID_EXAMPLE = " . $code;

	  $retorno = $this->database->select_sql( $sql );
	  //foreach ($retorno as $key => $value) {
		// $retorno[ $key ][ 'NAME' ] = utf8_encode( $value['NAME'] );
	  //}
    return $retorno[0];
  }

  public function save( $params ) {
  	$ID_EXAMPLE = utf8_decode( $params['ID_EXAMPLE'] );
  	$NAME  			= utf8_decode( $params['NAME'] );

  	$params = array(
  		'ID_EXAMPLE' => $ID_EXAMPLE,
  		'NAME' 			 => "'$NAME'"
  	);

  	return (int) $this->database->execute_sp('SX_EXAMPLE', $params);
  }

	public function remove( $params ) {
		$code = utf8_decode($params['code']);
		return $this->database->execute_sql("DELETE FROM EXAMPLE WHERE ID_EXAMPLE = $code ");
	}
}
