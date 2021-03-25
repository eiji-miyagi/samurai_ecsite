<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

// use App\Category;を追加することにより、カテゴリを取り扱うCategoryモデルを
// ProductController.php内で使用することができます。
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全ての商品をインデックスで表示
        $products = Product::all();
        // 呼び出すビューを指定し、そのビューで使用する変数$productsをビューへと渡しています。
        // view関数の第一引数が、使用するビューを指定しています。
        // 'products.index'は、resources\viewsディレクトリ内の
        // productsディレクトリの中にあるindex.blade.phpを使用する、
        // という書き方になっています。

        // 第二引数に渡されているcompact関数は、
        // コントローラーから渡される変数を指定しています。
        // compact('products')は$productsをビューへと渡しています。

     return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categoriesにすべてのカテゴリを保存し、ビューへと渡しています。
        $categories = Category::all();
        
         return view('products.create', compact('categories'));
        //商品データを入力する入力フォームを表示させます
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        // category_idをデータベースに保存できるようにします。
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('products.show', ['id' => $product->id]);

    
        //Productモデルの変数を$product = new Product();にて作成しています。
        //     その後、フォームから送信されたデータが格納されている$request変数の中から、
        //     nameとdescriptionなどの項目のデータをそれぞれのカラムに保存しています。

        //     最後に$product->save()で、データベースへと保存しています。
        //     return redirect()->route('products.show', ['id' => $product->id]);
        //     ではデータが保存された後、リダイレクト（別のページに移動すること）を行っています。
        //     storeなどのアクションではビューを持たないので、この処理を書き忘れると真っ白な画面のままということになります。
    }
        //
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product')); 

        // view関数を使ってresources\views\productsディレクトリ内のshow.blade.phpを
        // ビューとして使用すると書かれています。またcompact('product')で商品のデータが保存されている変数を、
        // ビューへと渡しています。

        //     showアクションに対応したURLは/products/:idというURLになります。
        //     この:idの部分の値を元に、Laravel側が自動的にデータベースから該当するIDのデータを$productに渡しています。
    }
       

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product', 'categories'));
        //editアクションのURLは/products/:id/editとなっており、showアクションと同じくLaravel側で自動的に該当するデータを取得しています。


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // 更新前の商品のデータは$product変数に渡されています。
        // それを元に、$request内に格納されているフォームに入力した更新後のデータをそれぞれのカラムに渡して上書きしています。

        // $product->update();で更新をしています。
        
        // また、storeアクションと同様に、最後のコードでリダイレクトさせています。


        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        // category_idを保存する
        $product->category_id = $request->input('category_id');
        $product->update();

     return redirect()->route('products.show', ['id' => $product->id]);
       
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
        //この$product->delete();というコードで、データベースから指定の商品のデータを削除しています。
        // updateやshowアクションと同様に、$productはLaravel側で自動的に該当する商品のデータを保存しています。

        // 最後にreturn redirect()->route('products.index');で/productsというURLへとリダイレクトしています。
        // 
    }
}
