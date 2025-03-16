<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Limpiar datos previos
        $auth->removeAll();

        // Crear permiso [Usuarios View]
        //$viewUsers = $auth->createPermission('viewUsers');
        //$viewUsers->description = 'Ver usuarios';
        //$auth->add($viewUsers);


        // Crear roles
        //$admin = $auth->createRole('Admin');
        //$auth->add($admin);
        //$auth->addChild($admin, $manageUsers);
        //$auth->addChild($admin, $viewReports);

        // Crear roles
        $roleSuperAdmin = $auth->createRole('SuperAdmin');
        $roleAdmin = $auth->createRole("Admnistrador");



        echo "RBAC inicializado correctamente.\n";
    }
}