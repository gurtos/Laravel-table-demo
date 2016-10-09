<!DOCTYPE html>
<html>
	<head>
		<title>Użytkownicy</title>
		<meta charset="utf-8" />
	</head>
	<h1>Użytkownicy</h1>
	<table>
		<tr>
			<th>Nazwisko</th>
			<th>Imię</th>
			<th>Miejscowość</th>
			<th>Wiek</th>
			<th>Płeć</th>
			<th>Firma</th>
			<th>Oddział firmy</th>
			<th></th>
		</tr>
		@foreach($people as $person)
		<tr>
			<td>{{$person->surname}}</td>
			<td>{{$person->name}}</td>
			<td>{{$person->city->name}}</td>
			<td>{{$person->age}}</td>
			<td>{{$person->sex}}</td>
			<td>{{$person->company->name}}</td>
			<td>{{$person->branch->name}}</td>
			<td><a class="btn" href="edit/{{$person->id}}">edytuj</a><a class="btn" href="edit/{{$person->id}}">usuń</a></td>
		</tr>
		@endforeach
	</table>
	<a href="new">Nowy</a>
</html>