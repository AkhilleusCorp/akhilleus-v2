import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";
import * as React from "react";

import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import ErrorPage from "app/common/pages/ErrorPage.tsx";
import MemberDashboardPage from "app/member/pages/MemberDashboardPage.tsx";

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