<!DOCTYPE html>
<html>
	<head>
		<title>Użytkownicy</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="{{asset('css/style.css')}}" />
		<link href="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.css')}}" rel="stylesheet">
		<script src="{{asset('js/jquery-ui-1.12.1.custom/jquery.js')}}"></script>
		<script src="{{asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
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
				$('[name="client[birthdate]"]').datepicker({
					dateFormat: 'yy-mm-dd'
				});
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
				<div class="row">
					<div class="label">
						<label>Nazwisko</label>
					</div>
					<div class="field">
						<input name="client[surname]" type="text" value="{{$person->surname}}" />
					</div>
				</div>
				<div class="row">
					<div class="label">
						<label>Imię</label>
					</div>
					<div class="field">
						<input name="client[name]" type="text" value="{{$person->name}}" />
					</div>
				</div>
				<div class="row">
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
				</div>
				<div class="row">
					<div class="label">
						<label>Data urodzenia</label>
					</div>
					<div class="field">
						<input name="client[birthdate]" type="text" value="{{$person->birthdate}}" />
					</div>
				</div>
				<div class="row">
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
				</div>
				<div class="row">
					<div class="label">
						<label>Oddział</label>
					</div>
					<div class="field">
						<select name="client[branch]">
						</select>
					</div>
				</div>
			</div>
			<button class="btn">Zapisz</button>
		</form>
	</body>
</html>