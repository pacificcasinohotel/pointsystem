<?php

class GroupsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('acl_group_permissions')->truncate();
        DB::table('acl_groups')->truncate();
        
        $groups = array(
            array(
                'name'              => 'Super Admin',
                'description'       => 'Super Admin Account',
                'date_created'      => new DateTime
            ),
            array(
             'name'              => 'Admin',
             'description'       => 'Admin Account',
             'date_created'      => new DateTime
            )
        );


        DB::table('acl_groups')->insert( $groups );

        $permission = Permission::all();
        $grouplist  = Group::all();

        foreach($grouplist as $group)
        {
           foreach($permission as $row)
            {
                $group_permission = new GroupPermissions;
                $group_permission->permission_id = $row->id;
                $group_permission->group_id = $group->id;
                $group_permission->save(); 
            } 
        }

         $operator = array( array(
             'name'              => 'Operator',
             'description'       => 'Operator Account',
             'date_created'      => new DateTime
        ));

        DB::table('acl_groups')->insert($operator);

        $player = array( array(
             'name'              => 'Player',
             'description'       => 'Player Account',
             'date_created'      => new DateTime
        ));

        DB::table('acl_groups')->insert($player);

        $this->command->info('Group table seeded!');
    }
}
