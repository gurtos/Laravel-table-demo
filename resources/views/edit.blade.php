<!DOCTYPE html>
<html>
	<head>
		<title>Użytkownicy</title>
		<meta charset="utf-8" />
		<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
		<script>
			var branches = {
				@foreach($companies as $company)
					'{{$company->id}}' : {
					@foreach($company->branches as $branch)
						{{$branch->id}}:"{{$branch->name}}",
					@endforeach
					},
				@endforeach
			};
			function setBranches(select, selected=0){
				var branchesSelect = $('[name="client[branch]"]');
				branchesSelect.empty();
				for(x in branches[select.val()] ){
					branchesSelect.append( $('<option>', {
						value: x,
						text: branches[select.val()][x]
					}) );
				}
				if(selected>0){
					branchesSelect.val(selected);
				}
			}
			$(document).ready(function(){
				$('[name="company"]').change(function(e){
					setBranches($(this));
				});
				setBranches($('[name="company"]'), {{$person->branch}});
			});
		</script>
	</head>
	<body>
		<h1>Edit</h1>
		<form action="/" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="action" value="{{$action}}" />
			@if($action=="edit")
			<input type="hidden" name="id" value="{{$person->id}}" />
			@endif
			<div class="fields">
				<div class="label">
					<label>Nazwisko</label>
				</div>
				<div class="field">
					<input name="client[surname]" type="text" value="{{$person->surname}}" />
				</div>
				<div class="label">
					<label>Imię</label>
				</div>
				<div class="field">
					<input name="client[name]" type="text" value="{{$person->name}}" />
				</div>
				<div class="label">
					<label>Miejscowość</label>
				</div>
				<div class="field">
					<select name="client[city]">
					@foreach($cities as $city)
						<option value="{{$city->id}}" {{($person->city==$city->id)?"selected":"" }}>{{$city->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="label">
					<label>Data urodzenia</label>
				</div>
				<div class="field">
					<input name="client[birthdate]" type="text" value="{{$person->birthdate}}" />
				</div>
				<div class="label">
					<label>Firma</label>
				</div>
				<div class="field">
					<select name="company">
					@foreach($companies as $company)
						<option value="{{$company->id}}" {{($person->company==$company->id)?"selected":"" }}>{{$company->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="label">
					<label>Oddział</label>
				</div>
				<div class="field">
					<select name="client[branch]">
					</select>
				</div>
			</div>
			<button>Zapisz</button>
		</form>
	</body>
</html>