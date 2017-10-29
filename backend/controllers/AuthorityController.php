<?php

namespace backend\controllers;

use common\service\Encrypt3DesService;
use Yii;
use backend\models\form\ColumnForm;
use common\services\ColumnService;
use backend\services\RbacService;
use yii\helpers\Url;
use backend\models\form\RoleForm;
use backend\models\form\RolePermissionForm;
use backend\models\form\UserAssignmentForm;
use backend\models\form\PermissionForm;
use backend\models\form\UploadForm;
use yii\web\UploadedFile;

/**
 * 栏目管理类
 */
class AuthorityController extends BaseController {
    /**
     * 权限控制的布局处理
     */
    public $layout='authority';

    /**
     * 顶级模块页面
     */
    public function actionIndex() {
        return $this->render("index");
    }

    /**
     * 增加栏目
     */
    public function actionAddColumn() {
        $model = new ColumnForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addColumn();
            if ($add_rs['status'] == true) {
                RbacService::addPermissionbyColumn($model->pid, $model->tag);
            }
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/index"])]);
        }
        return $this->render("add_column", ["model" => $model]);
    }

    /**
     * 子栏目页面
     */
    public function actionSubColumn() {
        return $this->render("sub_column");
    }

    /**
     * 更新栏目
     */
    public function actionUpdColumn() {
        $column_id = Yii::$app->request->get("column_id");
        if (empty($column_id)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/index"])]);
        }
        $column = ColumnService::findColumnById($column_id);
        $model = new ColumnForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addColumn();
            if ($add_rs['status'] == true) {
                RbacService::addPermissionbyColumn($model->pid, $model->tag, $column['tag']);
            }
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/index"])]);
        }
        $model->setAttributes($column->getAttributes());
        return $this->render("upd_column", ["model" => $model]);
    }

    /**
     * 删除栏目
     */
    public function actionDelColumn() {
        $column_id = Yii::$app->request->get("column_id");
        if (empty($column_id)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/index"])]);
        }
        $column = ColumnService::findColumnById($column_id);
        $del_rs = ColumnService::delColumnById($column_id);
        if ($del_rs['status'] == true) {
            RbacService::removePermissionbyColumn($column);
        }
        return $this->redirect(["tip/index", "msg" => $del_rs['msg'], "url" => Yii::$app->getRequest()->referrer]);
    }

    /**
     * 角色列表
     */
    public function actionRole() {
        return $this->render("role");
    }

    /**
     * 增加角色
     */
    public function actionAddRole() {
        $model = new RoleForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addRole();
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/role"])]);
        }
        return $this->render("add_role", ["model" => $model]);
    }

    /**
     * 更新角色
     */
    public function actionUpdRole() {
        $role_name = Yii::$app->request->get("role_name");
        if (empty($role_name)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/role"])]);
        }
        $model = new RoleForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $upd_rs = $model->updRole();
            return $this->redirect(["tip/index", "msg" => $upd_rs['msg'], "url" => Url::toRoute(["/column/role"])]);
        }
        $role = RbacService::findRoleByName($role_name);
        $model->name = $role->name;
        $model->desc = $role->description;
        return $this->render("upd_role", ["model" => $model]);
    }

    /**
     * 删除角色
     */
    public function actionDelRole() {
        $role_name = Yii::$app->request->get("role_name");
        if (empty($role_name)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/role"])]);
        }
        $del_rs = RbacService::delRole($role_name);
        return $this->redirect(["tip/index", "msg" => $del_rs['msg'], "url" => Url::toRoute(["/column/role"])]);
    }

    public function actionPermission() {
        $role_name = Yii::$app->request->get("role_name");
        if (!empty($role_name)) {
            $role_name = Yii::$app->request->get("role_name");
            $permissions = RbacService::findPermissionsByRole($role_name);
        } else {
            $permissions = RbacService::findPermissions();
        }
        return $this->render("permission", ["permissions" => $permissions]);
    }

    public function actionAddRolePermission() {
        $role_name = Yii::$app->request->get("role_name");
        if (empty($role_name)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/role"])]);
        }
        $model = new RolePermissionForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addRolePermission();
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/role"])]);
        }
        return $this->render("add_role_permission", ["model" => $model]);
    }

    /**
     * 角色分配列表
     */
    public function actionAssignment() {
        return $this->render("assignment");
    }

    /**
     * 给用户分配角色
     */
    public function actionAddUserAssignment() {
        $model = new UserAssignmentForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addUserAssignment();
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/assignment"])]);
        }
        return $this->render("add_user_assignment", ["model" => $model]);
    }

    /**
     * 增加权限
     */
    public function actionAddPermission() {
        $model = new PermissionForm();
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = $model->addPermission();
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/permission"])]);
        }
        return $this->render("add_permission", ["model" => $model]);
    }

    /**
     * 上传
     */
    public function actionUpload() {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $image_url = Yii::getAlias("@image/web");
                $model->file->saveAs($image_url . '/uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * 编辑角色权限
     */
    public function actionEditRolePermission() {
        $role_name = Yii::$app->request->get("role_name");
        if (empty($role_name)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/role"])]);
        }
        $model = new RolePermissionForm();
        //角色当前所拥有权限
        $edit_re = RbacService::findPermissionsByRole($role_name);
        $my_permis = array();
        foreach ($edit_re as $key => $value) {
            $my_permis[] = $value->name;
        }
        //全部模块栏目
        $column_arr = ColumnService::findColumnList(null, null, 0);
        //全部权限
        $permissions = RbacService::findPermissions();
        $edit_all = array();
        foreach ($permissions as $key => $value) {
            $edit_all[$key]['name'] = $value->name;
            $edit_all[$key]['description'] = $value->description;
            $edit_all[$key]['createdAt'] = $value->createdAt;
            //拆分权限name用于跟模块tag对应
            $ex_column = explode('/', $value->name);
            $edit_all[$key]['column_name'] = $ex_column[0];
        }
        //不改变查询结构，对所有权限重新进行排序，按添加时间
        foreach ($edit_all AS $uniqid => $row) {
            foreach ($row AS $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        array_multisort($arrSort['createdAt'], SORT_ASC, $edit_all);
        //对模块栏目数据进行遍历
        $column_all = array();
        $column_alls = array();
        foreach ($column_arr['list'] as $key => $value) {
            $column_all[$key]['tag'] = $value['tag'];
            $column_all[$key]['tag_name'] = $value['name'];
            //把存在的模块集合用于判断不属于模块的权限问题
            $column_alls[] = $value['tag'];
        }
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $post_datas = $post_data['RolePermissionForm']['permission'];
            //根据角色所拥有的权限对比传值需要修改的权限,取差值,删除权限
            $diff_data = array_diff($my_permis, $post_datas);
            //根据传值需要修改的权限对比角色所拥有的权限,取差值,增加权限
            $diff_post = array_diff($post_datas, $my_permis);

            if ($diff_data) {
                RbacService::delRolePermissions($role_name, $diff_data);
            }
            if ($diff_post) {
                RbacService::addRolePermissions($role_name, $diff_post);
            }
            return $this->redirect(["tip/index", "msg" => '角色权限操作成功', "url" => Url::toRoute(["/column/role"])]);
        }
        return $this->render("edit_role_permission", ["model" => $model, "edit_res" => $my_permis, "edit_all" => $edit_all, 'column_all' => $column_all, 'column_alls' => $column_alls]);
    }

    /**
     * 删除权限
     */
    public function actionDelPermission() {
        $role_name = Yii::$app->request->get("role_name");
        if (empty($role_name)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/permission"])]);
        }
        $del_rs = RbacService::delPermission($role_name);
        return $this->redirect(["tip/index", "msg" => $del_rs['msg'], "url" => Url::toRoute(["/column/permission"])]);
    }

    /**
     * 删除用户角色分配
     */
    public function actionDelUserAssignment() {
        $role_name = Yii::$app->request->get("role_name");
        $user_id = Yii::$app->request->get("user_id");
        if (empty($role_name) || empty($user_id)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/assignment"])]);
        }
        $del_rs = RbacService::delUserAssignment($role_name, $user_id);
        return $this->redirect(["tip/index", "msg" => $del_rs['msg'], "url" => Url::toRoute(["/column/assignment"])]);
    }

    /**
     * 编辑用户角色分配
     */
    public function actionEditUserAssignment() {
        $model = new UserAssignmentForm();
        $role_name = Yii::$app->request->get("role_name");
        $user_id = Yii::$app->request->get("user_id");
        $model->rolename = $role_name;
        //执行提交修改操作
        $post_data = Yii::$app->request->post();
        if ($model->load($post_data) && $model->validate()) {
            $add_rs = RbacService::editUserAssignment($post_data['UserAssignmentForm']['user_id'], $post_data['UserAssignmentForm']['rolename'], $post_data['UserAssignmentForm']['rolename_old']);
            return $this->redirect(["tip/index", "msg" => $add_rs['msg'], "url" => Url::toRoute(["/column/assignment"])]);
        }

        if (empty($role_name) || empty($user_id)) {
            return $this->redirect(["tip/index", "msg" => "请不要乱操作", "url" => Url::toRoute(["/column/assignment"])]);
        }

        return $this->render("edit_user_assignment", ["model" => $model, "role_name" => $role_name, "user_id" => $user_id]);
    }

    public function actionCryptDes() {
        $inputData = Yii::$app->request->post("inputData", '');
        $type = Yii::$app->request->post("type", 'encrypt');
        $outData = '';
        if (!empty($inputData)) {
            $encryptKey = Yii::$app->params['3des_key'];
            $des = new Encrypt3DesService($encryptKey);
            if ($type == "encrypt") {
                $outData = $des->encrypt($inputData);
            } elseif ($type == "decrypt") {
                $outData = $des->decrypt($inputData);
            }
        }
        return $this->render("crypt_des", ["outData" => $outData, "inputData" => $inputData]);
    }

}
