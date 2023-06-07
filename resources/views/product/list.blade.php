<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Listing Page</title>
</head>
<style>
    table, th, td {
  border: 1px solid black;
}
</style>
<body>
    <table class="table table-dark" style="border-block-style:  solid 1px">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">price</th>
            <th scope="col">orignal_images</th>
            <th scope="col">large_images</th>
            <th scope="col">medium_images</th>
            <th scope="col">small_images</th>
            <th>Delete</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach($product as $item)
          <tr>
            <td scope="row">
                {{$i++}}
            </td>
            <td>{{$item->price??''}}</td>
           <td><img src="{{ asset('uploads/product/orignal_images/'.$item->image) }}" width="80px"></td>
           <td><img src="{{ asset('uploads/product/large_images/'.$item->image) }}" width="80px"></td>
           <td><img src="{{ asset('uploads/product/medium_images/'.$item->image) }}" width="80px"></td>
           <td><img src="{{ asset('uploads/product/small_images/'.$item->image) }}" width="80px"></td>
           <td><a href="{{route('product.delete',$item->id)}}">Delete</a></td>
           <td><a href="{{route('product.create',['id'=>$item->id])}}">Update</a></td>
          </tr>
@endforeach
        </tbody>
      </table>
      <a href="{{route('product.create')}}">Upload Product</a>
</body>
</html>
