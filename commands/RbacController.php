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
        $roleRecursosMateriales = $auth->createRole('Recursos materiales');
        $roleProveedorA = $auth->createRole('Proveedor A');
        $roleProveedorB = $auth->createRole('Proveedor B');
        $roleUIE = $auth->createRole('UIE');
        $roleAutoridadEscolar = $auth->createRole('Autoridad Escolar');


        echo "RBAC inicializado correctamente.\n";
    }
}