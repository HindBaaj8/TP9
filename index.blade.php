<h1>Liste des événements</h1>

<form method="GET" action="/events">
    <input type="text" name="search" placeholder="Recherche..." value="{{ request('search') }}">
    <button type="submit">Rechercher</button>
</form>

<a href="/events/create">Créer un nouvel événement</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    <a href="/events/{{ $event->id }}">Voir</a> |
                    <a href="/events/{{ $event->id }}/edit">Modifier</a> |
                    <form action="/events/{{ $event->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


