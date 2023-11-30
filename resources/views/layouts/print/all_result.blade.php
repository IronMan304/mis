<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<style>
		table {
			width: 100% !important;
		}

		p,
		span {
			font-size: small;
			margin-bottom: -1px;
			margin-top: -5px;
			padding: -10px;
		}

		td,
		th,
		table {
			font-size: small;
		}

		tr td {
			padding: 0 !important;
			margin: 0 !important;
		}

		.result-header {
			border-color: green black black black;
		}
	</style>
</head>

<body onload="window.print()">
	@php
		use Carbon\Carbon;
		$now = Carbon::now();
	@endphp
	<header>
		<table class="table table-bordered">
			<thead>
				<tr style="border-color: white">
					<th colspan="2">
						<div class="row">
							<div class="col-12 d-flex justify-content-end">
								<img src="{{ asset('assets/img/favicon.png') }}" alt="Diagcare" style="width:100%; border: 2px solid green">
							</div>
						</div>
					</th>
					<td colspan="10">
						<div class="row">
							<div class="col-12 d-flex justify-content-start">
								<strong>DIAGCARE - DIAGNOSTIC CARE AND LABORATORY SERVICES</strong>
							</div>
							<div class="col-12 d-flex justify-content-start">
								<p>Dr. V. Locsin Street, Dumaguete City</p>
							</div>
							<div class="col-12 d-flex justify-content-start">
								<p>Website: https://diag.care</p>
							</div>
							<div class="col-12 d-flex justify-content-start">
								<p>Tel. No.: +63 035 421-0838 / 035-421-0259 / 09177250891</p>
							</div>
							<div class="col-12 d-flex justify-content-start">
								<p>Email Address: contact@diag.care</p>
							</div>
						</div>
					</td>
				</tr>
			</thead>
		</table>
		<table class="table table-bordered border-dark">
			<tbody>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td>
						Patient Name: <b
							style="font-size:large; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">{{ $booking->patient->name }}</b>
					</td>
					<td>
						Code: {{ $booking->barcode }}
					</td>
				</tr>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td>
						Age: {{ $booking->patient->age ?? '' }} years old
					</td>
					<td>
						Gender: {{ $booking->patient->genders->name ?? '' }}
					</td>
				</tr>
				<tr style="border-color: LightGray LightGray black LightGray">
					<td>
						Birthdate: {{ Carbon::parse($booking->patient->birthdate)->format('F d, Y') ?? '' }}
					</td>
					<td>
						Contact Number: {{ $booking->patient->contact_number ?? '' }}
					</td>
				</tr>
				{{-- <tr>
                    <td colspan="2"><small>Result printed on: {{ $now->format('F d, Y') }}, {{ $now->format('h:i a') }}</small>
                    </td>
                </tr> --}}
			</tbody>
		</table>
	</header>
	<div class="row">
		@php
			$i = 0;
			$x = 1;
		@endphp
		@foreach ($results as $result)
			@if (count($results) == $x)
				@if (count($results) % 2 != 0)
					<div class="col-12">
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered border-dark" style="width: 100%">
									<thead>
										@if ($has_unit[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
											</tr>
										@elseif ($has_range[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<td colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px">
												<th colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@elseif ($has_both[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="4">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="4">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@else
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="2">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
											</tr>
										@endif
									</thead>
									<tbody>
										@php
											$y = 1;
										@endphp
										@if ($has_unit[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_range[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_both[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@else
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@else
					<div class="col-6">
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered border-dark" style="width: 100%">
									<thead>
										@if ($has_unit[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
											</tr>
										@elseif ($has_range[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<td colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px">
												<th colspan="3">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@elseif ($has_both[$i] == true)
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="4">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="4">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Unit
														</div>
													</div>
												</th>
												<th>
													Normal Range
												</th>
											</tr>
										@else
											<tr class="result-header" style="border-width: 4px 3px 1px 3px">
												<th colspan="2">
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
														</div>
													</div>
												</th>
											</tr>
											<tr style="border-width: 1px 3px">
												<td colspan="2">
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<span style="font-size: small">Result Date/Time:
																{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
														</div>
													</div>
												</td>
											</tr>
											<tr style="border-width: 1px 3px 3px 3px">
												<th>Test</th>
												<th>
													<div class="row">
														<div class="col-12 d-flex justify-content-center">
															Result
														</div>
													</div>
												</th>
											</tr>
										@endif
									</thead>
									<tbody>
										@php
											$y = 1;
										@endphp
										@if ($has_unit[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_range[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@elseif ($has_both[$i] == true)
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	{{ $res->results->units->name }}
																</div>
															</div>
														</td>
														<td>
															{{ $res->results->range }}
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@else
											@foreach ($result as $res)
												@if (count($result) == $y)
													<tr style="border-width: 1px 3px 3px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@else
													<tr style="border-width: 1px 3px">
														<td>
															{{ $res->results->name }}
														</td>
														<td>
															<div class="row">
																<div class="col-12 d-flex justify-content-center">
																	<strong>{{ $res->result_value }}</strong>
																</div>
															</div>
														</td>
													</tr>
												@endif
												@php
													$y++;
												@endphp
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@endif
			@else
				<div class="col-6">
					<div class="row">
						<div class="col-12">
							<table class="table table-bordered border-dark" style="width: 100%">
								<thead>
									@if ($has_unit[$i] == true)
										<tr class="result-header" style="border-width: 4px 3px 1px 3px">
											<th colspan="3">
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
													</div>
												</div>
											</th>
										</tr>
										<tr style="border-width: 1px 3px">
											<td colspan="3">
												<div class="row">
													<div class="col-12 d-flex justify-content-end">
														<span style="font-size: small">Result Date/Time:
															{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
													</div>
												</div>
											</td>
										</tr>
										<tr style="border-width: 1px 3px 3px 3px">
											<th>Test</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Result
													</div>
												</div>
											</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Unit
													</div>
												</div>
											</th>
										</tr>
									@elseif ($has_range[$i] == true)
										<tr class="result-header" style="border-width: 4px 3px 1px 3px">
											<td colspan="3">
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
													</div>
												</div>
											</td>
										</tr>
										<tr style="border-width: 1px 3px">
											<th colspan="3">
												<div class="row">
													<div class="col-12 d-flex justify-content-end">
														<span style="font-size: small">Result Date/Time:
															{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
													</div>
												</div>
											</th>
										</tr>
										<tr style="border-width: 1px 3px 3px 3px">
											<th>Test</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Result
													</div>
												</div>
											</th>
											<th>
												Normal Range
											</th>
										</tr>
									@elseif ($has_both[$i] == true)
										<tr class="result-header" style="border-width: 4px 3px 1px 3px">
											<th colspan="4">
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
													</div>
												</div>
											</th>
										</tr>
										<tr style="border-width: 1px 3px">
											<td colspan="4">
												<div class="row">
													<div class="col-12 d-flex justify-content-end">
														<span style="font-size: small">Result Date/Time:
															{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
													</div>
												</div>
											</td>
										</tr>
										<tr style="border-width: 1px 3px 3px 3px">
											<th>Test</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Result
													</div>
												</div>
											</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Unit
													</div>
												</div>
											</th>
											<th>
												Normal Range
											</th>
										</tr>
									@else
										<tr class="result-header" style="border-width: 4px 3px 1px 3px">
											<th colspan="2">
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														<h5 style="text-transform:uppercase"><b>{{ $serv_key[$i]->service->name }}</b></h5>
													</div>
												</div>
											</th>
										</tr>
										<tr style="border-width: 1px 3px">
											<td colspan="2">
												<div class="row">
													<div class="col-12 d-flex justify-content-end">
														<span style="font-size: small">Result Date/Time:
															{{ Carbon::parse($result[0]->created_at)->format('M d, Y h:i a') }}</span>
													</div>
												</div>
											</td>
										</tr>
										<tr style="border-width: 1px 3px 3px 3px">
											<th>Test</th>
											<th>
												<div class="row">
													<div class="col-12 d-flex justify-content-center">
														Result
													</div>
												</div>
											</th>
										</tr>
									@endif
								</thead>
								<tbody>
									@php
										$y = 1;
									@endphp
									@if ($has_unit[$i] == true)
										@foreach ($result as $res)
											@if (count($result) == $y)
												<tr style="border-width: 1px 3px 3px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																{{ $res->results->units->name }}
															</div>
														</div>
													</td>
												</tr>
											@else
												<tr style="border-width: 1px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																{{ $res->results->units->name }}
															</div>
														</div>
													</td>
												</tr>
											@endif
											@php
												$y++;
											@endphp
										@endforeach
									@elseif ($has_range[$i] == true)
										@foreach ($result as $res)
											@if (count($result) == $y)
												<tr style="border-width: 1px 3px 3px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														{{ $res->results->range }}
													</td>
												</tr>
											@else
												<tr style="border-width: 1px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														{{ $res->results->range }}
													</td>
												</tr>
											@endif
											@php
												$y++;
											@endphp
										@endforeach
									@elseif ($has_both[$i] == true)
										@foreach ($result as $res)
											@if (count($result) == $y)
												<tr style="border-width: 1px 3px 3px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																{{ $res->results->units->name }}
															</div>
														</div>
													</td>
													<td>
														{{ $res->results->range }}
													</td>
												</tr>
											@else
												<tr style="border-width: 1px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																{{ $res->results->units->name }}
															</div>
														</div>
													</td>
													<td>
														{{ $res->results->range }}
													</td>
												</tr>
											@endif
											@php
												$y++;
											@endphp
										@endforeach
									@else
										@foreach ($result as $res)
											@if (count($result) == $y)
												<tr style="border-width: 1px 3px 3px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
												</tr>
											@else
												<tr style="border-width: 1px 3px">
													<td>
														{{ $res->results->name }}
													</td>
													<td>
														<div class="row">
															<div class="col-12 d-flex justify-content-center">
																<strong>{{ $res->result_value }}</strong>
															</div>
														</div>
													</td>
												</tr>
											@endif
											@php
												$y++;
											@endphp
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endif

			@php
				$i++;
				$x++;
			@endphp
		@endforeach
	</div>
	<footer>
		<div class="row" style="margin-bottom:-5px">
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<img src="{{ asset('img/result/abad.jpg') }}" alt="Jennifer P. Abad, RMT" style="width:20%">
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<img src="{{ asset('img/result/dr_mcintire.jpg') }}" alt="Dr. Rogelio S. McIntire, MD, FPSP"
							style="width:10%">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<span style="text-decoration:underline">Jennifer P. Abad, RMT</span>
					</div>
					<div class="col-12 d-flex justify-content-center" style="font-size: xx-small">Medical Technologist</div>
					<div class="col-12 d-flex justify-content-center" style="font-size: x-small">PRC No.0016019</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<span style="text-decoration:underline">Dr. Rogelio S. McIntire, MD, FPSP</span>
					</div>
					<div class="col-12 d-flex justify-content-center" style="font-size: xx-small">Pathologist</div>
					<div class="col-12 d-flex justify-content-center" style="font-size: x-small">PRC No.0074961</div>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-12">
                <span style="font-size: xx-small">Note*: This is a computer-generated report signature is not required.</span>
            </div>
        </div>
	</footer>
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
