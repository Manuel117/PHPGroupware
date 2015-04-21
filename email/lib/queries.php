<?php

function get_categories() {
    $query = SQLite::getInstance()->query("SELECT * FROM mailbox");
    return $query->fetchAll();
}

function get_items_bycat($pos) {
    $query = SQLite::getInstance()->prepare("SELECT * FROM mailmessage WHERE cat_id=:pos");
    $query->bindValue(':pos', strval($pos), PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
}

function get_detail_bypos($pos) {
    $query = SQLite::getInstance()->prepare("SELECT * FROM mailmessage WHERE rowid=:pos");
    $query->bindValue(':pos', strval($pos), PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}