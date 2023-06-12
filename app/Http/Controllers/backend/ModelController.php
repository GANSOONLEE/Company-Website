<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\productModel;
use Illuminate\Http\Request;

class ModelController extends Controller{

    protected $table = 'models'; // 设置表名

    // ...

    /**
     * 创建新的种类
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Request $request){
        
        $request->validate([
            'productModel' => 'required|string'
        ]);

        $data = $request->input('productModel');

        // Split the input data into lines
        $lines = explode(PHP_EOL, $data);

        $modelController = new ModelController(); // Create a new instance

        foreach ($lines as $line) {
            $line = trim($line);

            if (!empty($line)) {
                // Create a new catelog and store it in the database
                $modelController->createModel(['modelName' => $line]);
            }
        }

        // Redirect to the appropriate page after creating the catelog
        // return redirect()->route('model.index')->with('success', 'Model created successfully');
    }

    /**
     * Create a new Model
     *
     * @param array $data
     * @return void
     */
    public function createModel($data){

        productModel::create($data);
    }
}