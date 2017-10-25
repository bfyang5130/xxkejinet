<?php
namespace common\services ;
use yii\db\Query ;
use yii\data\Pagination ;
use app\models\Column ;
/**
 * 栏目管理服务类
 *
 * @author Administrator
 */
class ColumnService {

    const RIGHT_TYPE = "right" ;
    const SUB_TYPE = "sub" ;
    
    public static function findColumnList($limit,$status,$pid,$type=null){
        $query = new Query() ;
        $pages = null ;
        $query->select("c.id,c.pid,c.tag,c.name,c.status,c.order,p.name as parent_name")
              ->from("{{%column}} c")
              ->leftJoin("{{%column}} p","p.id=c.pid")
              ->orderBy("p.id asc,c.pid asc,c.order asc,c.id asc") ;
        
        if(isset($status)){
            $query->andWhere("c.status=:status",[":status"=>$status]);
        }
        
        if(isset($pid)){
            if(is_array($pid)){
                $query->andWhere(["c.pid"=>$pid]);
            }else{
                $query->andWhere("c.pid=:pid",[":pid"=>$pid]);
            }
        }

        if(isset($type)){
            $query->andWhere(["c.type"=>$type]);
        }
        
        if(isset($limit)){
            $pages = new Pagination(['totalCount' =>$query->count(), 'defaultPageSize' => $limit]);

            $query->offset($pages->offset)
                ->limit($limit) ;
        }        
        
        $column_list = $query->all() ;
        
        return ["list"=>$column_list,"pages"=>$pages] ;
        
    }
    
    public static function findColumnById($column_id){
        $column = Column::findOne(["id"=>$column_id]) ;
        return $column ;
    }    
    
    public static function findSubColumnByTag($tag){
        $query = new Query() ;
        $column = $query->select("id")
              ->from("{{%column}}")
              ->where("tag=:tag and status = 1",[":tag"=>$tag])
              ->one() ;
        $sub_query = new Query() ;
        $sub_column_list =$sub_query->select("name,tag,params")
            ->from("{{%column}}")
            ->where("pid=:pid and status = 1",[":pid"=>$column['id']])
            ->orderBy("order asc ")
            ->all() ;
        return $sub_column_list ;
    }
    
    public static function findColumnByTag($tag){
        $column = Column::findOne(["tag"=>$tag]) ;
        return $column ;
    }    
    
    public static function findSubColumnOne($tag,$pid){
        $column = Column::findOne(["tag"=>$tag,"pid"=>$pid]) ;
        return $column ;
    }     
    
    public static function delColumnById($column_id){
        $column = Column::findOne(["id"=>$column_id]) ;
        $del_rs = $column->delete() ;
        if($del_rs==true){
            return ["status"=>true,"msg"=>"删除成功"];
        }else{
            return ["status"=>false,"msg"=>"删除失败"];
        }
    }        
    
}
