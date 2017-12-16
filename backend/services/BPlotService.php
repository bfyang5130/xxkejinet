<?php

namespace backend\services;

use yii\db\Query;
use yii\data\Pagination;

class BPlotService {

    public static function findUseExistList($limit, $status, $type = null) {
        $query = new Query();
        $pages = null;
        $query->select("*")
                ->from("{{%user_exist_layout}}")
                ->orderBy("create_time");

        if (isset($status)) {
            $query->andWhere("status=:status", [":status" => $status]);
        }

        if (isset($type)) {
            $query->andWhere(["type" => $type]);
        }

        if (isset($limit)) {
            $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => $limit]);

            $query->offset($pages->offset)
                    ->limit($limit);
        }

        $column_list = $query->all();

        return ["list" => $column_list, "pages" => $pages];
    }

    /**
     * 
     * @param type $limit
     * @param type $status
     * @param type $layout_author_id
     * @param type $type
     * @return type
     */
    public static function findUserDesignLayoutList($limit, $status=null, $layout_author_id=null, $type = null) {
        $query = new Query();
        $pages = null;
        $query->select("*")
                ->from("{{%layout}}")
                ->orderBy("add_time");

        if (isset($status)) {
            $query->andWhere("layout_status=:status", [":status" => $status]);
        }
        if (isset($layout_author_id)) {
            $query->andWhere("layout_author_id=:layout_author_id", [":layout_author_id" => $layout_author_id]);
        }
        if (isset($type)) {
            $query->andWhere(["type" => $type]);
        }

        if (isset($limit)) {
            $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => $limit]);

            $query->offset($pages->offset)->limit($limit);
        }

        $column_list = $query->all();
        return ["list" => $column_list, "pages" => $pages];
    }

    /**
     * 
     * @return type
     * 返回布局类型
     */
    public static function getLayoutType() {
        return [
            '0' => "首页",
            '1' => '类别',
            '2' => "列表",
            '3' => '文章',
            '4' => '专题',
        ];
    }

}
