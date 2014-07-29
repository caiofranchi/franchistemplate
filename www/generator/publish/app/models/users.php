class  extends IlluminateDatabaseEloquentModel
{
    protected $table = '';

    protected $hidden = ['password', 'password_reset_hash', 'temp_password'];

    public function groups()
    {
        return $this->belongsToMany('Group', 'users_groups', 'user_id', 'group_id');
    }
}