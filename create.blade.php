<h1>Créer un événement</h1>

<form method="POST" action="/events">
    @csrf
    <label>Title:</label>
    <input type="text" name="title"><br>

    <label>Description:</label>
    <textarea name="description"></textarea><br>

    <label>Date:</label>
    <input type="date" name="date"><br>

    <label>Location:</label>
    <input type="text" name="location"><br>

    <label>Speakers:</label><br>
    @foreach($speakers as $speaker)
        <input type="checkbox" name="speakers[]" value="{{ $speaker->id }}">
        {{ $speaker->name }}<br>
    @endforeach

    <button type="submit">Créer</button>
</form>
<a href="/events">Retour</a>
