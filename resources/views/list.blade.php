

<html>
    <head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 1px;
  text-align: left;    
}
</style>
</head>

<body>
<h1>Users</h1>

<table style="width:50%">
               
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <!-- <th>Password</th> -->
                    <th>Actions</th>
                </tr>
                

                @foreach($users as $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <!-- <td>{{$item['password']}}</td> -->
                    <td><a href="">Edit</a>
                    <a href="">Delete</a><td>
                </tr>
                @endforeach
</table>
</body>
</html>

