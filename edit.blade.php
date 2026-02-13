<h1>Modifier événement</h1>

<form method="POST" action="/events/{{ $event->id }}">
    @csrf
    @method('PUT')
    <label>Title:</label>
    <input type="text" name="title" value="{{ $event->title }}"><br>

    <label>Description:</label>
    <textarea name="description">{{ $event->description }}</textarea><br>

    <label>Date:</label>
    <input type="date" name="date" value="{{ $event->date }}"><br>

    <label>Location:</label>
    <input type="text" name="location" value="{{ $event->location }}"><br>

    <label>Speakers:</label><br>
    @foreach($speakers as $speaker)
        <input type="checkbox" name="speakers[]" value="{{ $speaker->id }}"
            @if($event->speakers->contains($speaker->id)) checked @endif>
        {{ $speaker->name }}<br>
    @endforeach

    <button type="submit">Modifier</button>
</form>
<a href="/events">Retour</a>
