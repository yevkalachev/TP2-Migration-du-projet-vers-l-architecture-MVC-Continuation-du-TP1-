{{ include('layouts/header.php', {title: 'Auteurs'}) }}
<h1>Auteurs</h1>
<table>
    <tr>
        <th>ID</th><th>Nom</th><th>Prénom</th><th>Actions</th>
    </tr>
    {% for auteur in auteurs %}
    <tr>
        <td>{{ auteur.id }}</td>
        <td>{{ auteur.nom }}</td>
        <td>{{ auteur.prenom }}</td>
        <td>
            <div class="actions">
                <a href="{{ base }}/auteur/edit?id={{ auteur.id }}" class="btn">Modifier</a>
                <form action="{{ base }}/auteur/delete" method="post">
                    <input type="hidden" name="id" value="{{ auteur.id }}">
                    <input type="submit" value="Supprimer" class="btn red"
                        onclick="return confirm('Supprimer cet auteur ?')">
                </form>
            </div>
        </td>
    </tr>
    {% endfor %}
</table>
<br>
<a href="{{ base }}/auteur/create" class="btn">Nouvel auteur</a>
{{ include('layouts/footer.php') }}