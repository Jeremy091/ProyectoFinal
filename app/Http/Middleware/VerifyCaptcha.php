 <?php
/*  
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class VerifyCaptcha
{
    public function handle($request, Closure $next)
{
    if (!app('captcha')->validate($request->input('g-recaptcha-response'), $request->ip())) {
        // Si la validación del CAPTCHA falla, redirigir de vuelta con un error.
        return redirect()->back()->withErrors(['captcha' => 'Error en CAPTCHA, por favor intenta de nuevo.']);
    } else {
        // Si la validación del CAPTCHA es exitosa, proceder con la siguiente operación en la cadena de middleware.
        return $next($request);
    }
}

*/




