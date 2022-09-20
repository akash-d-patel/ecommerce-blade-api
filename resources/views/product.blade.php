<head>Products</head>
<table border="2">
    <tr>
        <th>Id</th>
        <th> Name</th>
        <th>Description</th>
        <th>Order</th>
        <th>Status</th>
        <th>Created </th>
        `<th>Created By</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->order}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at->diffForHumans()}}</td>
            <td>{{$product->Created}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <center><strong>Currently, Record not available.</strong></center>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>