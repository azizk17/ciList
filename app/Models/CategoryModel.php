<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $allowedFields = [
        'name', 'parent_id'
    ];

    public function getCategories()
    {
        return $this->findAll();
    }
    public function add(String $name)
    {
        # code...
    }
}
