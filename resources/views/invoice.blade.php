<!-- https://github.com/barryvdh/laravel-dompdf -->
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>

<h1>{{ $title }}</h1>

<h1>Colspan and rowspan</h1>

<h3>Cell that spans two columns:</h3>
<table>
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th colspan="2">Phone</th>    
  </tr>
  <tr>
    <td>John Doe</td>
    <td>john.doe@example.com</td>    
    <td>123-45-678</td>
    <td>212-00-546</td>    
  </tr>
</table>

<h3>Cell that spans two rows:</h3>
<table>
  <tr>
    <th>Name:</th>
    <td>John Doe</td>
  </tr>
  <tr>
    <th>Email:</th>  
    <td>john.doe@example.com</td>      
  </tr>  
  <tr>
    <th rowspan="2">Phone:</th>
    <td>123-45-678</td>
  </tr>
  <tr>
    <td>212-00-546</td>
  </tr>
</table>

</body>
</html>
