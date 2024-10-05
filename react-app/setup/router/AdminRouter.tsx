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
import MusclesPage from "../../pages/workout/MusclesPage.tsx";
import MuscleCreatePage from "../../pages/workout/MuscleCreatePage.tsx";
import MuscleUpdatePage from "../../pages/workout/MuscleUpdatePage.tsx";
import MuscleDetailsPage from "../../pages/workout/MuscleDetailsPage.tsx";

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