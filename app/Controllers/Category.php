<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

use App\Models\CategoryModel;

class Category extends BaseController
{


    public function save()
    {
        $data = [
            'name' =>  $this->request->getVar('name'),
            'parent_id' => $this->request->getVar('parent_id') ? $this->request->getVar('parent_id') : null
        ];

        $model = new CategoryModel();
        $model->insert($data);
        $db = \Config\Database::connect();
        echo json_encode(array(
            "statusCode" => 200,
            "id" => $db->insertID()

        ));
    }



    //--------------------------------------------------------------------

}
