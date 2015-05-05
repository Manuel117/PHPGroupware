<?php

class DetailHandler {
    function get($catId,$id) {
		global $mstch;
		$categories = get_categories();
		$items = get_items_bycat($catId);
		$detail = get_detail_byId($id);
		echo $mstch->render('principal', array(
			'categories' => $categories,
			'items' => $items,
			'detail'=> $detail,
			'catId'=>$catId));
    }
	function post() {
		global $mstch;
		$categories = get_categories();
		$items = get_items_bycat($catId);
		$detail = get_detail_byId($id);
		echo $mstch->render('principal', array(
			'categories' => $categories,
			'items' => $items,
			'detail'=> $detail,
			'catId'=>$catId));
	}
}