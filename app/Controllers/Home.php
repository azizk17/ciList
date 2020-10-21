<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Home extends BaseController
{
	public function index()
	{
		$model = new CategoryModel();
		$cats = $model->getCategories();
		$claen = $this->buildTree($cats);
		// $p = $this->printTree($claen);
		$data['categories'] = $claen;
		// $data['p'] = $p;
		return view('home', $data);
	}

	private function buildTree(array $data, $parent = 0)
	{
		$tree = array();
		foreach ($data as $d) {
			if ($d['parent_id'] == $parent) {
				$children = $this->buildTree($data, $d['id']);
				// set a trivial key
				if (!empty($children)) {
					$d['children'] = $children;
				}
				$tree[] = $d;
			}
		}
		return $tree;
	}
}
