import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import DashboardPage from "../../pages/DashboardPage.tsx";
import ErrorPage from "../../pages/ErrorPage.tsx";
import UsersPage from "../../pages/user/UsersPage.tsx";
import UserDetailsPage from "../../pages/user/UserDetailsPage.tsx";
import * as React from "react";
import UserCreatePage from "../../pages/user/UserCreatePage.tsx";
import UserUpdatePage from "../../pages/user/UserUpdatePage.tsx";
import WorkoutsPage from "../../pages/workout/WorkoutsPage.tsx";
import WorkoutCreatePage from "../../pages/workout/WorkoutCreatePage.tsx";
import WorkoutUpdatePage from "../../pages/workout/WorkoutUpdatePage.tsx";
import WorkoutDetailsPage from "../../pages/workout/WorkoutDetailsPage.tsx";
import websiteRoutes from "./websiteRoutes.tsx";
import EquipmentsPage from "../../pages/equipment/EquipmentsPage.tsx";
import EquipmentCreatePage from "../../pages/equipment/EquipmentCreatePage.tsx";
import EquipmentUpdatePage from "../../pages/equipment/EquipmentUpdatePage.tsx";
import EquipmentDetailsPage from "../../pages/equipment/EquipmentDetailsPage.tsx";
import MusclesPage from "../../pages/muscle/MusclesPage.tsx";
import MuscleCreatePage from "../../pages/muscle/MuscleCreatePage.tsx";
import MuscleUpdatePage from "../../pages/muscle/MuscleUpdatePage.tsx";
import MuscleDetailsPage from "../../pages/muscle/MuscleDetailsPage.tsx";
import MovementsPage from "../../pages/movement/MovementsPage.tsx";
import MovementCreatePage from "../../pages/movement/MovementCreatePage.tsx";
import MovementUpdatePage from "../../pages/movement/MovementUpdatePage.tsx";
import MovementDetailsPage from "../../pages/movement/MovementDetailsPage.tsx";

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