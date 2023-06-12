<?

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\productCatelog;
use Illuminate\Support\Facades\Request;

class CatelogController extends Controller
{

    function index($catelogName) {
        // $productsData = Product::where('catelogName', $catelogName)
        //     ->orderBy('catelogName', 'asc')
        //     ->get(['productImage', 'productName', 'productCode']);
    
        // return view('frontend.products', ['products' => $productsData]);
        return view('frontend.products');
    }

    

    protected $table = 'catelog'; // 设置表名

    // ...

    /**
     * 创建新的种类
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Request $request){

        $request->validate([
            'productCatelog' => 'required|string'
        ]);

        $data = $request->input('productCatelog');

        // Split the input data into lines
        $lines = explode(PHP_EOL, $data);

        $catelogController = new CatelogController(); // Create a new instance

        foreach ($lines as $line) {
            $line = trim($line);

            if (!empty($line)) {
                // Create a new catelog and store it in the database
                $catelogController->createCatelog(['catelogName' => $line]);
            }
        }

        // Redirect to the appropriate page after creating the catelog
        return redirect()->route('catelog.index')->with('success', 'Catelog created successfully');
    }

    /**
     * Create a new catelog.
     *
     * @param array $data
     * @return void
     */
    public function createCatelog($data){

        productCatelog::create($data);
    }

}

?>