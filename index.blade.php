<h1>Liste des Participants</h1>

<a href="/participants/create">Créer un participant</a>

<form action="/participants" method="GET">
    <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}">
    <button type="submit">Rechercher</button>
</form>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($participants as $participant)
        <tr>
            <td>{{ $participant->first_name }}</td>
            <td>{{ $participant->last_name }}</td>
            <td>{{ $participant->email }}</td>
            <td>{{ $participant->phone }}</td>
            <td>
                <a href="/participants/{{ $participant->id }}/edit">Modifier</a>
                <form action="/participants/{{ $participant->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Supprimer ?')">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
