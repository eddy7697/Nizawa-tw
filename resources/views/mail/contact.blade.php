<table border="1" cellpadding="5" cellspacing="1" style="width:500px">
	<tbody>
		<tr>
			<td>姓名</td>
			<td>{{$name}}</td>
		</tr>
		<tr>
			<td>性別</td>
			<td>{{$gender}}</td>
		</tr>
		<tr>
			<td>諮詢類型</td>
			<td>{{$type}}</td>
		</tr>
		<tr>
			<td>電子郵件</td>
			<td>{{$email}}</td>
		</tr>
		<tr>
			<td>連絡電話</td>
			<td>{{$phone}}</td>
		</tr>
		<tr>
			<td>內容</td>
			<td>{!!nl2br($content)!!}</td>
		</tr>
	</tbody>
</table>
