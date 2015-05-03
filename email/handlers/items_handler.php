<?php

class ItemsHandler {
    function get($catId) {
		global $mstch;
		$categories = get_categories();
		$items = get_items_bycat($catId);
		$detail = get_detail_bypos(1);
		echo $mstch->render('principal', array(
			'categories' => $categories,
			'items' => $items,
			'detail'=> $detail,
			'catId'=>$catId));
    }
}