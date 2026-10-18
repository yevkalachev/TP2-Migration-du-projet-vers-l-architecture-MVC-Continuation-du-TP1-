<?php
use App\Controllers\HomeController;
use App\Controllers\LivreController;
use App\Controllers\AuteurController;
use App\Controllers\CategorieController;
use App\Routes\Route;

// Accueil
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Livres
Route::get('/livre', 'LivreController@index');
Route::get('/livre/show', 'LivreController@show');
Route::get('/livre/create', 'LivreController@create');
Route::post('/livre/create', 'LivreController@store');
Route::get('/livre/edit', 'LivreController@edit');
Route::post('/livre/edit', 'LivreController@update');
Route::post('/livre/delete', 'LivreController@delete');

// Auteurs
Route::get('/auteur', 'AuteurController@index');
Route::get('/auteur/create', 'AuteurController@create');
Route::post('/auteur/create', 'AuteurController@store');
Route::get('/auteur/edit', 'AuteurController@edit');
Route::post('/auteur/edit', 'AuteurController@update');
Route::post('/auteur/delete', 'AuteurController@delete');

// Catégories
Route::get('/categorie', 'CategorieController@index');
Route::get('/categorie/create', 'CategorieController@create');
Route::post('/categorie/create', 'CategorieController@store');
Route::get('/categorie/edit', 'CategorieController@edit');
Route::post('/categorie/edit', 'CategorieController@update');
Route::post('/categorie/delete', 'CategorieController@delete');

