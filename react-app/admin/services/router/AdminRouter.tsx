import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";
import * as React from "react";

import AdminDashboardPage from "app/admin/pages/AdminDashboardPage.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import AdminUsersPage from "app/admin/pages/user/AdminUsersPage.tsx";
import AdminUserDetailsPage from "app/admin/pages/user/AdminUserDetailsPage.tsx";
import AdminUserCreatePage from "app/admin/pages/user/AdminUserCreatePage.tsx";
import AdminUserUpdatePage from "app/admin/pages/user/AdminUserUpdatePage.tsx";
import AdminWorkoutsPage from "app/admin/pages/workout/AdminWorkoutsPage.tsx";
import AdminWorkoutCreatePage from "app/admin/pages/workout/AdminWorkoutCreatePage.tsx";
import AdminWorkoutUpdatePage from "app/admin/pages/workout/AdminWorkoutUpdatePage.tsx";
import AdminWorkoutDetailsPage from "app/admin/pages/workout/AdminWorkoutDetailsPage.tsx";
import AdminEquipmentsPage from "app/admin/pages/equipment/AdminEquipmentsPage.tsx";
import AdminEquipmentCreatePage from "app/admin/pages/equipment/AdminEquipmentCreatePage.tsx";
import AdminEquipmentUpdatePage from "app/admin/pages/equipment/AdminEquipmentUpdatePage.tsx";
import AdminEquipmentDetailsPage from "app/admin/pages/equipment/AdminEquipmentDetailsPage.tsx";
import AdminMusclesPage from "app/admin/pages/muscle/AdminMusclesPage.tsx";
import AdminMuscleCreatePage from "app/admin/pages/muscle/AdminMuscleCreatePage.tsx";
import AdminMuscleUpdatePage from "app/admin/pages/muscle/AdminMuscleUpdatePage.tsx";
import AdminMuscleDetailsPage from "app/admin/pages/muscle/AdminMuscleDetailsPage.tsx";
import AdminMovementsPage from "app/admin/pages/movement/AdminMovementsPage.tsx";
import AdminMovementCreatePage from "app/admin/pages/movement/AdminMovementCreatePage.tsx";
import AdminMovementUpdatePage from "app/admin/pages/movement/AdminMovementUpdatePage.tsx";
import AdminMovementDetailsPage from "app/admin/pages/movement/AdminMovementDetailsPage.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";

const routerConfig = createBrowserRouter([
    {
        path: adminRoutes.dashboard,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <AdminDashboardPage />,
            }, {
                path: adminRoutes.user.list,
                children: [
                    {
                        index: true,
                        element: <AdminUsersPage />,
                    }, {
                        path: adminRoutes.user.create,
                        element: <AdminUserCreatePage />,
                    }, {
                        path: adminRoutes.user.edit(':userId'),
                        element: <AdminUserUpdatePage />,
                    }, {
                        path: adminRoutes.user.details(':userId'),
                        element: <AdminUserDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.workout.list,
                children: [
                    {
                        index: true,
                        element: <AdminWorkoutsPage />,
                    }, {
                        path: adminRoutes.workout.create,
                        element: <AdminWorkoutCreatePage />,
                    }, {
                        path: adminRoutes.workout.edit(':workoutId'),
                        element: <AdminWorkoutUpdatePage />,
                    }, {
                        path: adminRoutes.workout.details(':workoutId'),
                        element: <AdminWorkoutDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.equipment.list,
                children: [
                    {
                        index: true,
                        element: <AdminEquipmentsPage />,
                    }, {
                        path: adminRoutes.equipment.create,
                        element: <AdminEquipmentCreatePage />,
                    }, {
                        path: adminRoutes.equipment.edit(':equipmentId'),
                        element: <AdminEquipmentUpdatePage />,
                    }, {
                        path: adminRoutes.equipment.details(':equipmentId'),
                        element: <AdminEquipmentDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.muscle.list,
                children: [
                    {
                        index: true,
                        element: <AdminMusclesPage />,
                    }, {
                        path: adminRoutes.muscle.create,
                        element: <AdminMuscleCreatePage />,
                    }, {
                        path: adminRoutes.muscle.edit(':muscleId'),
                        element: <AdminMuscleUpdatePage />,
                    }, {
                        path: adminRoutes.muscle.details(':muscleId'),
                        element: <AdminMuscleDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.movement.list,
                children: [
                    {
                        index: true,
                        element: <AdminMovementsPage />,
                    }, {
                        path: adminRoutes.movement.create,
                        element: <AdminMovementCreatePage />,
                    }, {
                        path: adminRoutes.movement.edit(':movementId'),
                        element: <AdminMovementUpdatePage />,
                    }, {
                        path: adminRoutes.movement.details(':movementId'),
                        element: <AdminMovementDetailsPage />,
                    }
                ]
            },
        ]
    },
]);

const AdminRouter: React.FC = () => {
    return (
        <React.StrictMode>
            <RouterProvider router={routerConfig}/>
        </React.StrictMode>
    );
}

export default AdminRouter;