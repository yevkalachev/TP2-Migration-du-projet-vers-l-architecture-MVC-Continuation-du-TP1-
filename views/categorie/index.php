{{ include('layouts/header.php', {title: 'Catégories'}) }}
<h1>Catégories</h1>
<table>
    <tr>
        <th>ID</th><th>Nom</th><th>Actions</th>
    </tr>
    {% for categorie in categories %}
    <tr>
        <td>{{ categorie.id }}</td>
        <td>{{ categorie.nom }}</td>
        <td>
            <div class="actions">
                <a href="{{ base }}/categorie/edit?id={{ categorie.id }}" class="btn">Modifier</a>
                <form action="{{ base }}/categorie/delete" method="post">
                    <input type="hidden" name="id" value="{{ categorie.id }}">
                    <input type="submit" value="Supprimer" class="btn red"
                        onclick="return confirm('Supprimer cette catégorie ?')">
                </form>
            </div>
        </td>
    </tr>
    {% endfor %}
</table>
<br>
<a href="{{ base }}/categorie/create" class="btn">Nouvelle catégorie</a>
{{ include('layouts/footer.php') }}