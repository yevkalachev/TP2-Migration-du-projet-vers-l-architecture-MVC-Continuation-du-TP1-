<?php
namespace App\Controllers;

use App\Models\Auteur;
use App\Providers\View;
use App\Providers\Validator;

class AuteurController
{
    public function index()
    {
        $auteurs = (new Auteur)->select('nom');
        return View::render('auteur/index', ['auteurs' => $auteurs]);
    }

    public function create()
    {
        return View::render('auteur/create');
    }

    public function store($data = [])
    {
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->min(2)->max(45);
        $val->field('prenom', $data['prenom'])->required()->min(2)->max(45);

        if ($val->isSuccess()) {
            (new Auteur)->insert($data);
            return View::redirect('auteur');
        }

        return View::render('auteur/create', [
            'errors' => $val->getErrors(),
            'auteur' => $data
        ]);
    }

    public function edit($data = [])
    {
        $auteur = (new Auteur)->selectId($data['id']);
        if (!$auteur) {
            return View::render('error', ['msg' => 'Auteur introuvable']);
        }
        return View::render('auteur/edit', ['auteur' => $auteur]);
    }

    public function update($data = [], $get = [])
    {
        $val = new Validator;
        $val->field('nom', $data['nom'])->required()->min(2)->max(45);
        $val->field('prenom', $data['prenom'])->required()->min(2)->max(45);

        if ($val->isSuccess()) {
            (new Auteur)->update($data, $get['id']);
            return View::redirect('auteur');
        }

        return View::render('auteur/edit', [
            'errors' => $val->getErrors(),
            'auteur' => $data
        ]);
    }

    public function delete($data = [])
    {
        (new Auteur)->delete($data['id']);
        return View::redirect('auteur');
    }
}