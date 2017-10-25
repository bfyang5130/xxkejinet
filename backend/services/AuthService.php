<?php
namespace backend\services ;
use app\models\AppStoreAudit;
use common\service\ColumnService;
use yii\db\Query ;
use yii\data\Pagination ;
use Yii ;
use yii\helpers\ArrayHelper;

//权限服务
class AuthService {

    public static function findItemChildByUserId($user_id){
        $query = new Query() ;
        $pages = null ;
        $select = "*" ;
        $query->select($select)
            ->from("{{%auth_assignment}}")
            ->where(["user_id"=>$user_id]) ;

        $role_obj = $query->one() ;
        if(empty($role_obj['item_name'])){
            return [] ;
        }else{
            $role = $role_obj['item_name'] ;
        }

        $query = new Query() ;
        $pages = null ;
        $select = "*" ;
        $query->select($select)
            ->from("{{%auth_item_child}}") ;

        if(!empty($role)){
            $query->andWhere(["parent"=>$role]) ;
        }
        $childs = $query->all() ;

        $control_arr = [] ;
        foreach($childs as $child){
            $item = $child['child'] ;
            $item_arr = explode("/",$item) ;
            if(!empty($item_arr[0])&& in_array($item_arr[0],$control_arr)==false){
                array_push($control_arr,$item_arr[0]) ;
            }
        }

        return $control_arr ;
    }

    /**
     * 获取用户权限
     * @param $user_id
     * @return array
     */
    public static function findUserAuths($user_id){
        $query = new Query() ;
        $pages = null ;
        $select = "*" ;
        $query->select($select)
            ->from("{{%auth_assignment}}")
            ->where(["user_id"=>$user_id]) ;

        $role_obj = $query->one() ;
        if(empty($role_obj['item_name'])){
            return [] ;
        }else{
            $role = $role_obj['item_name'] ;
        }

        $query = new Query() ;
        $pages = null ;
        $select = "*" ;
        $query->select($select)
            ->from("{{%auth_item_child}}") ;

        if(!empty($role)){
            $query->andWhere(["parent"=>$role]) ;
        }
        $childs = $query->all() ;
        $auths = ArrayHelper::getColumn($childs,"child") ;
        return $auths;
    }

    /**
     * 获取用户登陆后的地址
     */
    public static function getUserLoginUrl($username,$user_id){
        $top_column_arr = ColumnService::findColumnList(null,1,0) ;
        $url = "/site/index" ;
        if($username!="admin"){
            $moduleNameArr = array_keys(Yii::$app->modules) ;
            $controller_arr = AuthService::findItemChildByUserId($user_id) ;
            if(!empty($controller_arr[0])){
                foreach($top_column_arr['list'] as $val){
                    if(in_array($val['tag'],$controller_arr)){
                        if(in_array($val['tag'],$moduleNameArr)){
                            //模块
                            $url = "/".$val['tag'] ;
                            return $url ;
                        }else{
                            $controller = $val['tag'] ;
                            $url = "/{$controller}/index" ;
                            return $url ;
                        }
                    }
                }
            }
            return $url  ;
        }else{
            //admin账号
            if(!empty($top_column_arr)){
                $controller = $top_column_arr['list'][0]['tag'];
                $url = "/{$controller}/index" ;
            }
            return $url  ;
        }
    }

}
