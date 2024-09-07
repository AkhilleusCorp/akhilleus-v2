import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import HomePage from "../../pages/HomePage.tsx";
import ErrorPage from "../../pages/ErrorPage.tsx";
import UsersPage from "../../pages/user/UsersPage.tsx";
import UserPage from "../../pages/user/UserPage.tsx";
import * as React from "react";

const routerConfig = createBrowserRouter([
    {
        path: "/",
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <HomePage />,
            }, {
                path: "/users",
                children: [
                    {
                        index: true,
                        element: <UsersPage />,
                    }, {
                        path: ':userId',
                        element: <UserPage />,
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