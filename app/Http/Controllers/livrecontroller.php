<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\livre;
class livrecontroller extends Controller
{
    //
    function list($id=null){

              return $id?livre::find($id):livre::all();
    }

 /*    function addlivre(Livre $livre){
        
     
            $nouveau_livre = [
                'titre' => 'Le Nom de la Rose',
                'auteur' => 'Umberto Eco',
                'date_publication' => '1980-09-26',
            ];
        
            $livre::create($nouveau_livre);
        
            return response()->json(['message' => 'Livre ajouté avec succès'],200);
    
            
}*/
public function addlivre(Request $request)
{
    $livre = new Livre;
    $livre->titre = $request->titre;
    $livre->auteur = $request->auteur;
    $livre->date_publication = $request->date_publication;
    $livre->save();
    return response()->json(['message' => 'Livre ajouté avec succès'],200);
}


  
public function update(Request $request, $id)
{
    $livre = Livre::find($id);
    if (!$livre) {
        return response()->json([
            'message' => 'Livre non trouvé'
        ], 404);
    }
    $livre->titre = $request->input('titre');
    $livre->auteur = $request->input('auteur');
    $livre->date_publication = $request->input('date_publication');
    $livre->save();
    return response()->json([
        'message' => 'Livre mis à jour avec succès',
        
    ], 200);
}
public function destroy($id)
{
    $livre = Livre::find($id);
    if (!$livre) {
        return response()->json([
            'message' => 'Livre non trouvé'
        ], 404);
    }
    $livre->delete();
    return response()->json([
        'message' => 'Livre supprimé avec succès'
    ], 200);
}

}