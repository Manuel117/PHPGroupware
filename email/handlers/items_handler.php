<?php

class ItemsHandler {
    function get($slug) {
		global $mstch;
		echo $mstch->render('list', array('planet' => 'world'));
    }
}