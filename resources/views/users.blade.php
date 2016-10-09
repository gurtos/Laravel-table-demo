<!DOCTYPE html>
<html>
	<head>
		<title>Użytkownicy</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{{asset('css/style.css')}}" />
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
			<td><a class="btn" href="edit/{{$person->id}}">edytuj</a>
				<form action="/" method="POST" class="delete-form">
					{!! csrf_field() !!}
					<input type="hidden" name="action" value="delete" />
					<input type="hidden" name="id" value="{{$person->id}}" />
					<button class="btn" href="edit/{{$person->id}}">usuń</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	<a href="new" class="btn">Nowy</a>
</html>