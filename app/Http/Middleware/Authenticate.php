<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        switch ($request->path()){
            case "admin/master":
                $defaultRouteName =  "master.login";
            break;
            default:
                $defaultRouteName = "admin.login";
        }

        return $request->expectsJson() ? null : route($defaultRouteName);
    }
}
