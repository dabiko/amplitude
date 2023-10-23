<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\CanResetPassword;

/**
 * @property mixed $name
 * @property mixed $username
 * @property mixed $email
 * @property mixed $branch_id
 * @property mixed $department_id
 * @property mixed $role_id
 *
 * @method static create(array $array)
 * @method static search(string $search)
 * @method static findOrFail(string $id)
 * @method static where(string $string, string $email)
 */
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getPermissionGroups(): Collection
    {
        return  DB::table('permissions')
            ->select('group_name')
            ->groupBy('group_name')
            ->get();
    }

    public static function getPermissionByGroupName(string $group_name ): Collection
    {
        return  DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name',$group_name)
            ->get();
    }


    public static function roleHasPermissions($role,$permissions)
    {
        $hasPermission = true;

        foreach ($permissions as $permission){
            if (!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
            }

            return $hasPermission;
        }
    }

    public function scopeSearch($query, $value): void
    {
        $query->where('name', 'like', "%{$value}%")
            ->orWhere('id', 'like', "%{$value}%")
            ->orWhere('username', 'like', "%{$value}%")
            ->orWhere('email', 'like', "%{$value}%")
            ->orWhere('created_at', 'like', "%{$value}%")
            ->orWhere('updated_at', 'like', "%{$value}%");
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
