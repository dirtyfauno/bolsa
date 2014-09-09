<?php

use Bolsa\Contracts\Notifiable;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class User
 */
class User extends Eloquent implements UserInterface, RemindableInterface, Notifiable {

    use PresentableTrait;

    /**
     * @var string
     */
    protected $presenter = 'Bolsa\Presenters\UserPresenter';

    /**
     * @var array
     */
    protected $fillable = array(
        'tipo_usuario',
        "activo",
        'username',
        'email',
        'password'
    );
    /**
     * @var bool
     */
    protected $softDelete = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getTipoUsuario()
    {
        if (is_null($this->tipo_usuario))
        {
            throw new Exception('columna \'tipo_usuario\' no existe');
        }

        return (int) $this->tipo_usuario;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isGeneralAdmin()
    {
        return $this->getTipoUsuario() === TipoUsuarioModel::ADMIN_GENERAL;
    }

    /**
     * @return bool
     */
    public function isZorro()
    {
        if ($this->getTipoUsuario() == TipoUsuarioModel::APLICANTE)
        {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isReclutador()
    {
        if ($this->getTipoUsuario() == TipoUsuarioModel::RECLUTADOR)
        {
            return true;
        }

        return false;
    }

    #Relaciones

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne("EmpresaModel");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function aplicante()
    {
        return $this->hasOne("AplicanteModel");
    }
}