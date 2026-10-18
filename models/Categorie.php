<?php
namespace App\Models;

class Categorie extends CRUD
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    protected $fillable = ['nom'];
}