import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import routes from "./routes-mapping.tsx";
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

const routerConfig = createBrowserRouter([
    {
        path: routes.dashboard,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <DashboardPage />,
            }, {
                path: routes.user.list,
                children: [
                    {
                        index: true,
                        element: <UsersPage />,
                    }, {
                        path: routes.user.create,
                        element: <UserCreatePage />,
                    }, {
                        path: routes.user.edit(':userId'),
                        element: <UserUpdatePage />,
                    }, {
                        path: routes.user.details(':userId'),
                        element: <UserDetailsPage />,
                    }
                ]
            }, {
                path: routes.workout.list,
                children: [
                    {
                        index: true,
                        element: <WorkoutsPage />,
                    }, {
                        path: routes.workout.create,
                        element: <WorkoutCreatePage />,
                    }, {
                        path: routes.workout.edit(':workoutId'),
                        element: <WorkoutUpdatePage />,
                    }, {
                        path: routes.workout.details(':workoutId'),
                        element: <WorkoutDetailsPage />,
                    }
                ]
            },
        ]
    },
]);

const Router: React.FC = () => {
    return (
        <React.StrictMode>
            <RouterProvider router={routerConfig}/>
        </React.StrictMode>
    );
}

export default Router;