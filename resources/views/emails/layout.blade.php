<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="margin: 0; background-color: #ECEFF1;">
	<style>
		@media only screen and (max-width: 600px) {
		.inner-body {
			width: 100% !important;
		}

		.footer {
			width: 100% !important;
			}
		}

		@media only screen and (max-width: 500px) {
			.button {
				width: 100% !important;
			}
		}
	</style>

	<table class="wrapper" dir="{{ config('app.locale') == 'ar' ? 'rtl' : 'ltr' }}" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" width="100%" cellspacing="0" role="presentation">

		<tbody>
			<tr>
				<td align="center">

					<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 576px;">
	
						<thead>
							<tr style="background: url({{ url('images/bg-mail.jpg') }}) no-repeat;">
								<th align="center" style="padding: 15px; border-top-left-radius: 5px; border-top-right-radius: 5px">
									<img src="{{ url('images/logo-white@2x.png') }}" height="32" alt="{{ config('app.name') }}">
								</th>
							</tr>
						</thead>

						<tbody style="background-color: #fff;" align="start">

							<tr>
								<td>
									@yield('content')
								</td>
							</tr>
							
							<tr>
								<td align="center">
									<a href="@section('link')" style="background-color: #1A237E; color: #fff; padding: 10px 40px; border-radius: 5px; text-decoration: none">
										تفعيل الآن
									</a>
								</td>
							</tr>

						<tbody>
						
					</table>

				</td>
			</tr>
		</tbody>
				
	</table>

</body>
</html>
