<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;
use App\Notifications\NotiDate;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{

    public function getBycategorie($id){
        return Commande::where('categorie_id','=',$id)->get();
    }
   public function getcomd() {
     return view('admin.cmdlist')->with([
         'cmd'=>Commande::whereNull('delivery_date')->get(),
         'commande'=>Commande::whereNotNull('delivery_date')->get()]
    );
}
public function insertdate(Request $req){

    $cmd=Commande::find($req->id);
    $cmd->delivery_date=$req->delivery_date;
    $cmd->save();
    $cmd->user->notify(new NotiDate());
    return back();
}

public function delete($id){
Commande::find($id)->delete();
return back();
}
public function update(Request $req){
    $cmd=Commande::find($req->id);
    $cmd->qty=$req->qty;
    $cmd->delivery_date=$req->delivery_date;
    $cmd->save();
    return redirect()->route('admin.cmdlist');
}
// Revenu par mois
public function getsumbyMonth(){
  return Commande::selectRaw('year(created_at) year,sum(total) as somme, month(created_at) month')
                ->groupBy('year','month')
                ->get();

}
//
public function getProductMostOrders(){
    $products = DB::table('commandes')
    ->select(DB::raw('count(*) as cmd_count, produit_id'))
    ->groupByRaw('produit_id')
    ->orderBy('cmd_count','asc')
    ->paginate(5);
    $res=array();
    foreach ($products as $prod) {
        $item=Produit::where('id','=',$prod->produit_id)->get()->first();
        $item->nmbr=$prod->cmd_count;
        array_push($res,$item);
    }
    return  $res;
}
public function indexStatistic(){
    return view('admin.statistic')->with(['sum'=>$this->getsumbyMonth(),'prods'=>$this->getProductMostOrders()]);
}
}
