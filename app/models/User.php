<?php
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface{

	protected $table = 'acl_users';

    protected $fillable = array(
        'username',
        'fullname',
        'email',
        'company_name',
        'ip_address',
        'return_url',
        'last_login',
        'last_login_ip',
        'password',
        'passwords',
        'confirmation_code',
        'confirmed',
        'status',
        'rfid_serial',
        'rfid_status',
        'session_token',
        'remember_token',
        'last_password_change',
        'password_expiration_date',
        'account_expiration_date',
        'created_at',
        'updated_at'
    );

    protected $guarded = array('id');

	protected $hidden = array('password');

    public function points()
    {
        return $this->hasOne('Points', 'account_id' , 'id');
    }

    public function user_member()
    {
        return $this->hasOne('UserMember', 'user_id' , 'id');
    }

    public function group_member()
    {
        return $this->hasMany('Group');
    }


    public function usermember() {
        return $this->hasMany('Share');
    }

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
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
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
     * Get user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername( $username )
    {
        return $this->where('username', '=', $username)->first();
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as &$role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.login_first') );
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

    /**
     * Updates the last login time and ip of the user
     *
     * @param None
     * @param None
     * @return None
     */
    public static function updateLoginTime()
    {
        // Get the user information
        $user = Auth::user();

        DB::table('acl_users')->where('id','=',$user->id)
            ->update(array(
                'last_login' => date('Y-m-d H:i:s'), 
                'last_login_ip' => Request::getClientIp()
            ));

    }

    public static function updateSessionToken()
    {
        $user  = User::find(Auth::user()->id);
        $sessionToken = Session::get('_token');
        $user->session_token = $sessionToken;
        $user->save();
    }

    public function currentUser()
    {
        return (new Confide(new ConfideEloquentRepository()))->user();
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }
    
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public static function checkUserPassword($user_id, $password){
        $user = DB::table('acl_users')
            ->select('passwords')
            ->where('id','=',$user_id)
            ->get();

        $passwords = json_decode($user[0]->passwords,true);

        if(!empty($passwords)){
            foreach($passwords as $p){
                if(Hash::check($password,$p)){
                    return true;
                }
            }
        }

        return false;

    }

    public static function userPasswordExpiry($givendate,$day=0,$mth=0,$yr=0) 
    {
        $cd = strtotime($givendate);
        $expirydate = date('Y-m-d h:i:s', mktime(date('h',$cd),
            date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
            date('d',$cd)+$day, date('Y',$cd)+$yr));
        return $expirydate;
    }


    public function isAdmin()
    {
        $isAdmin = UserMember::with('group')->where('user_id', Auth::user()->id)->get();

        foreach ($isAdmin as $group) {
           if (strpos(strtolower($group->group->name),'admin') !== false) {
                return true;
            }
        }

        return false;
    }

    public function isOperator()
    {
        $isAdmin = UserMember::with('group')->where('user_id', Auth::user()->id)->get();

        foreach ($isAdmin as $group) {
           if (strpos(strtolower($group->group->name),'operator') !== false) {
                return true;
            }
        }

        return false;
    }

    public function isPlayer()
    {
        $isPlayer = UserMember::with('group')->where('user_id', Auth::user()->id)->get();

        foreach ($isPlayer as $group) {
           if (strpos(strtolower($group->group->name),'player') !== false) {
                return true;
            }
        }

        return false;
    }

    public static function updatePlayer($data, $user_id=null)
    {

        $update = array_only($data, array(
            'email',
            'fullname',
            'rfid_serial'
            )
        );

        $affected_row = User::where('id',$user_id)->update($update);

        if($affected_row == 1)
        {
            $response = array(
                    'status'    => 200,
                    'error'     => false,
                    'update'    => $update,
                    'message'   => 'Player has been successfully updated.');
        }
        else
        {
                $response = array(
                    'status'    => 402,
                    'error'     => 'update_failed',
                    'update'    => $update,
                    'message'   => 'Player update failed.');
        }

        return $response;
    }
}