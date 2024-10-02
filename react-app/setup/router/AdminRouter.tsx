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
import websiteRoutes from "../../config/routes/website-routes.tsx";

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