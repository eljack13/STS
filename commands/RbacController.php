<?php
// commands/RbacController.php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Crear permisos
        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'Ver lista de usuarios';
        $auth->add($viewUsers);

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Crear nuevos usuarios';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Actualizar usuarios existentes';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Eliminar usuarios';
        $auth->add($deleteUser);

        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Acceso al panel de administración';
        $auth->add($adminPanel);

        // Crear rol de usuario regular
        $userRole = $auth->createRole('usuario');
        $auth->add($userRole);
        // Los usuarios regulares solo tienen acceso al frontend y sus propios datos

        // Crear rol de administrador
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
        $auth->addChild($adminRole, $viewUsers);
        $auth->addChild($adminRole, $createUser);
        $auth->addChild($adminRole, $updateUser);
        $auth->addChild($adminRole, $deleteUser);
        $auth->addChild($adminRole, $adminPanel);
        $auth->addChild($adminRole, $userRole); // Admin hereda permisos de usuario regular

        echo "RBAC inicializado con éxito.\n";
        return ExitCode::OK;
    }
}