import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import HomePage from "../../pages/HomePage.tsx";
import ErrorPage from "../../pages/ErrorPage.tsx";
import UsersPage from "../../pages/user/UsersPage.tsx";
import UserDetailsPage from "../../pages/user/UserDetailsPage.tsx";
import * as React from "react";
import CreateUserPage from "../../pages/user/CreateUserPage.tsx";
import EditUserPage from "../../pages/user/EditUserPage.tsx";

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
                        path: '/users/new',
                        element: <CreateUserPage />,
                    }, {
                        path: '/users/:userId/edit',
                        element: <EditUserPage />,
                    }, {
                        path: ':userId',
                        element: <UserDetailsPage />,
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