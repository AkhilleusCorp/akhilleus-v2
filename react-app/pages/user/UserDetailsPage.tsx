import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import UserDetailsCard from "../../widget/user/UserDetailsCard.tsx";
import {useParams, useNavigate} from "react-router-dom";
import ErrorPage from "../ErrorPage.tsx";
import useGetOneUserById from "../../hooks/user/useGetOneUserById.tsx";
import UserDeleteButton from "../../widget/user/UserDeleteButton.tsx";
import EditButton from "../../widget/common/button/EditButton.tsx";
import websiteRoutes from "../../config/routes/website-routes.tsx";

const UserDetailsPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    const navigate = useNavigate();

    const user = useGetOneUserById(userId);
    if (!user) {
        return <ErrorPage />
    }

    const onConfirmDelete = (userId: number) => {
        console.log(userId);
        navigate(websiteRoutes.user.list);
    }

    return (
        <AdminLayout>
            <div className={"text-align-right margin-bottom-s"}>
                <EditButton routeToEditPage={websiteRoutes.user.edit(user.id)} />
                <UserDeleteButton userId={user.id} callbackFunction={onConfirmDelete} />
            </div>
            <UserDetailsCard user={user} displayActions={false} />
        </AdminLayout>
    );
}

export default UserDetailsPage;