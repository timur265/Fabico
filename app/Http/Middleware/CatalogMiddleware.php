<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Model\Contact;
use App\Model\Categories;

class CatalogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('contact', Contact::find(1));
        View::share('parentCategories', Categories::where('parent_id', '=', null)->get());
        if (session()->has('cart')) {
            $cartTotalSum = 0;
            $cartTotalCount = 0;
            foreach ((array) session('cart') as $id => $details) {
                $cartTotalSum += $details['price'] * $details['quantity'];
                $cartTotalCount += $details['quantity'];
            }
            View::share('cartTotalSum', $cartTotalSum);
            View::share('cartTotalCount', $cartTotalCount);
        }
        return $next($request);
    }
}
