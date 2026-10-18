{{ include('layouts/header.php', {title: 'Livres'}) }}
<h1>Livres</h1>
<table>
    <tr>
        <th>ID</th><th>Titre</th><th>Année</th><th>Prix</th><th>Auteur</th><th>Actions</th>
    </tr>
    {% for livre in livres %}
    <tr>
        <td>{{ livre.id }}</td>
        <td><a href="{{ base }}/livre/show?id={{ livre.id }}">{{ livre.titre }}</a></td>
        <td>{{ livre.annee }}</td>
        <td>{{ livre.prix|number_format(2) }} $</td>
        <td>{{ livre.auteur_prenom }} {{ livre.auteur_nom }}</td>
        <td>
            <div class="actions">
                <a href="{{ base }}/livre/edit?id={{ livre.id }}" class="btn">Modifier</a>
                <form action="{{ base }}/livre/delete" method="post">
                    <input type="hidden" name="id" value="{{ livre.id }}">
                    <input type="submit" value="Supprimer" class="btn red" onclick="return confirm('Supprimer ce livre ?')">
                </form>
            </div>
        </td>
    </tr>
    {% endfor %}
</table>
<br>
<a href="{{ base }}/livre/create" class="btn">Nouveau livre</a>
{{ include('layouts/footer.php') }}