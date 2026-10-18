{{ include('layouts/header.php', {title: 'Nouvelle catégorie'}) }}
<div class="container">
    <form action="{{ base }}/categorie/create" method="post">
        <h2>Nouvelle catégorie</h2>

        <label>Nom <input type="text" name="nom" value="{{ categorie.nom }}"></label>
        {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}

        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}