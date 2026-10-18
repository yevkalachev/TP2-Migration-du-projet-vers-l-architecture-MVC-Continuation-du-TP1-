{{ include('layouts/header.php', {title: 'Modifier catégorie'}) }}
<div class="container">
    <form action="{{ base }}/categorie/edit?id={{ categorie.id }}" method="post">
        <h2>Modifier catégorie</h2>
        <input type="hidden" name="id" value="{{ categorie.id }}">

        <label>Nom <input type="text" name="nom" value="{{ categorie.nom }}"></label>
        {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}

        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}