<?php
namespace App\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Categorie;
use App\Providers\View;
use App\Providers\Validator;

class LivreController
{
    public function index()
    {
        $livre = new Livre;
        $livres = $livre->selectAllWithRelations();
        return View::render('livre/index', ['livres' => $livres]);
    }

    public function show($data = [])
    {
        if (!isset($data['id']) || $data['id'] == null) {
            return View::render('error', ['msg' => 'Code 404 - Page not found']);
        }
        $livre = new Livre;
        $l = $livre->selectByIdWithRelations($data['id']);
        if (!$l) {
            return View::render('error', ['msg' => 'Livre introuvable']);
        }
        $cats = $livre->getCategories($data['id']);
        return View::render('livre/show', ['livre' => $l, 'categories' => $cats]);
    }

    public function create()
    {
        $auteurs = (new Auteur)->select('nom');
        $categories = (new Categorie)->select('nom');
        return View::render('livre/create', [
            'auteurs' => $auteurs,
            'categories' => $categories
        ]);
    }

    public function store($data = [])
    {
        $val = new Validator;
        $val->field('titre', $data['titre'])->required()->min(2)->max(150);
        $val->field('annee', $data['annee'])->int(); // Changed to 'annee'
        $val->field('prix', $data['prix'])->float();
        $val->field('id_auteur', $data['id_auteur'], 'Auteur')->required()->int();

        if ($val->isSuccess()) {
            $livre = new Livre;
            $id = $livre->insert($data);
            if ($id) {
                $livre->setCategories((int)$id, $data['categories'] ?? []);
                return View::redirect('livre/show?id=' . $id);
            }
        }

        $errors = $val->getErrors();
        $auteurs = (new Auteur)->select('nom');
        $categories = (new Categorie)->select('nom');
        return View::render('livre/create', [
            'errors' => $errors,
            'livre' => $data,
            'auteurs' => $auteurs,
            'categories' => $categories
        ]);
    }

    public function edit($data = [])
    {
        if (!isset($data['id']) || $data['id'] == null) {
            return View::render('error', ['msg' => 'Code 404 - Page not found']);
        }
        $livreModel = new Livre;
        $livre = $livreModel->selectId($data['id']);
        if (!$livre) {
            return View::render('error', ['msg' => 'Livre introuvable']);
        }
        $livreCats = array_column($livreModel->getCategories($data['id']), 'id');
        $auteurs = (new Auteur)->select('nom');
        $categories = (new Categorie)->select('nom');
        return View::render('livre/edit', [
            'livre' => $livre,
            'livreCats' => $livreCats,
            'auteurs' => $auteurs,
            'categories' => $categories
        ]);
    }

    public function update($data = [], $get = [])
    {
        if (!isset($get['id']) || $get['id'] == null) {
            return View::render('error', ['msg' => 'Code 404 - Page not found']);
        }
        $val = new Validator;
        $val->field('titre', $data['titre'])->required()->min(2)->max(150);
        $val->field('annee', $data['annee'])->int(); // Changed to 'annee'
        $val->field('prix', $data['prix'])->float();
        $val->field('id_auteur', $data['id_auteur'], 'Auteur')->required()->int();

        if ($val->isSuccess()) {
            $livre = new Livre;
            $livre->update($data, $get['id']);
            $livre->setCategories((int)$get['id'], $data['categories'] ?? []);
            return View::redirect('livre/show?id=' . $get['id']);
        }

        $errors = $val->getErrors();
        $livreModel = new Livre;
        $livre = $livreModel->selectId($get['id']);
        $livreCats = array_column($livreModel->getCategories($get['id']), 'id');
        $auteurs = (new Auteur)->select('nom');
        $categories = (new Categorie)->select('nom');
        return View::render('livre/edit', [
            'errors' => $errors,
            'livre' => $data,
            'livreCats' => $livreCats,
            'auteurs' => $auteurs,
            'categories' => $categories
        ]);
    }

    public function delete($data = [])
    {
        $livre = new Livre;
        $delete = $livre->delete($data['id']);
        if ($delete) {
            return View::redirect('livre');
        }
        return View::render('error', ['msg' => 'Erreur de suppression']);
    }
}