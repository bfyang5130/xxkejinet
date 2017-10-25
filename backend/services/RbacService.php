<?php
namespace backend\services ;
use Yii ;
use common\service\ColumnService ;
use common\models\User ;
class RbacService {
    
    public static function addPermission($permission_name,$desc){
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($permission_name) ;
        if(!empty($permission)){
            return ["status"=>false,"msg"=>"权限已存在"] ;
        }
        $create_permission = $auth->createPermission($permission_name);
        $create_permission->description = $desc;
        $auth->add($create_permission);        
        return ["status"=>true,"msg"=>"增加权限成功"] ;
    }    
    
    public static function addPermissionbyColumn($pid,$column_tag,$old_column_tag=null){
        
        $column = ColumnService::findSubColumnOne($column_tag,$pid) ;
        if(empty($column)){
            return ["status"=>false , "msg"=>"栏目不存在"] ;
        }
        if($column['pid'] <=0){
            return ["status"=>false , "msg"=>"不是子栏目,不需要加权限"] ;
        }
        $top_column = ColumnService::findColumnById($column['pid']) ;
        if(empty($top_column)){
            return ["status"=>false , "msg"=>"顶级栏目不存在"] ;
        }
        
        if(isset($old_column_tag) && $column_tag!=$old_column_tag){
            $permissioin_name = $top_column['tag'] ."/".$old_column_tag ;
        }else{
            $permissioin_name = $top_column['tag'] ."/".$column_tag ;
        }
        
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($permissioin_name) ;
        if(empty($permission)){
            $create_permission = $auth->createPermission($permissioin_name);
            $create_permission->description = $column['name'];
            $auth->add($create_permission);
        }else{
            $name = $top_column['tag'] ."/".$column_tag ;
            $permission->name = $name ;
            $permission->description = $column['name'];
            $auth->update($permissioin_name, $permission) ;
        }
    }
    
    public static function removePermissionbyColumn($column){
        
        if(empty($column)){
            return ["status"=>false , "msg"=>"栏目不存在"] ;
        }
        if($column['pid'] <=0){
            return ["status"=>false , "msg"=>"不是子栏目,不需要加权限"] ;
        }
        $top_column = ColumnService::findColumnById($column['pid']) ;
        if(empty($top_column)){
            return ["status"=>false , "msg"=>"顶级栏目不存在"] ;
        }
        
        $permissioin_name = $top_column['tag'] ."/".$column['tag'] ;
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($permissioin_name) ;
        if(!empty($permission)){
            $auth->remove($permission) ;
        }
    }    
    
    public static function addRole($role_name,$desc){
        $auth = Yii::$app->authManager;
        $cur_role = $auth->getRole($role_name) ;
        if(!empty($cur_role)){
            return ["status"=>false,"msg"=>"角色已存在"] ;
        }
        $role = $auth->createRole($role_name);
        $role->description = $desc ;
        $auth->add($role);        
        return ["status"=>true,"msg"=>"角色增加成功"] ;
    }
    
    public static function updRole($orig_name,$new_name,$desc){
        $auth = Yii::$app->authManager;
        $orig_role = $auth->getRole($orig_name) ;
        $orig_role->name = $new_name ;
        $orig_role->description = $desc ;
        if(empty($orig_role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        $auth->update($orig_name, $orig_role) ;
        return ["status"=>true,"msg"=>"角色修改成功"] ;
    }
    
    public static function delRole($role_name){
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role_name) ;
        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        $auth->remove($role) ;
        return ["status"=>true,"msg"=>"角色移除成功"] ;
    }    
    
    public static function findRoleByName($name){
        $auth = Yii::$app->authManager;
        $roles = $auth->getRole($name) ;       
        return  $roles ;
    }

    public static function findRoles(){
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles() ;
        return $roles ;
    }
    
    public static function findPermissionsByRole($role_name){
       $auth = Yii::$app->authManager;
       $permissions = $auth->getPermissionsByRole($role_name) ;
       return $permissions ; 
    }
    
    public static function findPermissions(){
        $auth = Yii::$app->authManager;
        $permissions = $auth->getPermissions() ;
        return $permissions ;
    }
    
    public static function findNewPermissions($role_name){
        $all_permissions = self::findPermissions() ;
        $cur_role_permissions = self::findPermissionsByRole($role_name) ;
        $new_premissions = [] ;
        //用户没权限,返回所有权限
        if(empty($cur_role_permissions)){
            foreach ($all_permissions as $key => $value) {
                $new_premissions[$key] = $value->description ;
            }
            return $new_premissions ;
        }
        //去掉已有的权限
        foreach ($all_permissions as $key => $value) {
            $exist = array_key_exists($key, $cur_role_permissions) ;
            if(empty($exist)){
                $new_premissions[$key] = $value->description ;
            }
        }
        return $new_premissions ;
    }
    
    public static function addRolePermissions($role_name,$permissions){
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role_name) ;
        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        if(empty($permissions)){
            return ["status"=>false,"msg"=>"请先选中权限"] ;
        }
        foreach ($permissions as $value){
            $permission =  $auth->getPermission($value) ;
            $auth->addChild($role, $permission) ;
        }
        return ["status"=>true,"msg"=>"角色增加权限成功"] ;
    }
    
