<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductMaterialStoreRequest;
use App\Models\MaterialType;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductMaterialsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductMaterialStoreRequest $request)
    {
        $data = $request->all();
        $material_type_id = $data['material_type_id'];
        $material_type = MaterialType::find($material_type_id);
        $data['material_id'] = $material_type->material_id;

        ProductMaterial::create($data);
        $product_id = $data['product_id'];
        $materials_html = ProductMaterial::getMaterialsHtml($product_id);

        return response()->json([
            'result'            => true,
            'materials_html'    => $materials_html,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductMaterialStoreRequest $request)
    {
        $id = $request->id;
        $product_material = ProductMaterial::find($id);
        $data = $request->only($product_material->getFillable());
        $material_type_id = $data['material_type_id'];
        $material_type = MaterialType::find($material_type_id);
        $data['material_id'] = $material_type->material_id;
        
        $product_material->update($data);
        $product_id = $product_material->product_id;
        $materials_html = ProductMaterial::getMaterialsHtml($product_id);

        return response()->json([
            'result'            => true,
            'materials_html'    => $materials_html,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $material = ProductMaterial::findOrFail($request->material_id);
        $material->delete();
        $product_id = $material->product_id;
        $materials_html = ProductMaterial::getMaterialsHtml($product_id);

        return response()->json([
            'result'            => true,
            'materials_html'    => $materials_html,
        ]);
    }
}
