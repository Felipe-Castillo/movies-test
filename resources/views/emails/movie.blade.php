<!DOCTYPE html>
<html>
<head>
	<title>Movies</title>
</head>
<body>
   
<center>
<h2 style="padding: 23px;border: 6px red solid;">
	<a href="https://websolutionstuff.com">Movies</a>
</h2>
</center>
<div></div>

 <p>Movie Name:{{$movie->name}}</p>
 <p>Movie date:{{date('d-m-Y', strtotime(
$movie->publication_date))}}</p>

<p>This is test mail. This mail send using queue.</p>  
<strong>Thanks & Regards.</strong>

</body>
</html>