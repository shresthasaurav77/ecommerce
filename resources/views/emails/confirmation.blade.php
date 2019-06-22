<html>
<head><title>Register</title></head>
<body>
	<table>
		<tr>
			<td>Dear {{$name}}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr><td>Please click on below link to activate  your account</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{url('confirm/'.$code)}}">Confirm Account</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td>password:****(as choose by you)</td>
	</tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank You, Wish your best of luck</td></tr>
	</table>
</body>
</html>