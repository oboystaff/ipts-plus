<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Division;
use App\Models\Assembly;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'access_level',
        'status',
        'assembly_code',
        'division_code',
        'role_access'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define a relationship with the Assembly model
    public function assembly()
    {
        return $this->belongsTo(Assembly::class, 'assembly_code', 'assembly_code');
    }

    // Define a relationship with the Division model
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_code', 'division_code');
    }

    public function roleName()
    {
        return $this->belongsTo(Role::class, 'role_access');
    }

    public function agentAssignments()
    {
        return $this->hasMany(AgentAssignment::class, 'agent_id');
    }

    public function customer()
    {
        return $this->hasOne(Citizen::class, 'user_id');
    }
}
