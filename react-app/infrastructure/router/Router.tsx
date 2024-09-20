import {
    createBrowserRouter,
    RouterProvider,
} from "react-router-dom";

import routes from "./routes-mapping.tsx";
import HomePage from "../../pages/HomePage.tsx";
import ErrorPage from "../../pages/ErrorPage.tsx";
import UsersPage from "../../pages/user/UsersPage.tsx";
import UserDetailsPage from "../../pages/user/UserDetailsPage.tsx";
import * as React from "react";
import UserCreatePage from "../../pages/user/UserCreatePage.tsx";
import UserUpdatePage from "../../pages/user/UserUpdatePage.tsx";

const routerConfig = createBrowserRouter([
    {
        path: routes.dashboard,
        errorElement: <ErrorPage />,
        children: [
            {
                index: true,
                element: <HomePage />,
            }, {
                path: routes.userList,
                children: [
                    {
                        index: true,
                        element: <UsersPage />,
                    }, {
                        path: routes.userCreate,
                        element: <UserCreatePage />,
                    }, {
                        path: routes.userEdit(':userId'),
                        element: <UserUpdatePage />,
                    }, {
                        path: routes.userDetails(':userId'),
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