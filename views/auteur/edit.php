{{ include('layouts/header.php', {title: 'Modifier auteur'}) }}
<div class="container">
    <form action="{{ base }}/auteur/edit?id={{ auteur.id }}" method="post">
        <h2>Modifier auteur</h2>
        <input type="hidden" name="id" value="{{ auteur.id }}">

        <label>Nom <input type="text" name="nom" value="{{ auteur.nom }}"></label>
        {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}

        <label>Prénom <input type="text" name="prenom" value="{{ auteur.prenom }}"></label>
        {% if errors.prenom is defined %}<span class="error">{{ errors.prenom }}</span>{% endif %}

        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}