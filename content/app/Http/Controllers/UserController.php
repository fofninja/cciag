<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Page principale utilisateurs
     */
    public function index()
    {
        // Vérifier privilège (admin ou directeur)
        $user = Auth::user();
        if (!in_array($user->privilege_usr, ['admin', 'directeur','magasin'])) {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }
        
        // Liste des magasins pour le formulaire
        $magasins = DB::select("SELECT * FROM magasin ORDER BY nom_mag");
        
        // Statistiques
        $stats = DB::selectOne("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN privilege_usr = 'vente' THEN 1 ELSE 0 END) as nb_vente,
                SUM(CASE WHEN privilege_usr = 'admin' THEN 1 ELSE 0 END) as nb_admin,
                SUM(CASE WHEN privilege_usr = 'directeur' THEN 1 ELSE 0 END) as nb_directeur
            FROM users
        ");
        
        // Répartition par magasin
        $stats_magasins = DB::select("
            SELECT 
                m.nom_mag,
                COUNT(u.id) as nb_users
            FROM magasin m
            LEFT JOIN users u ON m.id_mag = u.id_mag
            GROUP BY m.id_mag, m.nom_mag
            ORDER BY nb_users DESC
        ");
        
        return view('utilisateurs.index', compact('magasins', 'stats', 'stats_magasins'));
    }
    
    /**
     * Charger la liste (AJAX)
     */
    public function load(Request $request, $limit)
    {
        $query = "
            SELECT 
                u.*,
                m.nom_mag
            FROM users u
            INNER JOIN magasin m ON u.id_mag = m.id_mag
            WHERE 1=1
        ";
        
        $params = [];
        
        // Filtre privilège
        if ($request->has('privilege') && $request->privilege != '') {
            $query .= " AND u.privilege_usr = ?";
            $params[] = $request->privilege;
        }
        
        // Filtre magasin
        if ($request->has('id_mag') && $request->id_mag != '') {
            $query .= " AND u.id_mag = ?";
            $params[] = $request->id_mag;
        }
        
        $query .= " ORDER BY u.id DESC LIMIT ?";
        $params[] = (int)$limit;
        
        $utilisateurs = DB::select($query, $params);
        
        return view('utilisateurs.load', compact('utilisateurs'));
    }
    
    /**
     * Créer un utilisateur
     */
    public function store(Request $request)
    {
        // Vérifier privilège
         $user = Auth::user();
        /**if (!in_array($user->privilege_usr, ['admin', 'directeur'])) {
            return back()->with('error', 'Accès non autorisé');
        } **/
        
        $request->validate([
            'nom_usr' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'privilege_usr' => 'required|in:vente,admin,directeur',
            'id_mag' => 'required|exists:magasin,id_mag',
            'img_usr' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $img_usr = 'default.png';
        
        // Upload image
        if ($request->hasFile('img_usr')) {
            $image = $request->file('img_usr');
            $img_usr = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/users'), $img_usr);
        }
        
        // Créer l'utilisateur
        DB::insert("
            INSERT INTO users (
                nom_usr, email, password, 
                privilege_usr, id_mag, img_usr
            ) VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $request->nom_usr,
            $request->email,
            Hash::make($request->password),
            $request->privilege_usr,
            $request->id_mag,
            $img_usr
        ]); 
        
        return redirect()->route('utilisateurs.index')->with('success', 
            'Utilisateur créé avec succès'
        );
    }
    
    /**
     * Modifier un utilisateur
     */
    public function update(Request $request, $id)
    {
        // Vérifier privilège
        $user = Auth::user();
        /** if (!in_array($user->privilege_usr, ['admin', 'directeur'])) {
            return back()->with('error', 'Accès non autorisé');
        }**/
        
        $request->validate([
            'nom_usr' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $id,
            'privilege_usr' => 'required|in:vente,admin,directeur',
            'id_mag' => 'required|exists:magasin,id_mag',
            'img_usr' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        // Récupérer utilisateur actuel
        $utilisateur = DB::selectOne("SELECT * FROM users WHERE id = ?", [$id]);
        
        if (!$utilisateur) {
            return back()->with('error', 'Utilisateur introuvable');
        }
        
        $img_usr = $utilisateur->img_usr;
        
        // Upload nouvelle image
        if ($request->hasFile('img_usr')) {
            $image = $request->file('img_usr');
            $img_usr = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/users'), $img_usr);
            
            // Supprimer ancienne image (sauf default)
            if ($utilisateur->img_usr != 'default.png' && file_exists(public_path('uploads/users/' . $utilisateur->img_usr))) {
                unlink(public_path('uploads/users/' . $utilisateur->img_usr));
            }
        }
        
        // Mettre à jour
        DB::update("
            UPDATE users 
            SET nom_usr = ?,
                email = ?,
                privilege_usr = ?,
                id_mag = ?,
                img_usr = ?
            WHERE id = ?
        ", [
            $request->nom_usr,
            $request->email,
            $request->privilege_usr,
            $request->id_mag,
            $img_usr,
            $id
        ]);
        
        return redirect()->route('utilisateurs.index')->with('success', 
            'Utilisateur modifié avec succès'
        );
    }
    
    /**
     * Supprimer un utilisateur
     */
    public function destroy($id)
    {
        // Vérifier privilège
        $user = Auth::user();
       /** if (!in_array($user->privilege_usr, ['admin', 'directeur'])) {
            return back()->with('error', 'Accès non autorisé');
        }**/
        
        // Ne pas supprimer son propre compte
        if ($id == $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }
        
        $utilisateur = DB::selectOne("SELECT * FROM users WHERE id = ?", [$id]);
        
        if (!$utilisateur) {
            return back()->with('error', 'Utilisateur introuvable');
        }
        
        // Supprimer image (sauf default)
        if ($utilisateur->img_usr != 'default.png' && file_exists(public_path('uploads/users/' . $utilisateur->img_usr))) {
            unlink(public_path('uploads/users/' . $utilisateur->img_usr));
        }
        
        DB::delete("DELETE FROM users WHERE id = ?", [$id]);
        
        return redirect()->route('utilisateurs.index')->with('warning', 
            'Utilisateur supprimé'
        );
    }
    
    /**
     * Réinitialiser le mot de passe
     */
    public function resetPassword(Request $request, $id)
    {
        // Vérifier privilège
        $user = Auth::user();
        /**if (!in_array($user->privilege_usr, ['admin', 'directeur'])) {
            return back()->with('error', 'Accès non autorisé');
        }**/
        
        $request->validate([
            'new_password' => 'required|min:6'
        ]);
        
        DB::update("
            UPDATE users 
            SET password = ?
            WHERE id = ?
        ", [
            Hash::make($request->new_password),
            $id
        ]);
        
        return back()->with('success', 'Mot de passe réinitialisé avec succès');
    }
}