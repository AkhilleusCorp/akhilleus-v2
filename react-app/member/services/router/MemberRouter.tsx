import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";
import * as React from "react";

import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import MemberDashboardPage from "app/member/pages/MemberDashboardPage.tsx";
import MemberWorkoutDetailsPage from "app/member/pages/workout/MemberWorkoutDetailsPage.tsx";

const routerConfig = createBrowserRouter([
    {
        path: memberRoutes.dashboard,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <MemberDashboardPage />,
            }
        ]
    }, {
        path: memberRoutes.workout.list,
        children: [
            {
                index: true,
            }, {
                path: memberRoutes.workout.create,
            }, {
                path: memberRoutes.workout.edit(':workoutId'),
            }, {
                path: memberRoutes.workout.details(':workoutId'),
                element: <MemberWorkoutDetailsPage />,
            }
        ]
    }
]);

const AdminRouter: React.FC = () => {
    return (
        <React.StrictMode>
            <RouterProvider router={routerConfig}/>
        </React.StrictMode>
    );
}

export default AdminRouter;