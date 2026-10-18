{{ include('layouts/header.php', {title: 'Détail livre'}) }}
<div class="container">
    <h1>{{ livre.titre }}</h1>
    <p><strong>Année :</strong> {{ livre.annee }}</p>
    <p><strong>Prix :</strong> {{ livre.prix|number_format(2) }} $</p>
    <p><strong>Auteur :</strong> {{ livre.auteur_prenom }} {{ livre.auteur_nom }}</p>
    <p><strong>Catégories :</strong>
        {% if categories is empty %} — {% else %}
            {% for c in categories %}
                <span class="badge">{{ c.nom }}</span>
            {% endfor %}
        {% endif %}
    </p>
    <a href="{{ base }}/livre/edit?id={{ livre.id }}" class="btn">Modifier</a>
    <form action="{{ base }}/livre/delete" method="post" class="inline-form">
        <input type="hidden" name="id" value="{{ livre.id }}">
        <input type="submit" value="Supprimer" class="btn red" onclick="return confirm('Supprimer ce livre ?')">
    </form>
    <a href="{{ base }}/livre" class="btn">Retour</a>
</div>
{{ include('layouts/footer.php') }}