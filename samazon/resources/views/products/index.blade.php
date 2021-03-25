
@foreach($products as $product)
    {{$product->name}}
    {{$product->description}}
    {{$product->price}}
    <!-- コントローラーから受け取った$productsの中にある商品データを、
一つずつ変数productへ渡しています。その後{{ $product->name }}
などのコードで、商品の名前などの各カラムの内容を表示しています。 -->
    <a href="{{route('products.show', $product)}}">Show</a>
    <a href="{{route('products.edit', $product)}}">edit</a>
    <!-- 削除フォーム  -->
    <form action="/products/{{ $product->id }}" method="POST"
     onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
       <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit">Delete</button>
    </form>  
 @endforeach
<!-- 新規に商品データを登録する際の画面へのリンクを作成しています。 -->
<a href="{{route('products.create')}}">New</a> 
