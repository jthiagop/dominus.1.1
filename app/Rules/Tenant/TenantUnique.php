<?php

namespace App\Rules\Tenant;

use App\Tenant\ManagerTenant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class TenantUnique implements ValidationRule
{

    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail)
    {

        $tenant = app(ManagerTenant::class)->getTenantIdentify();

        $result = DB::table($this->table)
                ->where($attribute, $value)
                ->where('tenant_id', $tenant)
                ->first();

        return is_null($result);
    }

    public function message()
    {
        return 'O valor para :atribute já está em uso!';
    }
}
