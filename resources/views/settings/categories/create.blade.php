<form method="POST" action="{{ route('settings.categories.store') }}">
    @csrf
    <input type="text" name="name">
    <button type="submit">Cadastrar</button>
</form>
