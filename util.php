<?php
/**
 * This function is getting the pdo object which executes the sql
 * @param string $sql
 * @param array $data
 * @param boolean $returnBoolean //if we use this parameter it returns the execute booelan
 * @return object | boolean
 */
function getConObjResult($sql, $data = array(), $returnBoolean = false) {
    global $conn;
    $pdo = $conn->prepare($sql);
    if ($returnBoolean) {
        return $pdo->execute($data);
    } else {
        if ($data) {
            $pdo->execute($data);
        } else {
            $pdo->execute();
        }
        return $pdo;
    }
}

/**
 * This function is getting fetch mode results;
 * @param string $sql
 * @param array $data
 * @param string $type
 * @return array
 */
function getFetchModeResults($sql, $data = array(), $type = "") {
    if ($data) {
        $pdo = getConObjResult($sql, $data);
    } else {
        $pdo = getConObjResult($sql);
    }
   	$pdo->setFetchMode(PDO::FETCH_ASSOC);
   	if ($type) {
   	    while ($row = $pdo->fetch()) {
            $results = $row;
        }
   	} else {
   	    while ($row = $pdo->fetch()) {
            $results[] = $row;
        }
    }
    return $results;
}

/**
 * This is the wrapper of function "getFetchModeResults"
 * @param string $sql
 * @param array $data
 */
function getFetchModeResultsAsRow($sql, $data = array()) {
    return getFetchModeResults($sql, $data, "rowArray");
}

/**
 * This is the wrapper of function "getFetchModeResults"
 * @param string $sql
 * @param array $data
 */
function getFetchModeResultsAsArray($sql, $data = "") {
    return getFetchModeResults($sql, $data);
}