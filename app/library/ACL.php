<?php

class ACL {
    
    public function __construct()
    {

    }
    
    /**
     * Get User Permission for specific user
     */
    public static function buildACL()
    { 
         $userId = (Auth::check()) ? Auth::user()->id : 0;
         $userPermission = UserPermissions::with('permission')->where('user_id', $userId)->get();
         $permission     = self::groupUserMember($userId,'perm_name');
         
         foreach ($userPermission as $row) 
         {
            if($row->value == 1)
            {
               $permission['access'][$row->permission->perm_key] = array(
                                          'id'        => $row->permission->id,
                                          'perm_name' => $row->permission->perm_name,
                                          'perm_key'  => $row->permission->perm_key,
                                          'visible'   => $row->permission->visible
                                        ); ;
            }
            else
            {
                unset($permission['access'][$row->permission->perm_key]);
            }
         }

         return $permission;
    }


    /**
     * Check User Permission
     */
    public static function checkPermission($user_id)
    { 
         
         $userId = $user_id;
         $userPermission = UserPermissions::with('permission')->where('user_id', $userId)->get();
         $permission     = self::groupUserMember($user_id,'perm_key');

         foreach ($userPermission as $row) 
         {

            if($row->value == 1)
            {
               $permission[$row->permission->id] = array(
                                          'id'        => $row->permission->id,
                                          'perm_name' => $row->permission->perm_name,
                                          'perm_key'  => $row->permission->perm_key
                                        );
            }
            else
            {
               unset($permission[$row->permission->perm_key]);
            }
         }


         return  $permission;
    }

    /**
     * Group List
     */
    public static function getAllGroup()
    {
    	$groupList = Group::all();

    	return $groupList;
    }


   public static function getGroupPermission()
    {
        $groupPermission = GroupPermissions::with('aclPermission', 'group')->get();

        $permission = array();
        
        foreach($groupPermission as $row)
        {
            $permission[$row->group->id][] = $row->acl_permission->id;
        }

        return $permission;
    }

    /**
     * Save Group Permission into acl_group_permissions
     */
    public static function saveGroupPermission($groupId,$data=array())
    {
        GroupPermissions::where('group_id', '=', $groupId)->delete();         

        foreach ($data as $val)
        {

            $userPermission = UserPermissions::where('permission_id', $val)->find($val);
            
            if(!empty($userPermission))
            {
                echo '<pre />';
                print_r($userPermission);
                exit;
            }

            $group_permission = new GroupPermissions;
            $group_permission->permission_id = $val;
            $group_permission->group_id = $groupId;
            $group_permission->value = 1;
            $group_permission->date_created = new DateTime;
            $group_permission->save();
        }     
    }



    /**
     * Get user member on acl_user_member
     */

    public static function getUserMember($userId)
    {
        $member = UserMember::with(array('group','user'))->where('user_id',$userId)->get();                      
       
        $userMember = array();
        foreach ($member as $row) {
            $userMember[] = $row->group_id;
        }

        return $userMember;
    }


    /**
     * Add and Edit user member
     */
    public static function userMemberAddEdit($userId,$data=array())
    {
        UserMember::where('user_id', '=', $userId)->delete();

        foreach ($data as $val)
        {
            $user_member = new UserMember;
            $user_member->user_id = $userId;
            $user_member->group_id = $val;
            $user_member->date_created = new DateTime;
            $user_member->save();
        }
    }

    /**
     * Get User inherited permission from group 
     */
    public static function groupUserMember($userId,$option='')
    {
        $getUserMember = self::getUserMember($userId);
        $groupAccess   = array();

        if(count($getUserMember) > 0)
        {
            #$gAccess = GroupPermissions::with('aclPermission')->whereIn('group_id', $getUserMember)->get();
            $gAccess = GroupPermissions::getGroupPermission($getUserMember);

            foreach ($gAccess as $row) {
                $permKey = explode('.', $row->perm_key);
                if($row->visible == 1){
                  $groupAccess['nav'][$permKey[0]][] = array(
                                            'id'        => $row->id,
                                            'perm_name' => $row->perm_name,
                                            'perm_key'  => $row->perm_key,
                                            'visible'   => $row->visible
                                          );
                }
                $groupAccess['access'][$row->perm_key] = array(
                                          'id'        => $row->id,
                                          'perm_name' => $row->perm_name,
                                          'perm_key'  => $row->perm_key,
                                          'visible'   => $row->visible
                                        ); 
            }
        }

        return $groupAccess;
    }

    /**
     * Get User Permission
     */
    public static function getUserPermission($userId)
    {
        $userPermission = UserPermissions::with('permission')->where('user_id', $userId)->get(); 

        $permission = $userPermission->toArray();        

        return $permission;
    }

    /**
     * Checks if user has that permission
     */
    public static function checkUserPermission($perm_key)
    {
        $permissions = self::buildACL();

        if(empty($permissions))
        {
          return false;
        }

        if(array_key_exists($perm_key,$permissions['access'])){
          return true;
        }
        
    }

    /**
     * Save User Permission into acl_user_permissions
     */
    public static function saveUserPermission($userId,$data=array())
    {
        UserPermissions::where('user_id', '=', $userId)->delete();

        foreach ($data as $key=>$val)
        {
            if($val != "" || $val != null)
            {
                $userpermission = new UserPermissions;
                $userpermission->user_id = $userId;
                $userpermission->permission_id = $key;
                $userpermission->value = $val;
                $userpermission->date_created = new DateTime;
                $userpermission->save(); 
            }

        }
    }



    /**
     * Create select form for managing user permission
     */
    public static function selectFormPermmission($userId)
    {
        $groupPermission    = ACL::groupUserMember($userId,'perm_name');
        $userPermission     = ACL::getUserPermission($userId);

        $html = '<table class="table table-bordered table-striped responsive-utilities">
                    <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th></th>
                        </tr>
                    </thead>';
        

        $permissionVal = array();

        foreach ($userPermission as $row) 
        {
            $permissionVal[$row['permission_id']] = $row['value'];
        }   

        foreach($groupPermission['access'] as $key => $val)
        {
            $id = $val['id'];
            $checked = '';
            if(in_array($id, array_fetch($userPermission, 'permission_id')))
            {
                $checked =  $permissionVal[$id];
            } 

            $select = Form::select('permission['.$id.']', array('1' => 'Allow', '0' => 'Deny' , '' => 'Inherit (Allow)'), $checked);
            #$html   .= '<tr><td><label>'.$val['perm_name'].'</label></td><td>'.$select.'</td></tr>';

            $html .= '<tbody>
                          <tr>
                            <th>'.$val['perm_name'].'</th>
                            <td class="is-visible">
                                <section class="col col-6">
                                    <label class="select">
                                     '.$select.'
                                     <i></i> 
                                    </label>
                                </section>
                            </td>
                          </tr>
                      </tbody>';

        }

        $html .= '</table>';

        return $html;
    }


    /**
     * For testing display JSON
     */
    public static function jsonResponse($data)
    {
    	return Response::json(array($data->toArray())); 
    }

}