    public static function findAssignments(){
        $user_list = User::findAll(["type_id"=>2]) ;
        $auth = Yii::$app->authManager;
        $all_assigment = [] ;
        foreach ($user_list as $user){
            $user_id = $user->user_id ;
            $assigments = $auth->getAssignments($user_id) ;
            $all_assigment[] = $assigments ;
        }
        return $all_assigment ;
    }
    
    public static function addUserAssignment($user_id,$rolename){
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($rolename) ;
        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        $assignment = $auth->getAssignment($rolename,$user_id) ;
        if(!empty($assignment)){
            return ["status"=>false,"msg"=>"该角色已分配此角色"] ;
        }
        $auth->assign($role, $user_id) ;
        return ["status"=>true,"msg"=>"分配用户角色成功"] ;
    }   
	/*
	*删除角色分配的权限
	*/	
	public static function delRolePermissions($role_name,$permissions){
		$auth = Yii::$app->authManager;
        $role = $auth->getRole($role_name) ;
        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        if(empty($permissions)){
            return ["status"=>false,"msg"=>"请先选中权限"] ;
        }
        foreach ($permissions as $value){
            $permission =  $auth->getPermission($value) ;
            $auth->removeChild($role, $permission) ;
        }
        return ["status"=>true,"msg"=>"角色增加权限成功"] ;
    }
    /*
	*删除权限
	*/	
	public static function delPermission($role_name){
		$auth = Yii::$app->authManager;
        $permission = $auth->getPermission($role_name) ;
        if(empty($permission)){
            return ["status"=>false,"msg"=>"操作错误!"] ;
        }
        $create_permission = $auth->createPermission($role_name);
		$auth->remove($create_permission);        
        return ["status"=>true,"msg"=>"删除权限成功"] ;
    }
	/*
	*删除分配用户角色
	*/
	public static function delUserAssignment($role_name,$user_id){
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role_name) ;

        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        $assignment = $auth->getAssignment($role_name,$user_id) ;
        if(empty($assignment)){
            return ["status"=>false,"msg"=>"该用户角色不存在"] ;
        }
        $auth->revoke($role, $user_id) ;
        return ["status"=>true,"msg"=>"删除成功"] ;
		
	}
	/*
	*修改分配用户角色
	*/
	public static function editUserAssignment($user_id,$rolename,$rolename_old){
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($rolename) ;
        if(empty($role)){
            return ["status"=>false,"msg"=>"角色不存在"] ;
        }
        $assignment = $auth->getAssignment($rolename,$user_id) ;
        if(!empty($assignment)){
            return ["status"=>false,"msg"=>"该角色已分配此角色"] ;
        }
		//不修改核心直接sql修改
		$sql = "update ".$auth->assignmentTable." set item_name =:item_name where item_name =:item_name_old and user_id=:user_id";
		$effectRows = Yii::$app->db->createCommand($sql, [':item_name' => $rolename,':item_name_old'=>$rolename_old,':user_id'=>$user_id])->execute();//返回受影响行数
		if($effectRows){
			return ["status"=>true,"msg"=>"修改用户角色成功"] ;
		}else{
			return ["status"=>false,"msg"=>"修改用户角色失败"] ;
		}        
    } 
}
