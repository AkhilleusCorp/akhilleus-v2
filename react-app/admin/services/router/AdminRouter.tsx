import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";
import * as React from "react";

import AdminDashboardPage from "app/admin/pages/AdminDashboardPage.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import UsersPage from "app/admin/pages/user/UsersPage.tsx";
import UserDetailsPage from "app/admin/pages/user/UserDetailsPage.tsx";
import UserCreatePage from "app/admin/pages/user/UserCreatePage.tsx";
import UserUpdatePage from "app/admin/pages/user/UserUpdatePage.tsx";
import WorkoutsPage from "app/admin/pages/workout/WorkoutsPage.tsx";
import WorkoutCreatePage from "app/admin/pages/workout/WorkoutCreatePage.tsx";
import WorkoutUpdatePage from "app/admin/pages/workout/WorkoutUpdatePage.tsx";
import WorkoutDetailsPage from "app/admin/pages/workout/WorkoutDetailsPage.tsx";
import EquipmentsPage from "app/admin/pages/equipment/EquipmentsPage.tsx";
import EquipmentCreatePage from "app/admin/pages/equipment/EquipmentCreatePage.tsx";
import EquipmentUpdatePage from "app/admin/pages/equipment/EquipmentUpdatePage.tsx";
import EquipmentDetailsPage from "app/admin/pages/equipment/EquipmentDetailsPage.tsx";
import MusclesPage from "app/admin/pages/muscle/MusclesPage.tsx";
import MuscleCreatePage from "app/admin/pages/muscle/MuscleCreatePage.tsx";
import MuscleUpdatePage from "app/admin/pages/muscle/MuscleUpdatePage.tsx";
import MuscleDetailsPage from "app/admin/pages/muscle/MuscleDetailsPage.tsx";
import MovementsPage from "app/admin/pages/movement/MovementsPage.tsx";
import MovementCreatePage from "app/admin/pages/movement/MovementCreatePage.tsx";
import MovementUpdatePage from "app/admin/pages/movement/MovementUpdatePage.tsx";
import MovementDetailsPage from "app/admin/pages/movement/MovementDetailsPage.tsx";
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
                        element: <UsersPage />,
                    }, {
                        path: adminRoutes.user.create,
                        element: <UserCreatePage />,
                    }, {
                        path: adminRoutes.user.edit(':userId'),
                        element: <UserUpdatePage />,
                    }, {
                        path: adminRoutes.user.details(':userId'),
                        element: <UserDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.workout.list,
                children: [
                    {
                        index: true,
                        element: <WorkoutsPage />,
                    }, {
                        path: adminRoutes.workout.create,
                        element: <WorkoutCreatePage />,
                    }, {
                        path: adminRoutes.workout.edit(':workoutId'),
                        element: <WorkoutUpdatePage />,
                    }, {
                        path: adminRoutes.workout.details(':workoutId'),
                        element: <WorkoutDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.equipment.list,
                children: [
                    {
                        index: true,
                        element: <EquipmentsPage />,
                    }, {
                        path: adminRoutes.equipment.create,
                        element: <EquipmentCreatePage />,
                    }, {
                        path: adminRoutes.equipment.edit(':equipmentId'),
                        element: <EquipmentUpdatePage />,
                    }, {
                        path: adminRoutes.equipment.details(':equipmentId'),
                        element: <EquipmentDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.muscle.list,
                children: [
                    {
                        index: true,
                        element: <MusclesPage />,
                    }, {
                        path: adminRoutes.muscle.create,
                        element: <MuscleCreatePage />,
                    }, {
                        path: adminRoutes.muscle.edit(':muscleId'),
                        element: <MuscleUpdatePage />,
                    }, {
                        path: adminRoutes.muscle.details(':muscleId'),
                        element: <MuscleDetailsPage />,
                    }
                ]
            }, {
                path: adminRoutes.movement.list,
                children: [
                    {
                        index: true,
                        element: <MovementsPage />,
                    }, {
                        path: adminRoutes.movement.create,
                        element: <MovementCreatePage />,
                    }, {
                        path: adminRoutes.movement.edit(':movementId'),
                        element: <MovementUpdatePage />,
                    }, {
                        path: adminRoutes.movement.details(':movementId'),
                        element: <MovementDetailsPage />,
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