<?php
require_once "../config.php";

try {
    if ($_GET["action"] == "list") {
        $sql = "select count(*) as RecordCount from book";
        $row = getFetchModeResultsAsRow($sql);
        $recordCount = $row['RecordCount'];
        $sql = "SELECT * FROM book  ORDER BY {$_GET["jtSorting"]} limit {$_GET["jtStartIndex"]} , {$_GET["jtPageSize"]}";
        $rows = getFetchModeResultsAsArray($sql);
        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        $jTableResult['TotalRecordCount'] = $recordCount;
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    }
    else if ($_GET["action"] == "create") {
        $sql = "insert into
                 book(book_name, writer, start_date, finish_date, publisher, language, comment, page_count, grade)
                 values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $data = array (
                $_POST["book_name"],
                $_POST["writer"],
                $_POST["start_date"],
                $_POST["finish_date"],
                $_POST["publisher"],
                $_POST["language"],
                $_POST["comment"],
                $_POST["page_count"],
                $_POST["grade"]
        );
        getConObjResult($sql, $data, true);

        $sql = "select * from book where id = LAST_INSERT_ID()";
        $row = getFetchModeResultsAsRow($sql);

        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    }
    else if ($_GET["action"] == "update") {
        $sql = "update book set
                    book_name = ?,
                    writer = ?,
                    start_date = ?,
                    finish_date = ?,
                    publisher = ?,
                    language = ?,
                    comment = ?,
                    page_count = ?,
                    grade = ?
                    where id = ?";
        $data = $data = array (
                $_POST["book_name"],
                $_POST["writer"],
                $_POST["start_date"],
                $_POST["finish_date"],
                $_POST["publisher"],
                $_POST["language"],
                $_POST["comment"],
                $_POST["page_count"],
                $_POST["grade"],
                $_POST["id"]
        );
        getConObjResult($sql, $data, true);

        $jTableResult = array ();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    else if ($_GET["action"] == "delete") {
        $sql = "delete from book where id = ?";
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