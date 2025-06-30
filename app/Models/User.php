<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Os atributos que são de massa atribuível.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_master',
        'telephone',
        'profile_photo_path',
    ];

    /**
     * Os atributos que devem ser ocultos para serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obter a URL da foto de perfil do usuário.
     *
     * Se o caminho da foto de perfil estiver vazio, retorna a URL padrão da imagem de perfil.
     * Caso contrário, retorna a URL da imagem de perfil armazenada no storage.
     *
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path 
            ? asset('storage/' . $this->profile_photo_path)
            : asset('images/profile.jpg');
    }

    /**
     * Obter os atributos que devem ser lançados.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', 'password' => 'hashed',
        ];
    }

     /**
     * Substituir o método que define o campo de autenticação
     */
    public function username()
    {
        return 'username';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
