@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
	 <div class="col-lg-12 margin-tb">
		 <div class="pull-left">
			 	<?php
			 	if (request()->continent) {
			 		$continent=request()->continent;
			 		$continentOne=App\Country::where('continent', $continent)->first();//название континента
			 		$continentName=$continentOne->Continent;
			 	}else{
			 		$continentName='All countries';
			 	}
			 	?>
		 	<h2>Countries by Continent <span style="color:#cclclc;">{{$continentName}}</span></h2>
		 </div>
	 </div>
 </div><hr>
  	<div class="row">
 	<div class="col-lg-12 margin-tb">
 		<!--меню - список континентов-->
 		<div class="col-sm-2">
 			<div class="row">
 				<div class="form-group">
 					<a href="{{url('continent')}}" >
 						Все государства
 					</a>
 				</div>
 				@foreach ($continents as $continent)
 				<div class="form-group">
 					<a href="{{url('continentCountry/' .$continent->continent)}}" >
 						{{ $continent->continent }}  
 					</a>
 				</div>
 				@endforeach
 			</div>
 		</div>
 		<!--end menu-->
 	<!--спиок государств по континентам-->
 		<div class="col-sm-10">
 			<?php
	 			if (request()->continent) {//если передано название континента
	 				$continent=request()->continent;
	 				$countries=App\Country::where('continent', $continent)->get();//выбор государств по континентам

	 			}else{
	 				$countries=App\Country::orderBy('Code', 'asc')->get();//список всех госудварств
	 			}
 			?>
 			@if (count($countries ?? '') > 0)
				<table class="table table-striped">
					<tr>
						<th style="width:10%">NN</th>
						<th style="width:10%">Code</th>
						<th style="width:10%">Country name</th>
						<th style="width:20%">Continent</th>
					</tr>
						<?php $k=0 ?>
					@foreach ($countries as $country)
						<?php $k++ ?>
						<tr><!---->
							<td>{{$k}}</td>
							<td>{{$country->Code}}</td>
							<td>{{$country->Name}}</td>
							<td>{{$country->Continent}}</td>
						</tr>
		 				@endforeach
				</table>
				@else
					<p>Data not found</p>
				@endif
			<p><strong>Всего государств: </strong>{{count($countries)}}</p>
 		</div>
 		<!--end list-->
	</div>
</div> 
</div>
@endsection






















	