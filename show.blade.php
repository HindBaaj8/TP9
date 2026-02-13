<h1>{{ $event->title }}</h1>
<p>{{ $event->description }}</p>
<p>Date: {{ $event->date }}</p>
<p>Location: {{ $event->location }}</p>

<h3>Speakers:</h3>
<ul>
    @foreach($event->speakers as $s)
        <li>{{ $s->name }} ({{ $s->pivot->topic }})</li>
    @endforeach
</ul>

<h3>Participants:</h3>
<ul>
    @foreach($event->participants as $p)
        <li>{{ $p->first_name }} {{ $p->last_name }} - {{ $p->email }}</li>
    @endforeach
</ul>

<a href="/events/{{ $event->id }}/pdf">Générer PDF</a> |
<a href="/events/{{ $event->id }}/export">Exporter Excel</a> |
<a href="/events">Retour</a>
