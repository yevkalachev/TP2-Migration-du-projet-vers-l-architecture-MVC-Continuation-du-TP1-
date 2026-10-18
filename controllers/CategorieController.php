<?php
namespace App\Controllers;

use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;

class CategorieController
{
    public function index()
    {
        $categories = (new Categorie)->select('nom');
        return View::render('categorie/index', ['categories' => $categories]);
    }

    public function create()
    {
        return View::render('categorie/create');
    }

    public function store($data = [])
    {
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->min(2)->max(45);

        if ($val->isSuccess()) {
            (new Categorie)->insert($data);
            return View::redirect('categorie');
        }

        return View::render('categorie/create', [
            'errors' => $val->getErrors(),
            'categorie' => $data
        ]);
    }

    public function edit($data = [])
    {
        $categorie = (new Categorie)->selectId($data['id']);
        if (!$categorie) {
            return View::render('error', ['msg' => 'Catégorie introuvable']);
        }
        return View::render('categorie/edit', ['categorie' => $categorie]);
    }

    public function update($data = [], $get = [])
    {
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->min(2)->max(45);

        if ($val->isSuccess()) {
            (new Categorie)->update($data, $get['id']);
            return View::redirect('categorie');
        }

        return View::render('categorie/edit', [
            'errors' => $val->getErrors(),
            'categorie' => $data
        ]);
    }

    public function delete($data = [])
    {
        (new Categorie)->delete($data['id']);
        return View::redirect('categorie');
    }
}