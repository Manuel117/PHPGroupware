<?php

class CategoriesHandler {
    function get() {
		global $mstch;
		echo $mstch->render('principal', array('planet' => 'world'));
    }
}