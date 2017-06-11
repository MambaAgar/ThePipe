<?php
/**
 * Created by PhpStorm.
 * User: glyczak
 * Date: 6/9/17
 * Time: 10:21 AM
 */

$pdo = new PDO("odbc:Driver={SQL Server};Server=.\\SQLEXPRESS;Database=ThePipe;", 'ThePipe', 'ga.wamik.ThePipe');

function sqlsrv_escape($data) {
    if(is_numeric($data))
        return $data;
    $unpacked = unpack('H*hex', $data);
    return '0x' . $unpacked['hex'];
}