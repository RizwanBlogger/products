<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = product::all();
        return view('product.list',compact('product'));
    }
    public function create(Request $request)
    {

        $data = null;
        $data['updateId'] = $updateId = ($request->id ?? 0);

        if(is_numeric($updateId) && $updateId > 0) {
            $data['record'] = product::where('id',$updateId)->first();
        }
        return view('product.create',compact('data'));
    }
    public function submit(Request $request)
    {
        $type = 'error';
        $validator = Validator::make($request->all(), [
            'productname' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|',
        ]);
        if ($validator->passes()) {
            $type = 'success';
            $message = "Page add successfully";
            $updateId = $request->id;
            $data = array("productname" => $request->productname, "price" =>$request->price,  "image" => $request->image,);
            if(isset($updateId) && !empty($updateId) && $updateId > 0) {
                $data['id'] = $updateId;
            }
            $response =product::updateOrCreate(array('id'=>$updateId),$data);
            $updateId = $response->id;
            if (isset($_FILES['image']['size'])) {
                if ($_FILES['image']['size'] > 0) {
                    if (isset($response->image) && !empty($response->image)) {
                        $this->delete_images_by_name('/uploads/product/orignal_images/','/uploads/product/large_images/','/uploads/product/medium_images/','/uploads/product/small_images/', $response->image);
                    }
                    $this->upload_images('/uploads/product/orignal_images/','/uploads/product/large_images/','/uploads/product/medium_images/','/uploads/product/small_images/',$request->file('image'), $updateId, 'image','id', 'products');
                }
            }
        }
        else {
            $message = $validator->errors()->toArray();
        }
        return redirect()->back()->with('message', 'product upload ');
    }
    public function destroy($id)
    {
        $delete = product::findOrFail($id);
        $oldimage=$this->delete_images_by_name('/uploads/product/orignal_images/','/uploads/product/large_images/','/uploads/product/medium_images/','/uploads/product/small_images/',$delete->image);
        if(File::exists($oldimage)) {
            File::delete($oldimage);
         }
        $delete->delete();
        return redirect()->back();
    }
    }

