<?php
namespace App\Models;

class Livre extends CRUD
{
    protected $table = 'livre';
    protected $primaryKey = 'id';
    // We removed 'isbn' and 'id_editeur', and changed 'annee_publication' to 'annee'
    protected $fillable = ['titre', 'annee', 'prix', 'id_auteur'];

    public function selectAllWithRelations()
    {
        $sql = "SELECT l.*, a.nom AS auteur_nom, a.prenom AS auteur_prenom
                FROM livre l
                LEFT JOIN auteur a ON l.id_auteur = a.id
                ORDER BY l.id ASC";
        return $this->query($sql)->fetchAll();
    }

    public function selectByIdWithRelations($id)
    {
        $sql = "SELECT l.*, a.nom AS auteur_nom, a.prenom AS auteur_prenom
                FROM livre l
                LEFT JOIN auteur a ON l.id_auteur = a.id
                WHERE l.id = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCategories($idLivre)
    {
        $sql = "SELECT c.* FROM categorie c
                INNER JOIN livre_categorie lc ON c.id = lc.id_categorie
                WHERE lc.id_livre = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $idLivre);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setCategories($idLivre, $idsCategories)
    {
        $del = $this->prepare("DELETE FROM livre_categorie WHERE id_livre = :id");
        $del->bindValue(':id', $idLivre);
        $del->execute();

        if (empty($idsCategories)) return;

        $ins = $this->prepare("INSERT INTO livre_categorie (id_livre, id_categorie) VALUES (:l, :c)");
        foreach ($idsCategories as $idCat) {
            $ins->bindValue(':l', $idLivre);
            $ins->bindValue(':c', $idCat);
            $ins->execute();
        }
    }
}