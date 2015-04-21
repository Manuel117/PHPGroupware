<?php

class CategoriesHandler {
    function get() {
		global $mstch;
		$categories = get_categories();
		$items = get_items_bycat(1);
		$detail = get_detail_bypos(1);
		echo $mstch->render('principal', array(
			'categories' => $categories,
			'items' => $items,
			'detail'=> $detail));
    }
}