<?php

namespace App\Console\Commands;

use DB;
use GF;
use Illuminate\Console\Command;
use Schema;

class UpdateSoftware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ielect:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update ielect server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        

       
        $version = DB::table('settings')->where('name', 'version')->first();
        if (!$version) {
            DB::table('settings')->insert(['name' => 'version', 'data' => 1]);
        }
    

        if (!Schema::hasColumn('delegate', 'listid')) {
            DB::statement('ALTER TABLE `delegate` ADD `listid` INT  NULL  DEFAULT NULL  AFTER `table`;');
        }

        if (!Schema::hasColumn('mayors', 'support')) {
            DB::statement("ALTER TABLE `mayors` ADD `support` INT NULL DEFAULT '0' AFTER `full_name`;");
        }


        if (!Schema::hasColumn('delegate', 'statistics')) {
            DB::statement('ALTER TABLE `delegate` ADD `statistics` INT  NULL  DEFAULT NULL  AFTER `table`;');
        }

        if (!Schema::hasColumn('delegate', 'elections_day')) {
            DB::statement('ALTER TABLE `delegate` ADD `elections_day` INT  NULL  DEFAULT NULL  AFTER `table`;');
        }
        





        $version=DB::table('settings')->where('name','version')->first();
        
        $version=$version->data;
        if($version==1){
            DB::table('settings')->where('name','version')->update(['data'=>2]);
            $query="UPDATE `electors` t1,electors t2 SET t1.`couple`=t2.`IDNumber` WHERE `t2`.`couple` = `t1`.`IDNumber` and `t2`.`gender`=1";
            DB::statement($query);
        }

        if (!Schema::hasTable('workers')) {
            DB::statement('CREATE TABLE `workers` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
          `full_name` text,
          `iden` text,
          `cell` text,
          `password` text,
          `kalfy` int(11) DEFAULT NULL,
          `shift` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
        }
        DB::statement('ALTER TABLE `workers` CHANGE `kalfy` `kalfy` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        DB::statement('ALTER TABLE `electors` CHANGE `AddCode` `AddCode` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');


        if (!Schema::hasTable('votes_links')) {
            DB::statement('CREATE TABLE `votes_links` (
                `id` int(11) NOT NULL,
                `link_table` text,
                `kalfy` int(11) DEFAULT NULL,
                `linkId` int(11) DEFAULT NULL,
                `votes` int(11) DEFAULT "0"
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
            DB::statement("ALTER TABLE `votes_links`
             ADD PRIMARY KEY (`id`);");
            DB::statement("ALTER TABLE `votes_links`
             MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
        }
        DB::statement('ALTER TABLE `votes_links` CHANGE `kalfy` `kalfy` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;');
        
        if (!Schema::hasTable('parties')) {
            DB::statement('CREATE TABLE `parties` (
                `id` int(11) NOT NULL,
                `name` text
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
            DB::statement("ALTER TABLE `parties`
             ADD PRIMARY KEY (`id`);");
            DB::statement("ALTER TABLE `parties`
             MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
        }

        if (!Schema::hasTable('users_token')) {

            DB::statement('CREATE TABLE `users_token` (
                `id` int(11) NOT NULL,
                `link_table` text,
                `link_id` int(11) DEFAULT NULL,
                `token` text
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
              ');

            DB::statement("ALTER TABLE `users_token` ADD PRIMARY KEY (`id`);");
            DB::statement("ALTER TABLE `users_token` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

        }

       

        if (!Schema::hasColumn('delegate', 'password')) {
            DB::statement('ALTER TABLE `delegate` ADD `password` text AFTER `listid`;');
            $delegates = DB::table('delegate')->select('id')->get();
            foreach ($delegates as $delegate) {
                $pass = GF::randomPassword(1);
                DB::table('delegate')->where('id', $delegate->id)->update(['password' => $pass]);
            }

            if (!Schema::hasColumn('personal_list', 'password')) {
                DB::statement('ALTER TABLE `personal_list` ADD `password` text AFTER `under`;');
                $delegates = DB::table('personal_list')->select('id')->get();
                foreach ($delegates as $delegate) {
                    $pass = GF::randomPassword(2);
                    DB::table('personal_list')->where('id', $delegate->id)->update(['password' => $pass]);
                }
            }

            $delegates = DB::table('workers')->select('id')->get();
            foreach ($delegates as $delegate) {
                $pass = GF::randomPassword(3);
                DB::table('workers')->where('id', $delegate->id)->update(['password' => $pass]);
            }

        }


        if (!Schema::hasColumn('delegate', 'onesignal_token')) {
            DB::statement('ALTER TABLE `delegate` ADD `onesignal_token` text AFTER `password`;');
        }

        if (!Schema::hasColumn('personal_list', 'onesignal_token')) {
            DB::statement('ALTER TABLE `personal_list` ADD `onesignal_token` text AFTER `password`;');
        }


        if (!Schema::hasColumn('workers', 'onesignal_token')) {
            DB::statement('ALTER TABLE `workers` ADD `onesignal_token` text AFTER `password`;');
        }

        DB::statement("ALTER TABLE `electors` CHANGE `voted` `voted` INT(11) NULL DEFAULT '0';");
        DB::statement("ALTER TABLE `electors` CHANGE `list` `list` INT(11) NULL DEFAULT '0';");
        DB::statement("ALTER TABLE `electors` CHANGE `manid` `manid` INT(11) NULL DEFAULT '0';");
        DB::statement("ALTER TABLE `electors` CHANGE `mayor` `mayor` INT(11) NULL DEFAULT '0';");
        DB::statement("ALTER TABLE `electors` CHANGE `group` `group` INT(11) NULL DEFAULT '0';");

        
        $indexes=DB::select('SHOW INDEX FROM electors;');
        $indexKeys=[];
        foreach($indexes as $index){
            $val=substr($index->Key_name, -1);
            if(is_numeric($val)|| in_array($index->Key_name,$indexKeys)){
               try {
                   DB::statement("ALTER TABLE `electors` DROP INDEX `".$index->Key_name."`;");
               } catch (\Exception $e) {
                 
               }
              
            }else{
                if($index->Key_name!='PRIMARY') $indexKeys[]=$index->Key_name;
            }
            
        }
        $allIndexes=["IDNumber","couple","mother_id","father_id","Serial","FatherName","gender","voted","FamilyName","PersonalName","AddCode"];
        foreach($allIndexes as $ind){
            if(!in_array($ind,$indexKeys)){
               DB::statement("ALTER TABLE `electors` ADD INDEX(`".$ind."`);"); 
            }

        }


        DB::statement("update electors set `voted` = 0 where `voted` IS NULL");
        DB::statement("update electors set `list` = 0 where `list` IS NULL");
        DB::statement("update electors set `group` = 0 where `group` IS NULL");
        DB::statement("update electors set `mayor` = 0 where `mayor` IS NULL");
        DB::statement("update electors set `manid` = 0 where `manid` IS NULL");
        

    }

}
