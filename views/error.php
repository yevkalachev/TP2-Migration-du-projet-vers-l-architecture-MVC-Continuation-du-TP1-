{{ include('layouts/header.php', {title: 'Erreur'}) }}
<div class="container">
    <h2>Erreur</h2>
    <strong class="error">{{ msg }}</strong>
</div>
{{ include('layouts/footer.php') }}