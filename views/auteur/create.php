{{ include('layouts/header.php', {title: 'Nouvel auteur'}) }}
<div class="container">
    <form action="{{ base }}/auteur/create" method="post">
        <h2>Nouvel auteur</h2>

        <label>Nom <input type="text" name="nom" value="{{ auteur.nom }}"></label>
        {% if errors.nom is defined %}<span class="error">{{ errors.nom }}</span>{% endif %}

        <label>Prénom <input type="text" name="prenom" value="{{ auteur.prenom }}"></label>
        {% if errors.prenom is defined %}<span class="error">{{ errors.prenom }}</span>{% endif %}

        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}