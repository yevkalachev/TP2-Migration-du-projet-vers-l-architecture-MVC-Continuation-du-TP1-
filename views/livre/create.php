{{ include('layouts/header.php', {title: 'Nouveau livre'}) }}
<div class="container">
    <form action="{{ base }}/livre/create" method="post">
        <h2>Nouveau livre</h2>
        
        <label>Titre <input type="text" name="titre" value="{{ livre.titre }}"></label>
        {% if errors.titre is defined %}<span class="error">{{ errors.titre }}</span>{% endif %}
        
        <label>Année <input type="number" name="annee" value="{{ livre.annee }}"></label>
        {% if errors.annee is defined %}<span class="error">{{ errors.annee }}</span>{% endif %}
        
        <label>Prix <input type="number" step="0.01" name="prix" value="{{ livre.prix }}"></label>
        {% if errors.prix is defined %}<span class="error">{{ errors.prix }}</span>{% endif %}
        
        <label>Auteur
            <select name="id_auteur">
                <option value="">-- Choisir --</option>
                {% for a in auteurs %}
                    <option value="{{ a.id }}">{{ a.prenom }} {{ a.nom }}</option>
                {% endfor %}
            </select>
        </label>
        {% if errors.id_auteur is defined %}<span class="error">{{ errors.id_auteur }}</span>{% endif %}
        
        <fieldset>
            <legend>Catégories</legend>
            {% for c in categories %}
                <label><input type="checkbox" name="categories[]" value="{{ c.id }}"> {{ c.nom }}</label>
            {% endfor %}
        </fieldset>
        
        <input type="submit" class="btn" value="Enregistrer">
    </form>
</div>
{{ include('layouts/footer.php') }}