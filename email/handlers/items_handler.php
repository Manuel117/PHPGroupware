<?php

class ItemsHandler {
    function get($id) {
		global $mstch;
		$categories = get_categories();
		$items = get_items_bycat($id);
		$detail = get_detail_bypos(1);
		echo $mstch->render('principal', array(
			'categories' => $categories,
			'items' => $items,
			'detail'=> $detail));
    }
}