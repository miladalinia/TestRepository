<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
//        $products = Product::withCount('user')->paginate(4);
        $items = Product::pluck('product_code', 'id');
//        return view('products.index', ['products' => $products, 'items' => $items]);
        return view('products.index', ['items' => $items]);
//        return view('products.index');

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'publish_year' => 'required',
                'product_code' => 'required',
                'type' => 'required',
                'category' => 'required',
                'weight' => 'required',
                'price' => 'required',
                'image' => 'required',
            ]);
            $user = Auth::user();
            $user->products()->create($request->all());
            return redirect()->back()
                ->with('success', 'product created successfully.');
        } else {
            return redirect('login');
        }
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

//I created Gate in AuthServiceProvider inside function boot()
//
//        if (Gate::denies('update', $product)) {
//            abort(403, 'sorry!,The product does not belong to you');
//        }
//Or use authorize()
        $this->authorize('update', $product);
        $items = Product::pluck('product_code', 'id');
        return view('products.edit', compact('product', 'items'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'publish_year' => 'required',
                'product_code' => 'required',
                'type' => 'required',
                'category' => 'required',
                'weight' => 'required',
                'price' => 'required',
                'image' => 'required',
            ]);
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return redirect()->route('products.index')
                ->with('success', 'product updated successfully.');;
        } else {
            return redirect('login');
        }
    }

    // Live Search with Ajax

    public function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = Product::with('user')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orwhere('user_id', 'like', '%' . $query . '%')
                    ->orwhere('type', 'like', '%' . $query . '%')
                    ->orWhere('product_code', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%')
                    ->orWhere('publish_year', 'like', '%' . $query . '%')
                    ->orWhere('publisher', 'like', '%' . $query . '%')
                    ->orWhere('category', 'like', '%' . $query . '%')
                    ->orWhere('weight', 'like', '%' . $query . '%')
                    ->orWhere('price', 'like', '%' . $query . '%')
                    ->orWhere('image', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = Product::with('user')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                      <tr>
                        <td>' . $row->name . '</td>
                        <td>' . $row->user->name . '</td>
                        <td>' . $row->type . '</td>
                        <td>' . $row->product_code . '</td>
                        <td>' . $row->price . '</td>
                        <td>' . $row->author . '</td>
                        <td>' . $row->weight . '</td>
                        <td>' . $row->category . '</td>
                        <td>' . $row->image . '</td>
                        <td>' . $row->publisher . '</td>
                        <td>' . $row->publish_year . '</td>
                     </tr> ';
                }
            } else {
                $output = '<tr>
                        <td align="center" colspan="11">no data found</td>
                        </tr>';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row,
            );
            echo json_encode($data);
        }
    }


// RESTful API for products //

    public function products_api()
    {
        return response()->json(Product::all(), 200);
    }

    public function productsById_api($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message", "Record Not Found"], 404);
        }
        return response()->json($product, 200);
    }

    public function createProducts_api(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'author' => 'required|min:3|max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function updateProducts_api(Request $request, $id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message", "Record Not Found"], 404);
        }
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function deleteProducts_api($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message", "Record Not Found"], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }

}
