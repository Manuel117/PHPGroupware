<?php

class DetailHandler {
    function get($slug) {
		global $mstch;
		echo $mstch->render('detail', array('planet' => 'world'));
    }
}