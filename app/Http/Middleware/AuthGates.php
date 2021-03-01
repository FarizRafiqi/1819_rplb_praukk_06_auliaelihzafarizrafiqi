<?php

namespace App\Http\Middleware;

use App\Models\Level;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Middleware ini berguna untuk mendefinisikan hak akses user
 */
class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ada user yang terautentikasi, jika ada maka atur hak aksesnya
        if($request->user()){
            $levels = Level::with('permissions')->get();
            $permissions = [];
            foreach($levels as $level){
                //Siapa saja yang memiliki hak akses (permission) ini
                foreach($level->permissions as $permission){
                    $permissions[$permission->title][] = $level->id; //['payment_edit' => [1, 3]]
                }
            }

            foreach ($permissions as $title => $level) {
                /**
                 * cek apakah user yang bersangkutan memiliki hak akses tertentu,
                 * jika punya maka definisikan gatenya
                 */
                Gate::define($title, function($user) use ($level){
                    return in_array($user->level->id, $level);
                });
            }
        }
        return $next($request);
    }
}
