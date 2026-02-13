<h1>Liste des Speakers</h1>

<a href="/speakers/create">Créer un speaker</a>

<form action="/speakers" method="GET">
    <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}">
    <button type="submit">Rechercher</button>
</form>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($speakers as $speaker)
        <tr>
            <td>{{ $speaker->name }}</td>
            <td>{{ $speaker->email }}</td>
            <td>
                <a href="/speakers/{{ $speaker->id }}/edit">Modifier</a>
                <form action="/speakers/{{ $speaker->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer ?')">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
