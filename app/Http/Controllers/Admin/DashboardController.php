<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Pakaian;
use App\Models\stock;
use App\Models\History;


class DashboardController extends Controller
{    
    /**
     * index
     *
     * return void
     */
    public function index()
    {


        //donatur
        $pakaians = Pakaian::count();


        //campaign
        $stocks = Stock::sum('stock');


        //donations
        $histories = History::count();


        return view('admin.dashboard.index', compact('pakaians', 'stocks', 'histories'));
    }
}
