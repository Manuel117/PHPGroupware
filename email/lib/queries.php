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

function get_detail_byId($id) {
    $query = SQLite::getInstance()->prepare("SELECT * FROM mailmessage WHERE id=:id");
    $query->bindValue(':id', strval($id), PDO::PARAM_STR);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}