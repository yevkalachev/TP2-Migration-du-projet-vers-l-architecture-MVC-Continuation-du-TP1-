{{ include('layouts/header.php', {title: 'Modifier livre'}) }}
<div class="container">
    <form action="{{ base }}/livre/edit?id={{ livre.id }}" method="post">
        <h2>Modifier livre</h2>
        <input type="hidden" name="id" value="{{ livre.id }}">
        
        <label>Titre <input type="text" name="titre" value="{{ livre.titre }}"></label>
        {% if errors.titre is defined %}<span class="error">{{ errors.titre }}</span>{% endif %}
        
        <label>Année <input type="number" name="annee" value="{{ livre.annee }}"></label>
        {% if errors.annee is defined %}<span class="error">{{ errors.annee }}</span>{% endif %}
        
        <label>Prix <input type="number" step="0.01" name="prix" value="{{ livre.prix }}"></label>
        {% if errors.prix is defined %}<span class="error">{{ errors.prix }}</span>{% endif %}
        
        <label>Auteur
            <select name="id_auteur">
                {% for a in auteurs %}
                    <option value="{{ a.id }}" {% if a.id == livre.id_auteur %}selected{% endif %}>
                        {{ a.prenom }} {{ a.nom }}
                    </option>
                {% endfor %}
            </select>
        </label>
        
        <fieldset>
            <legend>Catégories</legend>
            {% for c in categories %}
                <label><input type="checkbox" name="categories[]" value="{{ c.id }}"
                    {% if c.id in livreCats %}checked{% endif %}> {{ c.nom }}</label>
            {% endfor %}
        </fieldset>
        
        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}