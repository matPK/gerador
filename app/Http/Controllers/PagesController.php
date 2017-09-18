<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Lava;

class PagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function overview(){
        $stocksTable = Lava::DataTable();
        $stocksTable->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');
        
        for ($a = 1; $a < 30; $a++) {
            $stocksTable->addRow([
              '2015-10-' . $a, rand(800,1000), rand(800,1000)
            ]);
        }
        return view('pages.overview')->with('stocksTable', $stocksTable);
    }
}
