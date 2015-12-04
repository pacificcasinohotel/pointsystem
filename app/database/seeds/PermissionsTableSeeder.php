<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('acl_group_permissions')->truncate();
        DB::table('acl_user_permissions')->truncate();
        DB::table('acl_permissions')->truncate();
        
        $permission = new Permission;
        $permission->perm_name = 'Users';
        $permission->perm_key  = 'settings.user';
        $permission->perm_description  = 'To view list of users of estate admin';
        $permission->visible   = 1;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Create User';
        $permission->perm_key  = 'user.create';
        $permission->perm_description  = 'To allow user create another user';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'View User';
        $permission->perm_key  = 'user.show';
        $permission->perm_description  = 'To allow user to view details of a user';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Edit User';
        $permission->perm_key  = 'user.edit';
        $permission->perm_description  = 'To allow user to edit details of a user';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Delete User';
        $permission->perm_key  = 'user.delete';
        $permission->perm_description  = 'To allow user to delete a user';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'User Permission';
        $permission->perm_key  = 'user.permission';
        $permission->perm_description  = 'To allow user to change permissions of a user';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();
        
        $permission = new Permission;
        $permission->perm_name = 'Groups';
        $permission->perm_key  = 'settings.groups';
        $permission->perm_description  = 'To allow user to view list of groups';
        $permission->visible   = 1;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Create Group';
        $permission->perm_key  = 'groups.create';
        $permission->perm_description  = 'To allow user to create a group';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'View Group';
        $permission->perm_key  = 'groups.show';
        $permission->perm_description  = 'To allow user view details of a group';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Edit Group';
        $permission->perm_key  = 'groups.edit';
        $permission->perm_description  = 'To allow user edit details of a group';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Delete Group';
        $permission->perm_key  = 'groups.delete';
        $permission->perm_description  = 'To allow user delete a group';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Permissions';
        $permission->perm_key  = 'settings.permission';
        $permission->perm_description  = 'To allow user view list of permissions available';
        $permission->visible   = 1;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'View Permission';
        $permission->perm_key  = 'permission.show';
        $permission->perm_description  = 'To allow view details of a permission';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();
        
        $permission = new Permission;
        $permission->perm_name = 'Create Permission';
        $permission->perm_key  = 'permission.create';
        $permission->perm_description  = 'To allow user create a permission';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Edit Permission';
        $permission->perm_key  = 'permission.edit';
        $permission->perm_description  = 'To allow user edit a permission';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Delete Permission';
        $permission->perm_key  = 'permission.delete';
        $permission->perm_description  = 'To allow user delete a permission';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Configurations';
        $permission->perm_key  = 'settings.index';
        $permission->perm_description = '';
        $permission->visible   = 1;
        $permission->date_created = new DateTime;
        $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Roulette';
        // $permission->perm_key  = 'games.roulette';
        // $permission->perm_description = '';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Roulette Tables';
        // $permission->perm_key  = 'games.create';
        // $permission->perm_description = '';
        // $permission->visible   = 0;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Roulette Edit';
        // $permission->perm_key  = 'games.edit';
        // $permission->perm_description = '';
        // $permission->visible   = 0;
        // $permission->date_created = new DateTime;
        // $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Player List';
        $permission->perm_key  = 'player.index';
        $permission->perm_description = '';
        $permission->visible   = 1;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Create Player';
        $permission->perm_key  = 'player.create';
        $permission->perm_description  = 'To allow user create player';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        $permission = new Permission;
        $permission->perm_name = 'Edit Player';
        $permission->perm_key  = 'player.edit';
        $permission->perm_description  = 'To allow user to edit details of a player';
        $permission->visible   = 0;
        $permission->date_created = new DateTime;
        $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Winning Number';
        // $permission->perm_key  = 'reports.winnings';
        // $permission->perm_description = 'Game winning report';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Redeemed Credits';
        // $permission->perm_key  = 'reports.redeem';
        // $permission->perm_description = '';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Bought Credits';
        // $permission->perm_key  = 'reports.deposit';
        // $permission->perm_description = '';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Roulette';
        // $permission->perm_key  = 'bet.roulette';
        // $permission->perm_description = '';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        // $permission = new Permission;
        // $permission->perm_name = 'Start Game';
        // $permission->perm_key  = 'roulette.start';
        // $permission->perm_description = '';
        // $permission->visible   = 1;
        // $permission->date_created = new DateTime;
        // $permission->save();

        $this->command->info('Permission table seeded!');
    }

}
