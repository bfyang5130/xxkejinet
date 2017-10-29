<?php

namespace backend\services;

use Yii;

class BPlotService {

    public static function findUseExistList($limit, $status, $pid, $type = null) {
        $query = new Query();
        $pages = null;
        $query->select("c.id,c.pid,c.tag,c.name,c.status,c.order,p.name as parent_name")
                ->from("{{%user_exist_layout}} c")
                ->leftJoin("{{%column}} p", "p.id=c.pid")
                ->orderBy("p.id asc,c.pid asc,c.order asc,c.id asc");

        if (isset($status)) {
            $query->andWhere("c.status=:status", [":status" => $status]);
        }

        if (isset($pid)) {
            if (is_array($pid)) {
                $query->andWhere(["c.pid" => $pid]);
            } else {
                $query->andWhere("c.pid=:pid", [":pid" => $pid]);
            }
        }

        if (isset($type)) {
            $query->andWhere(["c.type" => $type]);
        }

        if (isset($limit)) {
            $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => $limit]);

            $query->offset($pages->offset)
                    ->limit($limit);
        }

        $column_list = $query->all();

        return ["list" => $column_list, "pages" => $pages];
    }

}
