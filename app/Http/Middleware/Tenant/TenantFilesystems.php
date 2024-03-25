<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantFilesystems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->check()){
            $this->setFilesystemsRoot();
        }

        return $next($request);

    }

    public function setFilesystemsRoot()
    {
        $tenant = app(ManagerTenant::class)->getTenant();

        config()->set(
            'filesystems.disks.tenant.root',
            config('filesystems.disks.tenant.root') . "/{$tenant->uuid}"
        );
    }
}
