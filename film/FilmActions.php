<?php
require_once "../config.php";

try {
    if ($_GET["action"] == "list") {
        $sql = "select count(*) as RecordCount from film";
        $row = getFetchModeResultsAsRow($sql);
        $recordCount = $row['RecordCount'];
        $sql = "SELECT * FROM film  ORDER BY {$_GET["jtSorting"]} limit {$_GET["jtStartIndex"]} , {$_GET["jtPageSize"]}";
        $rows = getFetchModeResultsAsArray($sql);
        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);

    } else if ($_GET["action"] == "create") {
        $sql = "insert into
                 film(name, director, watch_date, release_date, favourite, comment, grade)
                 values(?, ?, ?, ?, ?, ?, ?)";
        $data = array (
                $_POST["name"],
                $_POST["director"],
                $_POST["watch_date"],
                $_POST["release_date"],
                $_POST["favourite"],
                $_POST["comment"],
                $_POST["grade"]
        );
        getConObjResult($sql, $data, true);

        $sql = "select * from film where id = LAST_INSERT_ID()";
        $row = getFetchModeResultsAsRow($sql);

        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);

    } else if ($_GET["action"] == "update") {
        $sql = "update film set
                    name = ?,
                    director = ?,
                    watch_date = ?,
                    release_date = ?,
                    favourite = ?,
                    comment = ?,
                    grade = ?
                    where id = ?";
        $data = $data = array (
                $_POST["name"],
                $_POST["director"],
                $_POST["watch_date"],
                $_POST["release_date"],
                $_POST["favourite"],
                $_POST["comment"],
                $_POST["grade"],
                $_POST["id"]
        );
        getConObjResult($sql, $data, true);

        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    } else if ($_GET["action"] == "delete") {
        $sql = "delete from film where id = ?";
        getConObjResult($sql, array (
                $_POST["id"]
        ), true);

        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
} catch (Exception $ex) {
    $jTableResult = array ();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}