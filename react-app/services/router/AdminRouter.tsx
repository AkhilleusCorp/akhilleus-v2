import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import DashboardPage from "app/pages/DashboardPage.tsx";
import ErrorPage from "app/pages/ErrorPage.tsx";
import UsersPage from "app/pages/user/UsersPage.tsx";
import UserDetailsPage from "app/pages/user/UserDetailsPage.tsx";
import * as React from "react";
import UserCreatePage from "app/pages/user/UserCreatePage.tsx";
import UserUpdatePage from "app/pages/user/UserUpdatePage.tsx";
import WorkoutsPage from "app/pages/workout/WorkoutsPage.tsx";
import WorkoutCreatePage from "app/pages/workout/WorkoutCreatePage.tsx";
import WorkoutUpdatePage from "app/pages/workout/WorkoutUpdatePage.tsx";
import WorkoutDetailsPage from "app/pages/workout/WorkoutDetailsPage.tsx";
import websiteRoutes from "./websiteRoutes.tsx";
import EquipmentsPage from "app/pages/equipment/EquipmentsPage.tsx";
import EquipmentCreatePage from "app/pages/equipment/EquipmentCreatePage.tsx";
import EquipmentUpdatePage from "app/pages/equipment/EquipmentUpdatePage.tsx";
import EquipmentDetailsPage from "app/pages/equipment/EquipmentDetailsPage.tsx";
import MusclesPage from "app/pages/muscle/MusclesPage.tsx";
import MuscleCreatePage from "app/pages/muscle/MuscleCreatePage.tsx";
import MuscleUpdatePage from "app/pages/muscle/MuscleUpdatePage.tsx";
import MuscleDetailsPage from "app/pages/muscle/MuscleDetailsPage.tsx";
import MovementsPage from "app/pages/movement/MovementsPage.tsx";
import MovementCreatePage from "app/pages/movement/MovementCreatePage.tsx";
import MovementUpdatePage from "app/pages/movement/MovementUpdatePage.tsx";
import MovementDetailsPage from "app/pages/movement/MovementDetailsPage.tsx";

const routerConfig = createBrowserRouter([
    {
        path: websiteRoutes.dashboard,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <DashboardPage />,
            }, {
                path: websiteRoutes.user.list,
                children: [
                    {
                        index: true,
                        element: <UsersPage />,
                    }, {
                        path: websiteRoutes.user.create,
                        element: <UserCreatePage />,
                    }, {
                        path: websiteRoutes.user.edit(':userId'),
                        element: <UserUpdatePage />,
                    }, {
                        path: websiteRoutes.user.details(':userId'),
                        element: <UserDetailsPage />,
                    }
                ]
            }, {
                path: websiteRoutes.workout.list,
                children: [
                    {
                        index: true,
                        element: <WorkoutsPage />,
                    }, {
                        path: websiteRoutes.workout.create,
                        element: <WorkoutCreatePage />,
                    }, {
                        path: websiteRoutes.workout.edit(':workoutId'),
                        element: <WorkoutUpdatePage />,
                    }, {
                        path: websiteRoutes.workout.details(':workoutId'),
                        element: <WorkoutDetailsPage />,
                    }
                ]
            }, {
                path: websiteRoutes.equipment.list,
                children: [
                    {
                        index: true,
                        element: <EquipmentsPage />,
                    }, {
                        path: websiteRoutes.equipment.create,
                        element: <EquipmentCreatePage />,
                    }, {
                        path: websiteRoutes.equipment.edit(':equipmentId'),
                        element: <EquipmentUpdatePage />,
                    }, {
                        path: websiteRoutes.equipment.details(':equipmentId'),
                        element: <EquipmentDetailsPage />,
                    }
                ]
            }, {
                path: websiteRoutes.muscle.list,
                children: [
                    {
                        index: true,
                        element: <MusclesPage />,
                    }, {
                        path: websiteRoutes.muscle.create,
                        element: <MuscleCreatePage />,
                    }, {
                        path: websiteRoutes.muscle.edit(':muscleId'),
                        element: <MuscleUpdatePage />,
                    }, {
                        path: websiteRoutes.muscle.details(':muscleId'),
                        element: <MuscleDetailsPage />,
                    }
                ]
            }, {
                path: websiteRoutes.movement.list,
                children: [
                    {
                        index: true,
                        element: <MovementsPage />,
                    }, {
                        path: websiteRoutes.movement.create,
                        element: <MovementCreatePage />,
                    }, {
                        path: websiteRoutes.movement.edit(':movementId'),
                        element: <MovementUpdatePage />,
                    }, {
                        path: websiteRoutes.movement.details(':movementId'),
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